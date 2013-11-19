<?php
header('X-UA-Compatible: IE=edge,chrome=1');

add_image_size( 'home-news-slider', 526, 188, true );

function share_price(){
	return $content = file_get_contents('https://www.google.com/finance?cid=673373');
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

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><time class="entry-date" datetime="%3$s">%4$s</time></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-next"><?php next_posts_link( __( 'Next <span>&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-previous"><?php previous_posts_link( __( '<span>&larr;</span> Previous', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

add_action( 'init', 'register_link_post_type');

function register_link_post_type(){
	register_post_type( 'link',
		array(
			'label'=>'Links',
			'labels' => array(
				'name' => 'Links',
				'singular_name' => 'Link',
				'add_new_item' => 'Add New Link'
			),
			'taxonomies' => array('category'), 
			'public' => true,
			'supports' => array('title','editor','thumbnail')
		)
	);
}

function apacportal_post_list($category_name,$limit=5,$args=array()){
	$list='<ul>';
	foreach(
		get_posts(
			array_merge(
				array('category__in'=>array(get_category_by_slug($category_name)->cat_ID),'post_type'=>'any','post_status'=>array('inherited','published'),'posts_per_page'=>$limit,'orderby'=>'menu_order date','order'=>'desc','suppress_filters'=>false),
				$args
			)
		) as $post
	){
		$list.='<li title="'.$post->post_title.'">';
		switch($post->post_type){
			case 'link':
				$list.='<a href="'.$post->post_content.'" target="_blank">'.$post->post_title.'</a>';
				break;
			case 'attachment':
				$list.=preg_replace('/<a(.*?)>/i','<a$1 target="_blank">',wp_get_attachment_link($post->ID));
				break;
			default:
				$list.='<a href="'.get_permalink($post->ID).'" target="_blank">'.$post->post_title.'</a>';
		}
		$list.='</a></li>';
	}
	$list.='</ul>';
	
	return $list;
}

function apacportal_add_role_contact_editor(){
	remove_role('contact_editor');
	add_role('contact_editor','Contact Editor',array('edit_users_in_same_company'=>true,'edit_users'=>true,'read'=>true));
}

add_action('init','apacportal_add_role_contact_editor');

function world_time(){
	
	$world_time='';
	
	date_default_timezone_set('Asia/Shanghai');
	
	$world_time.='<span class="city">Shanghai: </span><span class="time">'.date('H:i').'</span>';
	date_default_timezone_set('Europe/Rome');
	
	$world_time.='<span class="city">Turin: </span><span class="time">'.date('H:i').'</span>';
	
	date_default_timezone_set('America/New_York');
	$world_time.='<span class="city">Auburn Hills: </span><span class="time">'.date('H:i').'</span>';
	
	date_default_timezone_set('Asia/Shanghai');
	
	return $world_time;

}

function edit_posts_orderby($orderby_statement){
	return str_replace('wp_posts.menu_order,wp_posts.post_date desc', 'wp_posts.menu_order desc,wp_posts.post_date desc', $orderby_statement);
}

add_filter('posts_orderby', 'edit_posts_orderby');

function apply_page_attributes_to_posts(){
    add_post_type_support( 'post', 'page-attributes' );
}

add_action( 'admin_init', 'apply_page_attributes_to_posts' );

?>
