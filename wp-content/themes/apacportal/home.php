<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar()?>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/apac-news">More</a></span>
						APAC News
					</header>
					<div class="content" style="height:135px; padding: 0;">
						<div class="slider" id="slider192" style="width: 530px; height:135px; position: absolute;"> 
							<div class="sliderContent" style="width: 530px; height:135px">
								<?query_posts('category_name=apac-news&posts_per_page=3')?>
								<?while(have_posts()):the_post();?>
								<div class="item">
									<a href="<?the_permalink()?>">
										<?the_post_thumbnail('home-news-slider')?>
										<summary><?the_title()?></summary>
									</a>
								</div>
								<?endwhile;?>
							</div>
						</div>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/internal-news">More</a></span>
						Internal News
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=internal-news&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/global-news">More</a></span>
						Global News
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=global-news&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/notices">More</a></span>
						Notices
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=notices&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/quick-links">More</a></span>
						Quick Links
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=quick-links&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?wp_reset_query()?>
<?php get_footer(); ?>