<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box" style="margin-bottom: 0;">
					<div class="content">
						<img src="<?=get_stylesheet_directory_uri()?>/images/mopar/logo.png">
					</div>
				</div>
				<div class="box">
					<header>
						Team
					</header>
					<div class="content" style="min-height: 0;">
						Be an agile and  innovative business partner providing high quality, cost effective and secure technology solutions.
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/news-mopar">More</a></span>
						News
					</header>
					<div class="content">
						<?=apacportal_post_list('policies');?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/mopar-mopar">More</a></span>
						MOPAR
					</header>
					<div class="content" style="min-height: 0; height:188px; padding: 0;">
						<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
							<div class="sliderContent" style="width: 526px; height:188px">
								<?query_posts(array('category_name'=>'apac-news','posts_per_page'=>5))?>
								<?while(have_posts()):the_post();?>
								<div class="item" style="width:526px; height:188px">
									<a href="<?the_permalink()?>">
										<?the_post_thumbnail('home-news-slider')?>
									</a>
									<summary><?the_title()?></summary>
								</div>
								<?endwhile;?>
							</div>
						</div>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/accessorization-personalization">More</a></span>
						Accessorization & Personalization
					</header>
					<div class="content">
						<?=apacportal_post_list('accessorization-personalization');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/bulletin">More</a></span>
						Bulletin
					</header>
					<div class="content">
						<?=apacportal_post_list('bulletin');?>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/events-motor-show-mopar">More</a></span>
						Events & Motor Show
					</header>
					<div class="content">
						<?=apacportal_post_list('events-motor-show-mopar');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/mopar-world">More</a></span>
						MOPAR World
					</header>
					<div class="content">
						<?=apacportal_post_list('mopar-world');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/merchandising-corner">More</a></span>
						Merchandising Corner
					</header>
					<div class="content">
						<?=apacportal_post_list('merchandising-corner');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
