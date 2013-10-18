<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<div class="content">
					<img src="" />
				</div>
			</div>
			<div class="box">
				<header>SCM Mission
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
					<ul>
						<?query_posts('category_name=organization-introduction&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<header>SCM News
					<span class="more-link"><a href="/category/departments/scm/scm-news">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=scm-news&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Industry News
					<span class="more-link"><a href="/category/departments/scm/industry-news">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=industry-news&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>SCM knowledge Folder
					<span class="more-link"><a href="/category/departments/scm/scm-knowledge-folder">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=scm-knowledge-folder&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Useful Website
					<span class="more-link"><a href="/category/departments/scm/useful-website">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=useful-website&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?wp_reset_query()?>
<?php get_footer(); ?>
