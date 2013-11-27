<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span6">
			<div class="box">
				<div class="content"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bd/logo.png" /></div>
			</div>
			<div class="box">
				<header>Our Team
					<span class="more-link"><a href="/category/departments/bd/our-team-bd">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('our-team-bd');?>
				</div>
			</div>
			<div class="box">
				<header>Contacts
					<span class="more-link"><a href="/category/departments/bd/contacts-bd">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('contacts-bd');?>
				</div>
			</div>
		</div>
		<div class="span6">
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
