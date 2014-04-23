<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box" style="margin-bottom: 0;">
					<div class="content">
						<img src="<?=get_stylesheet_directory_uri()?>/images/ict/logo.png" width="150px">
					</div>
				</div>
				<div class="box">
					<header>
						Mission
					</header>
					<div class="content" style="min-height: 0;">
						Be an agile and  innovative business partner providing high quality, cost effective and secure technology solutions.
					</div>
				</div>
				<div class="box summary-thumbnail">
					<header>
						<span class="more-link"><a href="/category/departments/ict/employee-of-the-week">More</a></span>
						Employee of the Week
					</header>
					<div class="content">
						<?php query_posts('category_name=employee-of-the-week&posts_per_page=1')?>
						<?php while(have_posts()):the_post(); ?>
						<dl class="dl-horizontal">
							<dt>
								<?php the_post_thumbnail('thumbnail')?>
							</dt>
							<dd>
								<ul>
									<li><a href="<?php the_permalink()?>" target="_blank"><?php the_title()?></a></li>
									<summary><?php the_excerpt()?></summary>
								</ul>
							</dd>
						</dl>
						<?php endwhile; ?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/ict/resources">More</a></span>
						Resources
					</header>
					<div class="content">
						<?=apacportal_post_list('resources')?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/ict/news">More</a></span>
						News
					</header>
					<div class="content" style="height: 280px; overflow-y: auto;">
						<?php query_posts('category_name=news&posts_per_page=1')?>
						<?php the_post()?>
						<a href="<?php the_permalink()?>"><h4><?php the_title()?></h4></a>
						<summary><?php the_content()?></summary></a>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/ict/technology-updates">More</a></span>
						Technology Update
					</header>
					<div class="content" style="height: 280px; overflow-y: auto;">
						<?php query_posts('category_name=departments/ict/technology-updates&posts_per_page=1')?>
						<?php the_post()?>
						<a href="<?php the_permalink()?>"><h4><?php the_title()?></h4></a>
						<summary><?php the_content()?></summary></a>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/ict/policies">More</a></span>
						Policies
					</header>
					<div class="content">
						<?=apacportal_post_list('policies')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/ict/processes-ict">More</a></span>
						Processes
					</header>
					<div class="content">
						<?=apacportal_post_list('processes-ict')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/ict/how-to-ict">More</a></span>
						How To
					</header>
					<div class="content">
						<?=apacportal_post_list('how-to-ict')?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
