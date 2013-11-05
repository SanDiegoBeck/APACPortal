<?header('X-UA-Compatible: IE=edge,chrome=1')?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<link rel='stylesheet' href='<?=get_stylesheet_directory_uri()?>/bootstrap/css/bootstrap.min.css' type='text/css' media='all' />
	<?php wp_head(); ?>
	<link rel='stylesheet' href='<?=get_stylesheet_directory_uri()?>/mobilyslider/style.css' type='text/css' media='all' />
	<!--[if lt IE 9]>
	<link rel='stylesheet' href='<?=get_stylesheet_directory_uri()?>/ltIE9.css' type='text/css' media='all' />
	<![endif]-->
	
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="banner" style="background-image: url('<?=get_stylesheet_directory_uri()?>/images/headerbg_<?=floor(rand(0,12))?>.jpg')">
				<div class="wrapper">
					<div class="description-top">
<?if($_GET['share_price']){?>
						<span class="share-price">
							Share Price: Loading...
						</span>
<?}?>
					</div>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<h1 class="site-title pull-left"><img src="<?=get_stylesheet_directory_uri()?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>"></h1>
					</a>
					<h1 class="logo-aside pull-right"><img src="<?=get_stylesheet_directory_uri()?>/images/logo-apacportal.png"></h1>
					<div class="description pull-left">
						<span class="worldtime">
							<?=world_time();?>
						</span>
					</div>
				</div>
			</div>
			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					<?php get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
			<?php if (function_exists('HAG_Breadcrumbs') && !is_home()) { HAG_Breadcrumbs(array('wrapper_element'=>'ul','wrapper_class'=>'wrapper breadcrumb','prefix'=>'<li>','suffix'=>'</li>','crumb_link'=>false,'last_link'=>true,'post_types'=>array('post'=>array('last_show'=>false)))); } ?>
