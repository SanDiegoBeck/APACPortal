<?php
add_image_size( 'home-news-slider', 526, 188, true );

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

	$profile_fields=array(
		'telephone'=>'Telephone',
		'cellphone'=>'Cell Phone',
		'department'=>'Department',
		'company_name'=>'Company Name',
		'working_site_country'=>'Working Site Country'
	);

	return $profile_fields;
}

add_filter('user_contactmethods', 'modify_contact_methods');

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

}
endif;

?>
