<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>
						Mission
					</header>
					<div class="content">
						Scope of work, People and contact 
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/dnd/the-people-behind-the-department">More</a></span>
						The people behind the department 
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=the-people-behind-the-department&posts_per_page=5')?>
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
						<span class="more-link"><a href="/category/departments/dnd/news-from-the-markets">More</a></span>
						News from the markets 
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=news-from-the-markets&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/dnd/best-practice">More</a></span>
						Best practice
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=best-practice&posts_per_page=5')?>
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
						<span class="more-link"><a href="/category/departments/dnd/upcoming-events">More</a></span>
						Upcoming events 
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=upcoming-events&posts_per_page=5')?>
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