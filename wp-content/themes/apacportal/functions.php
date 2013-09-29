<?php
add_image_size( 'home-news-slider', 528, 135, true );

function share_price(){
	$content = file_get_contents('http://uk.finance.yahoo.com/q?s=F.MI');
	preg_match('/\<div class="yfi_rt_quote_summary_rt_top"\>\<p\>(.*?)\<\/p\>\<\/div\>/',$content,$matches);
	return $matches[1];
}
?>
