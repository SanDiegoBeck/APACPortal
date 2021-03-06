<?php
/**
 * retrieve a post list including "post", "attachment" and "link" post type
 * @param array $args
 *	each_column: an integer, list container repeats after which items are exported, a list, say, "ul", will than be divided to multiple "ul"s
 *	container: list container, default is 'ul', but if there is a 'summary-thumbnail' class, default would be 'dl'
 *	container_class
 *	container_style
 *	item: list items container, default is li, but if there is a 'summary-thumbnail' class, default would be 'dd'
 *	item_class
 *	header_class
 *	header_style
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
		'container' => 'ul', 'container_class' => '', 'container_style' => '',
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
		
		$out .= '<' . $args['container'] . ' class="' . $args['container_class'] . '"';
		
		if($args['container_style']){
			$out .= ' style="' . $args['container_style'] . '"';
		}
		
		$out .= '>';
	}
	
	$posts = get_posts($args); //$out .= print_r($args, true);
	
	foreach( $posts as $index => $post ){
		
		$post_class = '';
		
		$tags = wp_get_post_tags($post->ID, array('fields'=>'names'));
		
		foreach(array('new', 'hot') as $featured_tag){
			if(in_array($featured_tag, $tags)){
				$post_class .= ' ' . $featured_tag;
			}
		}
		
		if((time() - strtotime($post->post_date)) < (86400 * 3)){
			$post_class .= ' new';
		}
		
		if($args['item']){
			$out .= '<'. $args['item'] . ' id="'.$post->post_name.'"' . ' title="'.$post->post_title.'"' . ' class="' . $args['item_class'] . $post_class . '"' . '>';
		}
		
		if($args['type'] === 'list' && strpos($post_class, ' new') !== false){
			$out .= '<img class="mark-new" src="' . site_url() . '/wp-content/uploads/2015/01/20080320125246727.gif">';
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
					$out .= '<a href="' . wp_get_attachment_url($post->ID) . '">' . str_replace('_', '' , $post->post_title) . '</a>';
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

function curl_call($url, $data = null, $method = 'GET', $type = 'form-data', $headers = array()){
	
	if(!is_null($data) && $method === 'GET'){
		$method = 'POST';
	}

	switch($type){
		case 'form-data':
			break;
		case 'json':
			$headers[] = 'Content-Type: application/json';
			break;
		default:
			$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	}
	
	$ch = curl_init($url);
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
	if($method === 'POST'){
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $type === 'json' ? json_encode($data) : $data);
	}
	
	$response = curl_exec($ch);

	if(!$response){
		print_r(curl_error($ch));
		exit;
	}

	curl_close($ch);
	
	if(!is_null(json_decode($response))){
		$response = json_decode($response);
	}
	
	return $response;

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
	add_image_size( 'medium-thumbnail', 250, 250 );
});

/**
 * add extra field for user in admin panel
 */
add_filter('user_contactmethods', function($profile_fields) {

	$profile_fields=array(
		'employee_id'=>'Employee ID',
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

add_action('init', function(){
	
	wp_register_style('bootstrap', get_stylesheet_directory_uri().'/bootstrap/css/bootstrap.min.css', array(), '2.3.2-2014-04-28');
	wp_register_style('twentythirteen-style', get_stylesheet_uri(), array(), '2014-12-05');
	wp_register_style('ltIE9', get_stylesheet_directory_uri().'/ltIE9.css', array(), '2014-04-28');
	wp_register_style('responsiveslides', get_stylesheet_directory_uri().'/css/responsiveslides.css', array(), '2014-04-28');
	wp_register_style('ltIE9', get_stylesheet_directory_uri().'/ltIE9.css', array(), '2014-04-28');
	wp_register_style('fullcalendar', get_stylesheet_directory_uri().'/css/fullcalendar.min.css', array(), '2.3.0');
	
	wp_register_script('bootstrap', get_stylesheet_directory_uri().'/bootstrap/js/bootstrap.js', array('jquery'), '2.3.2');
	wp_register_script('responsiveslides', get_stylesheet_directory_uri().'/js/responsiveslides.min.js', array('jquery'), '1.54');
	wp_register_script('moment', get_stylesheet_directory_uri().'/js/moment.min.js', array(), '2.9.0');
	wp_register_script('fullcalendar', get_stylesheet_directory_uri().'/js/fullcalendar.min.js', array('jquery', 'moment'), '2.3.0');
	
});

add_action('wp_enqueue_scripts', function(){
	
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('responsiveslides');
	wp_enqueue_style('ltIE9');
	wp_style_add_data('ltIE9', 'conditional', 'lt IE 9');
	
});

add_action('admin_enqueue_scripts', function(){
	wp_register_style('admin', get_stylesheet_directory_uri() . '/admin/style.css');
	wp_enqueue_style('admin');
});

/**
 * the javascripts should be loaded on the page footer, to ensure the page loading speed
 */
add_action('wp_footer', function(){
	
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
	
	add_shortcode('subrow', function($attrs, $content){
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
			
			$out .= '<header class="' . $attrs['header_class'] . '"';
			
			if(array_key_exists('header_style', $attrs)){
				$out .= ' style="' . $attrs['header_style'] . '"';
			}
			
			$out .= '>';

			if(in_array($attrs['type'], array('list', 'slider', 'single')) && (!array_key_exists('limit', $attrs) || $attrs['limit'] > 0) && !array_key_exists('name', $attrs) && !array_key_exists('more_link', $attrs)){
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
	
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'gsa-crawler') !== false){
		return;
	}
	
	if($_SERVER['HTTP_USER_AGENT'] === get_option('monitor_ua')){
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

add_action('init', function(){
	register_post_type('chop_request', array(
		'label'=>'Chop Requests',
		'show_ui'=>true,
		'show_in_menu'=>true,
		'supports'=>array('title'),
		'menu_icon'=>'dashicons-pressthis',
		'register_meta_box_cb'=>function($post){
		
			add_meta_box('info', 'Request Detail', function($post){
				require get_stylesheet_directory() . '/admin/chop_request_detail.php';
			}, 'chop_request', 'normal');
			
			remove_meta_box( 'bawpvc_meta_box', 'chop_request' , 'side' );
			
			add_meta_box('status', 'Status', function($post){
				require get_stylesheet_directory() . '/admin/chop_request_status.php';
			}, 'chop_request', 'side');
		}
	));
	add_role('internal_control','Internal Control',array(''));
});

add_action('save_post', function($post_id){
	
	$fields = array(
		'request_status'=>'Request Status'
	);
	
	if(isset($_POST['request_status'])){
		add_post_meta($post_id, 'request_statuses', json_encode(array('user'=>wp_get_current_user()->display_name, 'value'=>$_POST['request_status'], 'time'=>time(), 'comments'=>$_POST['request_status_change_comments'])));
	}
	
	foreach($fields as $field => $label){
		if(isset($_POST[$field])){
			update_post_meta($post_id, $field, $_POST[$field]);
		}
	}
});

add_action('init', function(){
	
	register_post_type('function', array(
		'label'=>'Functions',
		'show_ui'=>true,
		'show_in_menu'=>true,
		'supports'=>array('title'),
		'menu_icon'=>'dashicons-networking',
		'register_meta_box_cb'=>function($post){
		
			add_meta_box('info', 'Department Detail', function($post){
				
				$uda_levels = json_decode(get_option('uda_levels'));
				$uda_steps = json_decode(get_option('uda_steps'));
				$uda_approvers = json_decode(get_post_meta($post->ID, 'uda_approvers', true));

				$countries = json_decode(get_option('countries'));
				require get_stylesheet_directory() . '/admin/department_detail.php';
			}, 'function', 'normal');
			
			remove_meta_box( 'bawpvc_meta_box', 'function' , 'side' );
			
		}
	));
});

add_action('save_post', function($post_id){
	
	if($_POST['post_type'] !== 'function'){
		return;
	}
	
	$uda_steps = json_decode(get_option('uda_steps'));
	$uda_levels = json_decode(get_option('uda_levels'));
	
	$uda_approvers = array();
	
	foreach($uda_levels as $uda_level){
		
		$level_name = sanitize_title($uda_level->name);
		
		foreach($uda_steps as $step){
			
			if(!isset($_POST[$level_name][$step->name]) || !is_array($_POST[$level_name][$step->name])){
				$_POST[$level_name][$step->name] = array();
			}

			$uda_approvers[$step->name][$level_name] = $_POST[$level_name][$step->name];
		}
			
	}
	
	update_post_meta($post_id, 'uda_approvers', json_encode($uda_approvers));

	$fields = array(
		'legal_entity'=>'Legal Entity',
		'country'=>'Country',
	);

	foreach($fields as $field => $label){
		if(isset($_POST[$field])){
			update_post_meta($post_id, $field, $_POST[$field]);
		}
	}
	
});

add_action('init', function(){
	register_post_type('workhour_request', array(
		'label'=>'Leave & OT',
		'show_ui'=>true,
		'show_in_menu'=>true,
		'supports'=>array('title'),
		'menu_icon'=>'dashicons-clock',
	));
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

// add columns to User panel list page
add_filter('manage_users_columns', function($column) {
	
	$column = array (
		'cb' => '<input type="checkbox" />',
		'username' => 'Username',
		'name' => 'Name',
		'department' => 'Department',
		'role' => 'Role',
		'posts' => 'Posts',
	);
    
    return $column;
	
});

// add the data
add_filter('manage_users_custom_column', function ($val, $column_name, $user_id){
    switch ($column_name) {
        case 'department' :
            return get_user_meta($user_id, 'department', true);
        default:
    }
    return;
}, 10, 3 );

add_filter('manage_chop_request_posts_columns', function ($columns){
    $newcolumns = array(
        'cb' => $columns['cb'],
        'title' => $columns['title'],
		'documents'=>'Documents',
		'approval_file'=>'Approval File',
		'legal_entity'=>'Legal Entity',
		'status' => 'Status',
		'date' => $columns['date']
    );
    return $newcolumns;
});

add_action('manage_chop_request_posts_custom_column', function ($column_name) {
	global $post;
    switch( $column_name ) {
        case 'requestor' :
            echo get_post_meta($post->ID, 'requestor', true);
            break;
		case 'documents':
			$documents = json_decode(get_post_meta($post->ID, 'documents', true));
			foreach($documents as $document){
				echo $document->name;
				if($document->pages){
					echo '&nbsp;(' . $document->pages . ')';
				}
				echo '<br>';
			}
			break;
		case 'status' :
			$available_statuses = json_decode(get_option('chop_request_statuses'), JSON_OBJECT_AS_ARRAY);
			$statuses = get_post_meta($post->ID, 'request_statuses');
			$status = json_decode(stripslashes($statuses[count($statuses) - 1]));
			echo $status ? ($available_statuses[$status->value] . ', ' . $status->user . ', ' . date('Y-m-d', $status->time)) : '-';
			break;
		case 'approval_file':
			if(get_post_meta($post->ID, 'approval_file_id', true)){
				echo '<a href="' . wp_get_attachment_url(get_post_meta($post->ID, 'approval_file_id', true)) . '" target="_blank">' . get_the_title(get_post_meta($post->ID, 'approval_file_id', true)) . '</a>';
			}
			break;
		case 'legal_entity':
			echo get_post_meta($post->ID, 'legal_entity', true);
			break;
    }
});

add_action('restrict_manage_posts', function () {
	global $wpdb, $current_screen;
	if ($current_screen->post_type == 'chop_request') {
		
		$chop_request_options = json_decode(get_option('chop_request_fields'));
		$legal_entities = $chop_request_options->legal_entity->options;
		echo '<select name="legal_entity">';
		echo '<option value="">' . __( 'Show all legal entities', 'textdomain' ) . '</option>';
		foreach ($legal_entities as $legal_entity) {
			$selected = (!empty($_GET['legal_entity']) && $_GET['legal_entity'] == $legal_entity ) ? ' selected="selected"' : '';
			echo '<option' . $selected . ' value="' . $legal_entity . '">' . $legal_entity . '</option>';
		}
		echo '</select>';
		
		$available_statuses = json_decode(get_option('chop_request_statuses'));
		echo '<select name="request_status">';
		echo '<option value="">' . __( 'Show all statuses', 'textdomain' ) . '</option>';
		foreach ($available_statuses as $status_name => $status_label) {
			$selected = (!empty($_GET['request_status']) && $_GET['request_status'] == $status_name ) ? ' selected="selected"' : '';
			echo '<option' . $selected . ' value="' . $status_name . '">' . $status_label . '</option>';
		}
		echo '</select>';
	}
});

add_filter('parse_query', function ($query) {
	if (is_admin() AND $query->query['post_type'] == 'chop_request') {
		$qv = &$query->query_vars;
		$qv['meta_query'] = array();

		if (!empty($_GET['legal_entity'])) {
			$qv['meta_query'][] = array(
				'field' => 'legal_entity',
				'value' => $_GET['legal_entity']
			);
		}
		
		if (!empty($_GET['request_status'])) {
			$qv['meta_query'][] = array(
				'field' => 'request_status',
				'value' => $_GET['request_status']
			);
		}
	}
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
	$categories = get_the_category();
	
	foreach($categories as $key => $category){
		if($category->slug === 'uncategorized'){
			unset($categories[$key]);
		}
	}
	
	if ( $categories ) {
		$category_names = $category_slugs = array();
		foreach($categories as $category){
			$category_names[] = $category->name;
			$category_slugs[] = $category->slug;
		}
		echo '<span class="categories-links"> View More in: <a href="' . site_url() . '/category/' . implode('+', $category_slugs) . '">' . implode(' ', $category_names) . '</a></span>';
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
