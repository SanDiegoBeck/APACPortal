<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span12">
			<div class="box">
				<header style="text-align: center;">Welcome to APAC Product Development</header>
				<div class="content" style="font-size: 1.5em; min-height: 0;">
					<?=apacportal_post_list('welcome');?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span6" style="text-align: center;">
			<a href="/work/pd/pd-china/">
				<img src="<?=get_stylesheet_directory_uri()?>/images/pd/china.png" />
				<img src="<?=get_stylesheet_directory_uri()?>/images/pd/product-china.png" />
			</a>
		</div>
		<div class="span6" style="text-align: center;">
			<a href="/work/pd/pd-india/">
				<img src="<?=get_stylesheet_directory_uri()?>/images/pd/india.png" />
				<img src="<?=get_stylesheet_directory_uri()?>/images/pd/product-india.png" />
			</a>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
