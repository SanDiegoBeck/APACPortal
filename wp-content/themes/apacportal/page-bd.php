<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span6">
			<div class="box">
				<div class="content" style="text-align: center;"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bd/logo.png" /></div>
			</div>
			<div class="box">
				<header>Our Team</header>
				<div class="content" style="height: 280px; overflow-y: auto;">
					<?query_posts('category_name=our-team-bd')?>
					<?the_post()?>
					<a href="<?the_permalink()?>"><h4><?the_title()?></h4></a>
					<summary><?the_content()?></summary></a>
				</div>
			</div>
			<div class="box">
				<header>Contacts</header>
				<div class="content">
					<?=apacportal_post_list('contacts-bd',-1);?>
				</div>
			</div>
		</div>
		<div class="span6">
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
