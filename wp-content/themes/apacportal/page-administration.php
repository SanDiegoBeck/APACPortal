<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box" style="margin-bottom: 0;">
					<div class="content">
						<img src="<?=get_stylesheet_directory_uri()?>/images/admin/logo.png" width="150px">
						<p style="font-weight: bold; font-size: 1.3em;">Facilities & Administration</p>
					</div>
				</div>
				<div class="box">
					<header>
						Mission
					</header>
					<div class="content" style="min-height: 0;">
						Maintain a Healthy Working Environment.
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/admin/our-team">More</a></span>
						Our Team
					</header>
					<div class="content" style="min-height: 0;">
						<?=apacportal_post_list('our-team')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/admin/work-place">More</a></span>
						Work Place
					</header>
					<div class="content">
						<?=apacportal_post_list('work-place')?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/facility-news">More</a></span>
						Facility News
					</header>
					<div class="content">
						<?=apacportal_post_list('facility-news')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/travel-service">More</a></span>
						Travel Service
					</header>
					<div class="content">
						<?=apacportal_post_list('travel-service')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/vehicle-service">More</a></span>
						Vehicle Service
					</header>
					<div class="content">
						<?=apacportal_post_list('vehicle-service')?>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/policies-admin">More</a></span>
						Policies
					</header>
					<div class="content">
						<?=apacportal_post_list('policies-admin')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/how-to">More</a></span>
						How To
					</header>
					<div class="content">
						<?=apacportal_post_list('how-to')?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>