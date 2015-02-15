<?php

try{
	
	$price = json_decode(get_option('share_price_fiat_spa'), JSON_OBJECT_AS_ARRAY);
	
	if(!$price || (!(is_null($price['timestamp']) && time() < $price['retry_at']) && $price['timestamp'] < time() - 60)){
		
		$price['timestamp'] = null;
		$price['retry_at'] = time() + 60;
		
		update_option('share_price_fiat_spa', json_encode($price)); // tell other clients not to fetch shareprice
		$html = @file_get_contents('http://www.google.com/finance?q=FCAU');

		if(!$html){
			throw new Exception('Google Finance connection refused');
		}

		$full_document = new DOMDocument();
		@$full_document->loadHTML($html);

		$price_panel = $full_document->getElementById('price-panel')->childNodes->item(1);

		$price = array(
			'dom' => $full_document->saveHTML($price_panel),
			'timestamp' => time()
		);
		
		update_option('share_price_fiat_spa', json_encode($price));

	}
	
	echo $price['dom'];


}catch(Exception $e){
	echo 'Share price fetching error: '.$e->getMessage();
}
?>
