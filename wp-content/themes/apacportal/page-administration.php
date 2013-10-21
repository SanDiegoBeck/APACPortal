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
					<div class="content">
						Maintain a Healthy Working Environment
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/out-team">More</a></span>
						Our Team
					</header>
					<div class="content">
						<ul>
							<?query_posts('post_parent=735&post_type=attachment&post_status=any')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?=wp_get_attachment_url()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/work-place">More</a></span>
						Work Place
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=work-place&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
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
						<ul>
							<?query_posts('category_name=departments/admin/facility-news&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/travel-service">More</a></span>
						Travel Service
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/admin/travel-service&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/vehicle-service">More</a></span>
						Vehicle Service
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/admin/vehicle-service&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
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
						<ul>
							<?query_posts('category_name=policies-admin&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/admin/how-to">More</a></span>
						How To
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=how-to&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>