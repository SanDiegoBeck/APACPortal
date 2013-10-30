<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar('left')?>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/joint-ventures">More</a></span>
						Joint Ventures
					</header>
					<div class="content">
						<?=apacportal_post_list('joint-ventures');?>
					</div>
				</div>
			</div>
			<div class="span5 col-right">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/commercial">More</a></span>
						Commercial
					</header>
					<div class="content">
						<?=apacportal_post_list('commercial');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/industrial">More</a></span>
						Industrial
					</header>
					<div class="content">
						<?=apacportal_post_list('industrial');?>
					</div>
				</div>
			</div>
			<div class="span4 col-right">
				<?get_sidebar('department-list')?>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/corporate-function">More</a></span>
						Corporate Function
					</header>
					<div class="content">
						<?=apacportal_post_list('corporate-function');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>