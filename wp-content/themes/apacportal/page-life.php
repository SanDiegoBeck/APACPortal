<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar('left')?>
			</div>
			<div class="span6">
				<div class="box">
					<header>Useful Links
					</header>
					<div class="content">
						<?=apacportal_post_list('useful-links',-1,array('orderby'=>'title','order'=>'ASC'));?>
					</div>
				</div>
				<div class="box">
					<header>Where to Eat
						<span class="more-link"><a href="/category/where-to-eat">More</a></span>
					</header>
					<div class="content">
						<?=apacportal_post_list('where-to-eat',10,array('orderby'=>'title','order'=>'ASC'));?>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="box">
					<header>Quote of the Day
					</header>
					<div class="content" style="min-height: 0;">
						<?php echo do_shortcode('[quotcoll orderby="random" limit=1]')?>
					</div>
				</div>
				<div class="box" id="notices">
					<header>
						<span class="more-link"><a href="/category/notices">More</a></span>
						Notices
					</header>
					<div class="content">
						<?=apacportal_post_list('notices');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/quick-links">More</a></span>
						Quick Links
					</header>
					<div class="content">
						<?=apacportal_post_list('quick-links');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>