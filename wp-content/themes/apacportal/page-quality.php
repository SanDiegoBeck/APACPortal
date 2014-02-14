<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>Quality
					</header>
				</div>
				<div class="box">
					<header>
						Who We Are
						<span class="more-link"><a href="/category/departments/quality/who-we-are">More</a></span>
					</header>
					<div class="content">
						<?=apacportal_post_list('who-we-are');?>
					</div>
				</div>
				<div class="box">
					<header>
						What's Happening
						<span class="more-link"><a href="/category/departments/quality/whats-happening">More</a></span>
					</header>
					<div class="content">
						<?=apacportal_post_list('whats-happening');?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<div class="content" style="padding: 0;">
						<img src="<?=get_stylesheet_directory_uri()?>/images/quality/team.jpg" style="width: 100%" />
					</div>
				</div>
				<div class="box">
					<header>
						Who We Are
						<span class="more-link"><a href="/category/departments/quality/who-we-are">More</a></span>
					</header>
					<div class="content">
						<?=apacportal_post_list('who-we-are');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/quality/why-we-are-here">More</a></span>
						Why We Are Here
					</header>
					<div class="content">
						<?=apacportal_post_list('why-we-are-here');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/quality/how-we-are-connected">More</a></span>
						How We Are Connected
					</header>
					<div class="content">
						<?=apacportal_post_list('how-we-are-connected');?>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/quality/im-looking-for">More</a></span>
						I’m Looking For
					</header>
					<div class="content">
						<?=apacportal_post_list('im-looking-for');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/departments/quality/i-want-to-learn-about">More</a></span>
						I Want to Learn About
					</header>
					<div class="content">
						<?=apacportal_post_list('i-want-to-learn-about');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>