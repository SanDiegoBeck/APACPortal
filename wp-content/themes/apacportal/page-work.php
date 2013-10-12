<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar()?>
			</div>
			<div class="span5 col-right">
				<?get_sidebar('department-list')?>
			</div>
			<div class="span4 col-right">
				<?get_sidebar('market-list')?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>