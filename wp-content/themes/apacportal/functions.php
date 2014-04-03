<?php
/**
 * retrive a post list including "post", "attachment" and "link" post type
 * @param string $category_name
 * @param int $limit
 * @param array $args
 * @return string
 */
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

/**
 * force IE to disable compatible mode, 
 * else IE will automatically switch compatible mode for intranet.
 */
add_action('init', function(){
	header('X-UA-Compatible: IE=edge,chrome=1');
});

/**
 * add customized featured image size
 */
add_action('init', function(){
	add_image_size( 'home-news-slider', 526, 188, true );
	add_image_size( '3-column-thumbnail', 249, 188, true );
	add_image_size( 'list-bullet', 30, 30, true );
});

/**
 * add extra field for user in admin panel
 */
add_filter('user_contactmethods', function($profile_fields) {

	$profile_fields=array(
		'telephone'=>'Telephone',
		'cellphone'=>'Cell Phone',
		'department'=>'Department',
		'company_name'=>'Company Name',
		'working_site_country'=>'Working Site Country'
	);

	return $profile_fields;
});

/**
 * register a new "Link" post type
 */
add_action( 'init', function(){
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
});

/**
 * add the contact editor role,
 * who is able to upload, edit and remove users in same company
 */
add_action('init', function(){
	add_role('contact_editor','Contact Editor',array('edit_users_in_same_company'=>true,'edit_users'=>true,'read'=>true));
});

/**
 * modify posts order by sql query
 * so that it orders by menu_order desc, post_date desc
 * or the "desc" statement will only affect the last order_by item,
 * which I consider is actually a WordPress bug
 */
add_filter('posts_orderby', function($orderby_statement){
	return str_replace('wp_posts.menu_order,wp_posts.post_date desc', 'wp_posts.menu_order desc,wp_posts.post_date desc', $orderby_statement);
});

/**
 * enable menu_order input form for "post"
 * it's defaultly an input form for "page"
 */
add_action( 'admin_init', function(){
    add_post_type_support( 'post', 'page-attributes' );
});

/**
 * Modify the main loop,
 * rather than put it aside and create a new one.
 * This is a nice solution when we need to get more args from uri,
 * and are not willing to parse them in our new main loop
 */
add_action('parse_query', function($wp_query){
	
	if(!$wp_query->is_main_query() || !$wp_query->is_archive()){
		return;
	}
	
	$wp_query->set('post_type', array('post','attachment','link'));
	$wp_query->set('post_status', array('publish','inherit'));
	$wp_query->set('orderby', 'menu_order date');
	$wp_query->set('order', 'desc');
});

add_action('wp_enqueue_scripts', function(){
	
	wp_register_style('bootstrap', get_stylesheet_directory_uri().'/bootstrap/css/bootstrap.min.css', array(), '2.3.2');
//	wp_register_style('bootstrap', get_stylesheet_directory_uri().'/css/bootstrap.min.css', array(), '3.11');
//	wp_register_style('bootstrap-theme', get_stylesheet_directory_uri().'/css/bootstrap-theme.min.css', array('bootstrap'), '3.11');
	wp_register_style('mobilyslider', get_stylesheet_directory_uri().'/mobilyslider/style.css');
	wp_register_style('ltIE9', get_stylesheet_directory_uri().'/ltIE9.css');
	
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('mobilyslider');
	wp_enqueue_style('ltIE9');
	wp_style_add_data('ltIE9', 'conditional', 'lt IE 9');
	
});

add_action('wp_footer', function(){
	
	wp_register_script('bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.11');
	wp_register_script('mobilyslider', get_stylesheet_directory_uri().'/mobilyslider/mobilyslider.js', array('jquery'), '3.11');
	
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('mobilyslider');
	
});

/**
 * replace functions in parent built-in theme
 */
if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
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
?>
