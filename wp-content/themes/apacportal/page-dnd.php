<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>Dealer Network Development
					</header>
				</div>
				<div class="box">
					<header>
						Mission
					</header>
					<div class="content">
						<?=apacportal_post_list('mission');?>
					</div>
				</div>
				<div class="box">
					<header>
						Our Team
					</header>
					<div class="content">
						<?=apacportal_post_list('the-people-behind-the-department',-1,array('order'=>'ASC','orderby'=>'ID'));?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/dnd/news-from-the-markets">More</a></span>
						News
					</header>
					<div class="content">
						<?=apacportal_post_list('news-from-the-markets');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/dnd/best-practice">More</a></span>
						Best Practice
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
						Future Events
					</header>
					<div class="content">
						<?=apacportal_post_list('upcoming-events');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>