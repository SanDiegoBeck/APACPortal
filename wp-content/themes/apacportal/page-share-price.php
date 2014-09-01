<?php

try{
	
	$price = get_option('share_price_fiat_spa');
	
	if(!$price || $price['timestamp'] < time() - 60){
		
		$html = @file_get_contents('https://www.google.com/finance?q=BIT%3AF&sq=fiat%20spa&sp=4&ei=U4EeU9jxFsSUwQPSlgE');

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
		
		update_option('share_price_fiat_spa', $price);

	}
	
	echo $price['dom'];


}catch(Exception $e){
	echo 'Share price fetching error: '.$e->getMessage();
}
?>
