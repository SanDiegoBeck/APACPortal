<?php get_header(); ?>

	<div id="primary" class="content-area page-mopar">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box" style="height: 227px;">
					<div class="content">
						<img src="<?=get_stylesheet_directory_uri()?>/images/mopar/logo.png" style="width: 90%; display: block; margin: auto;">
					</div>
				</div>
				<div class="box market-list">
					<header>Team</header>
					<div class="content">
						<ul>
							<?query_posts(array('category_name'=>'team','posts_per_page'=>-1))?>
							<?php while(have_posts()):the_post(); ?>
							<li class="coming-soon">
								<span class="flag"><?php the_post_thumbnail('list-bullet'); ?></span>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
							<?php endwhile; wp_reset_query(); ?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/news-mopar">More</a></span>
						News
					</header>
					<div class="content">
						<?=apacportal_post_list('news-mopar');?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/mopar/mopar-mopar">More</a></span>
						MOPAR - Our Brand
					</header>
					<div class="content" style="min-height: 0; height:188px; padding: 0;">
						<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
							<div class="sliderContent" style="width: 526px; height:188px">
								<?query_posts(array('category_name'=>'mopar-mopar','posts_per_page'=>3))?>
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
					<div class="content" style="min-height: 0; height:188px; padding: 0;">
						<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
							<div class="sliderContent" style="width: 526px; height:188px">
								<?query_posts(array('category_name'=>'accessorization-personalization','posts_per_page'=>3))?>
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
					<div class="content" style="min-height: 0; height:188px; padding: 0;">
						<div style="width: 249px; height:188px; position: absolute;"> 
							<div style="width: 249px; height:188px">
								<?php query_posts(array('category_name'=>'events-motor-show-mopar','posts_per_page'=>1)); ?>
								<?php the_post(); ?>
								<div class="item" style="width:249px; height:188px">
									<a href="<?the_permalink()?>">
										<?the_post_thumbnail('3-column-thumbnail')?>
									</a>
									<summary><?the_title()?></summary>
								</div>
								<?php wp_reset_query(); ?>
							</div>
						</div>
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
