<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<div class="content" style="min-height: 0; overflow: hidden;">
					<img src="<?=get_stylesheet_directory_uri()?>/images/purchasing/logo.png">
				</div>
			</div>
			<div class="box">
				<header>Organization
					<span class="more-link"><a href="/category/departments/purchasing/organization">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('organization');?>
				</div>
			</div>
			<div class="box">
				<header>Training
					<span class="more-link"><a href="/category/departments/purchasing/training">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('training');?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<header>News & Events
					<span class="more-link"><a href="/category/departments/purchasing/news-events">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('news-events');?>
				</div>
			</div>
			<div class="box">
				<header>Redbook
					<span class="more-link"><a href="/category/departments/purchasing/redbook">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('redbook');?>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Policies & Process
					<span class="more-link"><a href="/category/departments/purchasing/policies-process">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('policies-process');?>
				</div>
			</div>
			<div class="box">
				<header>ROE
					<span class="more-link"><a href="/category/departments/purchasing/roe">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('roe');?>
				</div>
			</div>
			<div class="box">
				<header>Contacts
					<span class="more-link"><a href="/category/departments/purchasing/contacts">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('contacts');?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?wp_reset_query()?>
<?php get_footer(); ?>
