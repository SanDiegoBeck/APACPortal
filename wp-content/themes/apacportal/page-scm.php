<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<header>Supply Chain Management
				</header>
				<div class="content" style="height: 140px;">
					<img src="<?=get_stylesheet_directory_uri()?>/images/scm/logo.jpg" />
				</div>
			</div>
			<div class="box">
				<header>Business Mission
				</header>
				<div class="content" style="min-height: 0;">
					<b>To provide world-class SCM services on time, with high quality at competitive costs.</b>
				</div>
			</div>
			<div class="box">
				<header>Organization Introduction
					<span class="more-link"><a href="/category/departments/scm/organization-introduction">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('organization-introduction')?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<header>Industry News
					<span class="more-link"><a href="/category/departments/scm/industry-news">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('industry-news')?>
				</div>
			</div>
			<div class="box">
				<header>SCM News
					<span class="more-link"><a href="/category/departments/scm/scm-news">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?=apacportal_post_list('scm-news')?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Knowledge Folder
					<span class="more-link"><a href="/category/departments/scm/scm-knowledge-folder">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('scm-knowledge-folder')?>
				</div>
			</div>
			<div class="box">
				<header>Useful Websites
					<span class="more-link"><a href="/category/departments/scm/useful-website">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('useful-website')?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
