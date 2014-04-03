<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<header>APAC Marketing Team
				</header>
				<div class="content">
					<?=apacportal_post_list('apac-marketing-team')?>
				</div>
			</div>
			<div class="box">
				<header>Digital
					<span class="more-link"><a href="/category/departments/marketing/digital">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('digital')?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<header> Jeep APAC Marketing
					<span class="more-link"><a href="/category/departments/marketing/jeep-apac-marketing">More</a></span>
				</header>
				<div class="content" style="min-height: 0; height:188px; padding: 0;">
					<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
						<div class="sliderContent" style="width: 526px; height:188px">
							<?php query_posts('category_name=jeep-apac-marketing&posts_per_page=3')?>
							<?php while(have_posts()):the_post(); ?>
							<div class="item" style="width:526px; height:188px">
								<a href="<?php the_permalink()?>">
									<?php the_post_thumbnail('home-news-slider')?>
								</a>
								<summary><?php the_title()?></summary>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<header>Fiat APAC Marketing
					<span class="more-link"><a href="/category/departments/marketing/fiat-apac-marketing">More</a></span>
				</header>
				<div class="content" style="min-height: 0; height:188px; padding: 0;">
					<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
						<div class="sliderContent" style="width: 526px; height:188px">
							<?php query_posts('category_name=fiat-apac-marketing&posts_per_page=3')?>
							<?php while(have_posts()):the_post(); ?>
							<div class="item" style="width:526px; height:188px">
								<a href="<?php the_permalink()?>">
									<?php the_post_thumbnail('home-news-slider')?>
								</a>
								<summary><?php the_title()?></summary>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<header>Alfa Romeo APAC Marketing
					<span class="more-link"><a href="/category/departments/marketing/alfa-romeo-apac-marketing">More</a></span>
				</header>
				<div class="content" style="min-height: 0; height:188px; padding: 0;">
					<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
						<div class="sliderContent" style="width: 526px; height:188px">
							<?php query_posts('category_name=alfa-romeo-apac-marketing&posts_per_page=3')?>
							<?php while(have_posts()):the_post(); ?>
							<div class="item" style="width:526px; height:188px">
								<a href="<?php the_permalink()?>">
									<?php the_post_thumbnail('home-news-slider')?>
								</a>
								<summary><?php the_title()?></summary>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<header>Abarth APAC Marketing
					<span class="more-link"><a href="/category/departments/marketing/abarth-apac-marketing">More</a></span>
				</header>
				<div class="content" style="min-height: 0; height:188px; padding: 0;">
					<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
						<div class="sliderContent" style="width: 526px; height:188px">
							<?php query_posts('category_name=abarth-apac-marketing&posts_per_page=3')?>
							<?php while(have_posts()):the_post(); ?>
							<div class="item" style="width:526px; height:188px">
								<a href="<?php the_permalink()?>">
									<?php the_post_thumbnail('home-news-slider')?>
								</a>
								<summary><?php the_title()?></summary>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<header>Chrysler & Dodge APAC Marketing
					<span class="more-link"><a href="/category/departments/marketing/chrysler-dodgeapac-marketing">More</a></span>
				</header>
				<div class="content" style="min-height: 0; height:188px; padding: 0;">
					<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
						<div class="sliderContent" style="width: 526px; height:188px">
							<?php query_posts('category_name=chrysler-dodgeapac-marketing&posts_per_page=3')?>
							<?php while(have_posts()):the_post(); ?>
							<div class="item" style="width:526px; height:188px">
								<a href="<?php the_permalink()?>">
									<?php the_post_thumbnail('home-news-slider')?>
								</a>
								<summary><?php the_title()?></summary>
							</div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Partnerships
					<span class="more-link"><a href="/category/departments/marketing/partnerships">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('partnerships')?>
				</div>
			</div>
			<div class="box">
				<header>Events & Motor Show
					<span class="more-link"><a href="/category/departments/marketing/events-motor-show">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('events-motor-show')?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
