<?php
/**
 * retrieve a post list including "post", "attachment" and "link" post type
 * @param string $category_name
 * @param int $limit deprecated, TODO, should be removed after all pages are made dynamic
 * @param array $args
 *	each_column: an integer, list container repeats after which items are exported, a list, say, "ul", will than be divided to multiple "ul"s
 *	contailer: list container, default is 'ul', but if there is a 'summary-thumbnail' class, default would be 'dl'
 *	container_class
 *	item: list items container, default is li, but if there is a 'summary-thumbnail' class, default would be 'dd'
 *	item_class
 *	show_thumbnail
 *	thumbnail_container
 *	thumbnail_class
 *	show_content
 *	content_container
 *	content_class
 *	show_title
 *	title_container
 *	title_class
 *	excerpt
 *	excerpt_container
 *	excerpt_class
 *	... all arguments WP_Query supports
 * @return string
 */
function apacportal_post_list($args = array()){
	
	$defaults = array(
		'container' => 'ul', 'container_class' => '',
		'item' => 'li', 'item_class' => '',
		'show_thumbnail' => false, 'thumbnail_container' => 'span', 'thumbnail_class' => '',
		'show_title' => true, 'title_container' => '', 'title_class' => '',
		'show_excerpt' => false, 'excerpt_container' => 'summary', 'excerpt_class' => '',
		'show_content' => false, 'content_container' => '', 'content_class'=> '',
		'post_type'=>'any',
		'post_status'=>array('inherit', 'publish'),
		'orderby'=>'menu_order date',
		'order'=>'desc',
		'suppress_filters'=>false
	);
	
	//parse out the $args, according to which we change some of default args
	$args = wp_parse_args($args);
	
	//scratch alias
	if(array_key_exists('category', $args)){
		if(strpos($args['category'], '+') !== false || strpos($args['category'], ',') !== false){
			$defaults['category_name'] = $args['category'];
		}
		else{
			$defaults['category__in'] = array(get_category_by_slug($args['category'])->cat_ID);
		}
		unset($args['category']);
	}
	
	if(array_key_exists('limit', $args)){
		$defaults['posts_per_page'] = $args['limit'];
		unset($args['limit']);
	}

	//TODO: the 'class' should be 'type', which is a certain value rather than an array
	if(in_array('single', explode(' ', $args['class']))){
		$defaults = array_merge($defaults, array(
			'posts_per_page' => 1,
			'post_type' => 'post',
			'post_status' => 'publish',
			'container' => false,
			'item' => false,
			'show_title' => false,
			'title_container' => 'h4',
			'show_content' => true,
		));
	}
	
	elseif(in_array('slider', explode(' ', $args['class']))){
		$defaults = array_merge($defaults, array(
			'show_thumbnail' => 'home-news-slider',
			'title_container' => 'summary'
		));
	}

	elseif(in_array('bullets-thumbnail', explode(' ', $args['class']))){
		$defaults['show_thumbnail'] = 'list-bullet';
		$defaults['thumbnail_class'] .= ' bullet';
	}
	
	elseif(in_array('summary-thumbnail', explode(' ', $args['class']))){
		$defaults = array_merge($defaults, array(
			'container' => '',
			'item' => 'dl',
			'show_thumbnail' => 'thumbnail',
			'thumbnail_container' => 'dt',
			'content_container' => 'dd',
			'show_excerpt' => true
		));
		$defaults['item_class'] .= ' dl-horizontal';
	}

	$args = wp_parse_args($args, $defaults);
	
	$out = '';
	
	if($args['container']){
		$out .= '<' . $args['container'] . ' class="' . $args['container_class'] . '"' . '>';
	}
	
	$posts = get_posts($args); //$out .= print_r($args, true);
	
	foreach( $posts as $index => $post ){
		
		if($args['item']){
			$out .= '<'. $args['item'] . ' title="'.$post->post_title.'"' . ' class="' . $args['item_class'] . '"' . '>';
		}
		
		if($args['show_thumbnail']){
			
			$out .= '<'.$args['thumbnail_container'].' class="' . $args['thumbnail_class'] . '">';
			
			if($post->post_type === 'post'){
				$out .= '<a href="' . get_permalink($post->ID) . '">';
			}
			
			if($post->post_type === 'link'){
				$out .= '<a href="' . $post->post_content . '">';
			}
			
			$out .= get_the_post_thumbnail($post->ID, $args['show_thumbnail']);
			
			if($post->post_type === 'post'){
				$out .= '</a>';
			}
			
			if($post->post_type === 'link'){
				$out .= '</a>';
			}
			
			$out .= '</' . $args['thumbnail_container'] . '>';
			
		}
		
		//the content container, if exists, contains title, excerpts and content
		if($args['content_container']){
			$out .= '<' . $args['content_container'] . ' class="' . $args['content_class'] . '"' . '>';
		}
		
		if($args['show_title']){
		
			if($args['title_container']){
				$out .= '<' . $args['title_container'] . ' class="' . $args['title_class'] . '"' . '>';
			}

			switch($post->post_type){
				case 'link':
					$out .= '<a href="' . $post->post_content . '" target="_blank">' . $post->post_title . '</a>';
					break;

				case 'attachment':
					$out .= preg_replace('/<a(.*?)>/i','<a$1 target="_blank">', wp_get_attachment_link($post->ID));
					break;

				default:
					$out .= '<a href="'.get_permalink($post->ID).'" target="_blank">'.$post->post_title.'</a>';
			}

			if($args['title_container']){
				$out .= '</' . $args['title_container'] . '>';
			}
			
		}
		
		if($args['show_excerpt']){
			$out .= '<' . $args['excerpt_container'] . ' class="' . $args['excerpt_class'] . '">' .
					$post->post_excerpt .
					'</' . $args['excerpt_container'] . '>';
		}
		
		if($args['show_content']){
			$out .= do_shortcode(wpautop(wptexturize($post->post_content)));
		}
		
		if($args['content_container']){
			$out .= '</' . $args['content_container'] . '>';
		}
		
		if($args['item']){
			$out .= '</' . $args['item'] . '>';
		}
		
		if(array_key_exists('each_column', $args) && $index % $args['each_column'] === $args['each_column'] - 1){
			$out .= '</' . $args['container'] . '>';
			$out .= '<' . $args['container'] . ' class="' . $args['container_class'] . '"' . '>';
		}
		
	}
	
	if($args['container']){
		$out .= '</' . $args['container'] . '>';
	}
	
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

function parse_comma_seperated_args(array $args, $keys = null){
	if(!is_null($keys) && !is_array($keys)){
		$keys = array($keys);
	}
	foreach($args as $key => $value){
		if(is_string($value) && (in_array($key, $keys) || is_null($key))){
			$args[$key] = explode(',', $args[$key]);
		}
	}
	return $args;
}

/**
 * force IE to disable compatible mode, 
 * else IE will automatically switch compatible mode for intranet.
 */
header('X-UA-Compatible: IE=edge,chrome=1');

/**
 * add customized featured image size
 */
add_action('init', function(){
	add_image_size( 'home-news-slider', 526, 188, true );
	add_image_size( '3-column-thumbnail', 249, 188, true );
	add_image_size( 'list-bullet', 30, 30, true );
	add_image_size( 'medium-thumbnail', 250, 250, true );
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
 * enable menu_order input form for "post" and "link"
 * it's defaultly an input form for "page"
 */
add_action( 'admin_init', function(){
    add_post_type_support( 'post', 'page-attributes' );
	add_post_type_support( 'link', 'page-attributes' );
	add_post_type_support( 'attachment', 'page-attributes' );
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
	
	!get_query_var('post_type') && $wp_query->set('post_type', 'any');
	!get_query_var('post_status') && $wp_query->set('post_status', array('publish','inherit'));
	!get_query_var('orderby') && $wp_query->set('orderby', 'menu_order date');
	!get_query_var('order') && $wp_query->set('order', 'desc');
	
});

add_action('wp_enqueue_scripts', function(){
	
	wp_register_style('bootstrap', get_stylesheet_directory_uri().'/bootstrap/css/bootstrap.min.css', array(), '2.3.2-2014-04-28');
	wp_register_style('twentythirteen-style', get_stylesheet_uri(), array(), '2014-04-30');
	wp_register_style('ltIE9', get_stylesheet_directory_uri().'/ltIE9.css', array(), '2014-04-28');
	wp_register_style('responsiveslides', get_stylesheet_directory_uri().'/css/responsiveslides.css', array(), '2014-04-28');
	
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('ltIE9');
	wp_enqueue_style('responsiveslides');
	wp_style_add_data('ltIE9', 'conditional', 'lt IE 9');
	
});

/**
 * the javascripts should be loaded on the page footer, to ensure the page loading speed
 */
add_action('wp_footer', function(){
	
	wp_register_script('bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.11');
	wp_register_script('placeholder', get_stylesheet_directory_uri().'/js/jquery.placeholder.js', array('jquery'), '2.0.8');
	wp_register_script('responsiveslides', get_stylesheet_directory_uri().'/js/responsiveslides.min.js', array('jquery'), '1.54');
	
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('placeholder');
	wp_enqueue_script('responsiveslides');
	
});

/**
 * add short codes "column" and "box" for admin panel maintainable page
 */
add_action('init', function(){
	
	add_shortcode('row', function($attrs, $content){
		$out = '<div class="row-fluid">' . do_shortcode($content) . '</div>';
		return $out;
	});
	
	add_shortcode('column', function($attrs, $content){
		$out = '<div class="span' . $attrs['width'] . '">' . do_shortcode($content) . '</div>';
		return $out;
	});
	
	add_shortcode('subcolumn', function($attrs, $content){
		$out = '<div class="span' . $attrs['width'] . '">' . do_shortcode($content) . '</div>';
		return $out;
	});
	
	/**
	 * The content list container shortcode
	 * shortcode attributions
	 *	title: the visual title of the box, if omitted, box will hide the header section
	 *	category:
	 *	type: possible values:
	 *		list, display a ul post list, is the default value
	 *		single, display the first post's content
	 *		slider, display a slider show of post thumbnails
	 *		rss_feed, currently specific for Home -> Global News
	 *	class: possible values:
	 *		summary-thumbnail
	 *		bullets-thumbnail
	 *		no-margin-after
	 *		no-min-height
	 *		no-padding
	 *		short
	 *	title
	 *	content:
	 *		none: box will hide the content section
	 *	content_class
	 *	content_style
	 *	... all possible args supported by apacportal_post_list() if type in list, single and slider
	 */	
	add_shortcode('box', function($attrs, $content){
		
		$defaults = array( 'type' => '', 'class'=>'', 'content_class'=>'' );
		
		$pre_attrs = wp_parse_args($attrs);
		
		$query_args = array('category', 'category_name', 'tag');
		
		if(array_intersect(array_keys($pre_attrs), $query_args) !== array()){
			$defaults['type'] = 'list';
		}
		
		$attrs = wp_parse_args($attrs, $defaults);
		
		$attrs['class'] .= ' box';	//instead of array_merge, we manually concat the default class...
		$attrs['content_class'] .= ' content';
		
		if($attrs['type'] === 'slider'){
			$attrs['class'] .= ' slider';
			$attrs['container_class'] .= ' rslides';
		}
		elseif($attrs['type'] === 'single'){
			$attrs['class'] .= ' single';
		}
		elseif($attrs['type'] === 'list'){
			$attrs['class'] .= ' list';
		}
		
		$out = '<div class="' . $attrs['class'] . '">';
		
		if(array_key_exists('title', $attrs)){
			$out .= '<header>';
			
			if(in_array($attrs['type'], array('list', 'slider', 'single')) && (!array_key_exists('limit', $attrs) || $attrs['limit'] > 0) && !array_key_exists('more_link', $attrs)){
				if(array_key_exists('category', $attrs)){
					$out .= '<a href="'.(site_url().'/category/'.$attrs['category'].'/').'" class="more-link">More</a>';
				}
				else{
					$out .= '<a href="'.(site_url() . '?' . http_build_query(array_intersect_key($attrs, array_flip($query_args)), null, null, PHP_QUERY_RFC1738)) . '" class="more-link">More</a>';
				}
			}
			
			if(array_key_exists('more_link', $attrs)){
				$more_links = array();
				wp_parse_str(html_entity_decode($attrs['more_link']), $more_links);	
				foreach($more_links as $name => $href){
					$out .= '<a href="'.$href.'" class="more-link">'.$name.'</a>';
				}
			}
			
			$out .= $attrs['title'];
			
			$out .= '</header>';
		}
		
		if(!array_key_exists('content', $attrs) || $attrs['content'] !== 'none'){
		
			$out .= '<div class="' . $attrs['content_class'] . '"';
			
			if(array_key_exists('content_style', $attrs)){
				$out .= ' style="' . $attrs['content_style'] . '"';
			}
			
			$out .= '>';

			if($content){
				$out .= do_shortcode(preg_replace('/^(\<br \/\>)+|(\<br \/\>)+$/', '', $content));
			}
			
			if(in_array($attrs['type'], array('list', 'slider', 'single'))){
				$out .= apacportal_post_list($attrs);
			}
			
			if($attrs['type'] === 'rss_feed'){
				$out .= '<div ajax-resource="/rss-feed/">Loading RSS Data...</div>';
			}

			$out .= '</div>';
			
		}
		
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
 * disable wpautop for pages
 */
add_action('pre_get_posts', function($query) {
	if($query->is_page){
		remove_filter( 'the_content', 'wpautop' );
	}
});

/**
 * log non-logged in user into database
 */
add_action('wp_footer', function(){
	
	if(is_user_logged_in()){
		return;
	}
	
	global $wpdb;
	
	$wpdb->insert('log', array(
		'ip'=>ip2long($_SERVER['REMOTE_ADDR']),
		'client'=>$_SERVER['HTTP_USER_AGENT'],
		'method'=>$_SERVER['REQUEST_METHOD'],
		'uri'=>$_SERVER["REQUEST_URI"],
	));
	
});

/**
 * add several common post type supports to  attachment
 */
add_action('init', function(){
	register_taxonomy_for_object_type( 'category', 'attachment' );
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
	add_post_type_support( 'attachment', 'thumbnail' );
});

/**
 * disable rich text edit for "page" and "link"
 */
add_filter( 'user_can_richedit', function($c) {
	
	global $post_type;

	if (in_array($post_type, array('link', 'page'))){
		return false;
	}
	
	return $c;
});

/**
 * define customized widgets
 */
class PeopleFinder_Widget extends WP_Widget{
	
	function __construct() {
		parent::__construct('people_finder', 'People Finder');
	}
	
	function widget() {
		?>
		<div class="box people-finder">
			<header>People Finder</header>
			<div class="content">
				<form class="form-inline" action="/user/">
					<button type="submit" class="btn pull-right"><span class="icon-search"></span></button>
					<div style="padding-right: 40px;">
						<input type="search" name="s_user" value="<?= $_GET['s_user'] ?>" placeholder="Type people name..." style="width: 88%;">
					</div>
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
		
		if(isset($instance['query_args'])){
			$instance = wp_parse_args($instance['query_args'], $instance);
			unset($instance['query_args']);
		}
		
		echo $args['before_widget'];
		
		if (isset($instance['title'])){
			echo $args['before_title'] . $instance['title'];
			
			if((!array_key_exists('limit', $instance) || $instance['limit'] > 0) && array_key_exists('category', $instance) && !array_key_exists('more_link', $instance)){
				echo '<a href="'.(site_url().'/category/'.$instance['category']).'" class="more-link">More</a>';
			}
			
			echo $args['after_title'];
			
		}
		
		if(array_key_exists('category', $instance)){
			$out .= apacportal_post_list($instance);
		}
		
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
		echo '<span class="categories-links"> View More in: ' . $categories_list . '</span>';
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
		<div class="nav-links text-right">
			<?php
			echo paginate_links(array(
				'base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ),
				'format'=>'/%n%/page/%#%',
				'total'=>2,
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages)
			);
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
?>
