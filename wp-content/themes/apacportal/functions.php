<?php
/**
 * retrieve a post list including "post", "attachment" and "link" post type
 * @param string $category_name
 * @param int $limit
 * @param array $args
 * @return string
 */
function apacportal_post_list($category_name,$limit=5,$args=array()){
	
	$defaults = array( 'container' => 'ul', 'container_class' => '', 'item' => 'li', 'item_class' =>'' );
	
	$args = wp_parse_args($args, $defaults);
	
	$container_class = $args->container_class ? ' class="'.$args->container_class.'"' : '';
	$item_class = $args->item_class ? ' class="'.$args->item_class.'"' : '';
	
	$list='<' . $args['container'] . $container_class . '>';
	
	foreach(
		get_posts(
			array_merge(
				array('category__in'=>array(get_category_by_slug($category_name)->cat_ID),'post_type'=>'any','post_status'=>array('inherited','published'),'posts_per_page'=>$limit,'orderby'=>'menu_order date','order'=>'desc','suppress_filters'=>false),
				$args
			)
		) as $post
	){
		$list .= '<'. $args['item'] . ' title="'.$post->post_title.'"'.$item_class . '>';
		
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
		$list.='</a></' . $args['item'] . '>';
	}
	$list.='</' . $args['container'] . '>';
	
	return $list;
}

/**
 * generate a carousel/slider from posts
 * @param args $args
 * @return string
 */
function apacportal_post_slider($args = array()){
	
	$defaults = array(
		'posts_per_page' => 5,
		'height' => '188',
	);
	
	if(isset($args['category'])){
		$args['category_name'] = $args['category'];
	}
	
	$args = wp_parse_args($args, $defaults);
	
	$posts = get_posts($args);
	
	$id = isset($args['category']) ? $args['category'] : rand(100, 999);
	
	$out = '<div id="' . $id . '" class="slider"><div class="sliderContent" style="height: ' . $args['height'] . 'px">';
	
	foreach ( $posts as $index => $post ) {
		$out .= '<div class="item"><a href="' . get_permalink($post->ID) . '">' . get_the_post_thumbnail($post->ID, 'home-news-slider') . '</a>' . '<summary>' . $post->post_title . '</summary>' . '</div>';
	}
	
	$out .= '</div></div>';
	
	return $out;
	
}

/**
 * count total hits according to data from Baw Post Views Count
 */
function get_total_hits(){
	global $wpdb;
	$count = $wpdb->get_row( " SELECT SUM( `meta_value` ) `count` FROM `wp_postmeta` WHERE `meta_key` = '_count-views_all' " )->count;
	return $count;
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

/**
 * the javascripts should be loaded on the page footer, to ensure the page loading speed
 */
add_action('wp_footer', function(){
	
	wp_register_script('bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.11');
	wp_register_script('mobilyslider', get_stylesheet_directory_uri().'/mobilyslider/mobilyslider.js', array('jquery'), '3.11');
	
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('mobilyslider');
	
});

/**
 * add short codes "column" and "box" for admin panel maintainable page
 */
add_action('init', function(){
	
	add_shortcode('column', function($attrs, $content){
		$out = '<div class="span' . $attrs['width'] . '">' . do_shortcode(trim(strip_tags($content))) . '</div>';
		return $out;
	});
	
	add_shortcode('box', function($attrs, $content){
		
		$defaults = array( 'type' => 'list' );
		
		$attrs = wp_parse_args($attrs, $defaults);
		
		if($attrs['type'] === 'slider'){
			$attrs['class'] .= ' slider';
		}
		elseif($attrs['type'] === 'single'){
			$attrs['class'] .= ' single';
		}
		else{
			$attrs['class'] .= ' list';
		}
		
		$out = '<div class="box' . (array_key_exists('class', $attrs) ? ' '.$attrs['class'] : '') . '">';
		
		if(array_key_exists('title', $attrs)){
			$out .= '<header>'.$attrs['title'];
			
			if((!array_key_exists('limit', $attrs) || $attrs['limit'] > 0) && array_key_exists('category', $attrs) && !array_key_exists('more_link', $attrs)){
				$out .= '<a href="'.(site_url().'/category/'.$attrs['category']).'" class="more-link">More</a>';
			}
			
			if(array_key_exists('more_link', $attrs)){
				$more_links = array();
				wp_parse_str(html_entity_decode($attrs['more_link']), $more_links);	
				foreach($more_links as $name => $href){
					$out .= '<a href="'.$href.'" class="more-link">'.$name.'</a>';
				}
			}
			
			$out .= '</header>';
		}
		
		$out .= '<div class="content">';
		
		if($content){
			$out .= do_shortcode(trim(strip_tags($content)));
		}
		
		if(array_key_exists('category', $attrs)){
			if($attrs['type'] === 'slider'){
				$out .= apacportal_post_slider($attrs);
			}else{
				$out .= apacportal_post_list($attrs['category'], array_key_exists('limit', $attrs) ? $attrs['limit'] : 5, $attrs);
			}
		}
		
		if($attrs['type'] === 'rss_feed'){
			$out .= '<div ajax-resource="/rss-feed/">Loading RSS Data...</div>';
		}
		
		if($attrs['type'] === 'single'){
			$single_defaults = array( 'posts_per_page' => 1 );
			$posts = get_posts(wp_parse_args($attrs, $single_defaults));
			if(count($posts) > 0){
				
				if(isset($attrs['show_title']) && $attrs['show_title']){
					$out .= '<a href="' . get_permalink($posts[0]->ID) . '">' . '<h4>' . $posts[0]->post_title . '</h4>'.'</a>';
				}
				
				$out .= $posts[0]->post_content;
			}
		}
		
		$out .= '</div>';
		
		$out .= '</div>';
		
		return $out;
	});
	
	add_shortcode('sidebar', function($attrs){
		ob_start();
		dynamic_sidebar($attrs['id']);
		$sidebar = ob_get_contents();
		ob_clean();
		return $sidebar;
	});
	
});

/**
 * register a dynamic sidebar / widget area
 */
add_action('init', function(){
	
	register_sidebar(array(
		'name' => 'Left Widget Area',
		'id' => 'left',
		'before_widget' => '<div class="box">',
		'after_widget' => '</div></div>',
		'before_title' => '<header>',
		'after_title' => '</header><div class="content">'
	));
	
});

add_action('widgets_init', function(){
	register_widget('PeopleFinder_Widget');
	register_widget('Posts_Widget');
});

/**
 * add "active" class to current menu item
 */
add_filter( 'nav_menu_css_class', 'additional_active_item_classes', 10, 2 );

function additional_active_item_classes($classes = array(), $menu_item = false){

    if(in_array('current-menu-item', $menu_item->classes) || in_array('current-post-ancestor', $menu_item->classes) || in_array('current-page-ancestor', $menu_item->classes)){
        $classes[] = 'active';
    }

    return $classes;
}

/**
 * define customized widgets
 */
class PeopleFinder_Widget extends WP_Widget{
	
	function __construct() {
		parent::__construct('people_finder', 'People Finder');
	}
	
	function widget() {
		?>
		<div class="box">
			<header>People Finder</header>
			<div class="content">
				<br>
				<form class="form-inline" action="/user/">
					<input type="search" name="s_user" value="<?= $_GET['s_user'] ?>" placeholder="Search..." style="width: 140px">
					&nbsp;
					<button type="submit" style="font-size: 0.9em;">SEARCH</button>
				</form>
			</div>
		</div>
		<?php
	}
	
}

class Posts_Widget extends WP_Widget{
	
	function __construct() {
		parent::__construct('posts', 'Posts');
	}
	
	function widget($args, $instance) {
		
		echo $args['before_widget'];
		
		if (isset($instance['title']))
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		
		$out .= '<div class="content">';
		
		if(array_key_exists('category', $instance)){
			$out .= apacportal_post_list($instance['category']);
		}
		
		$out .= '</div>';
		
		echo $out;
		echo $args['after_widget'];
		
	}
	
	function update($new_instance, $old_instance) {
		return parent::update($new_instance, $old_instance);
	}
	
	function form( $instance ) {
		
		if (isset($instance['title'])) {
			$title = $instance['title'];
		}
		
		if(isset($instance['category'])){
			$category = $instance['category'];
		}
		
		if(isset($instance['query_args'])){
			$query_args = $instance['query_args'];
		}
		?>
		<p>
			<label for="<?=$this->get_field_id('title')?>">Title</label> 
			<input class="widefat" id="<?=$this->get_field_id('title')?>" name="<?=$this->get_field_name('title')?>" type="text" value="<?=esc_attr($title)?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('category')?>">Category</label> 
			<input class="widefat" id="<?=$this->get_field_id('category')?>" name="<?=$this->get_field_name('category')?>" type="text" value="<?=esc_attr($category)?>">
		</p>
		<p>
			<label for="<?=$this->get_field_id('query_args')?>">Query Arguments</label> 
			<input class="widefat" id="<?=$this->get_field_id('query_args')?>" name="<?=$this->get_field_name('query_args')?>" type="text" value="<?=esc_attr($query_args)?>">
		</p>
		<?php 
	}
}

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
