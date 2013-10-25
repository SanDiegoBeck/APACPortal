<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
				<div class="box">
					<header>Supply Chain Management
					</header>
				</div>
			<div class="box">
				<div class="content">
					<img src="" />
				</div>
			</div>
			<div class="box">
				<header>Mission
				</header>
				<div class="content" style="height: 280px; overflow-y: auto;">
					<?query_posts('category_name=scm-mission&posts_per_page=1')?>
					<?the_post()?>
					<a href="<?the_permalink()?>"><h4><?the_title()?></h4></a>
					<summary><?the_content()?></summary></a>
				</div>
			</div>
			<div class="box">
				<header>Organization Introduction
					<span class="more-link"><a href="/category/departments/scm/organization-introduction">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('organization-introduction');?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<header>News
					<span class="more-link"><a href="/category/departments/scm/scm-news">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?=apacportal_post_list('scm-news');?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Industry News
					<span class="more-link"><a href="/category/departments/scm/industry-news">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('industry-news');?>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Knowledge Folder
					<span class="more-link"><a href="/category/departments/scm/scm-knowledge-folder">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('scm-knowledge-folder');?>
				</div>
			</div>
			<div class="box">
				<header>Useful Websites
					<span class="more-link"><a href="/category/departments/scm/useful-website">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('useful-website');?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
