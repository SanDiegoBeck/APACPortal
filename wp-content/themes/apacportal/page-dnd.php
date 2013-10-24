<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>
						Mission
					</header>
					<div class="content">
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/dnd/the-people-behind-the-department">More</a></span>
						The people behind the department 
					</header>
					<div class="content">
						<?=apacportal_post_list('the-people-behind-the-department');?>
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
						<?=apacportal_post_list('news-from-the-markets');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/dnd/best-practice">More</a></span>
						Best practice
					</header>
					<div class="content">
						<?=apacportal_post_list('best-practice');?>
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
						<?=apacportal_post_list('upcoming-events');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>