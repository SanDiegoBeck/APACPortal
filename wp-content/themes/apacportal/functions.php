<?php
add_image_size( 'home-news-slider', 528, 135, true );

function share_price(){
	$content = file_get_contents('http://uk.finance.yahoo.com/q?s=F.MI');
	preg_match('/\<div class="yfi_rt_quote_summary_rt_top"\>\<p\>(.*?)\<\/p\>\<\/div\>/',$content,$matches);
	return $matches[1];
}

function str_get_excerpt($str,$length=28){
	/**
	 * $length，宽度计量的长度，1为一个ASCII字符的宽度，汉字为2
	 * $char_length，字符计量的长度，UTF8的汉字为3
	 */
	$char_length=$length/2*3;
	$str_origin=$str;
	for($i=0,$j=0;$i<$char_length && $j<$length;$i++,$j++){
		$temp_str=substr($str,0,1);
		if(ord($temp_str)>127){//非ASCII
			$i+=2;//补足汉字的字节数
			$j++;//汉字宽度，只要补1即可
			if($i<$char_length && $j<$length){
				$new_str[]=substr($str,0,3);//取出汉字字节数
				$str=substr($str,3);
			}
		}else{
			$new_str[]=substr($str,0,1);
			$str=substr($str,1);
		}
	}
	$new_str=join($new_str);
	if($new_str==$str_origin){
		return $new_str;
	}else{
		return $new_str.'…';
	}
}

function modify_contact_methods($profile_fields) {

	$profile_fields['department'] = 'Department';

	return $profile_fields;
}

add_filter('user_contactmethods', 'modify_contact_methods');

?>
