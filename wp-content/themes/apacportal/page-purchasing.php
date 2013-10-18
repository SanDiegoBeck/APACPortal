<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<div class="content" style="min-height: 0;">
					<img src="<?=get_stylesheet_directory_uri()?>/images/purchasing/logo.png">
				</div>
			</div>
			<div class="box">
				<header>Organization
					<span class="more-link"><a href="/category/departments/purchasing/organization">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=organization&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Training
					<span class="more-link"><a href="/category/departments/purchasing/training">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=training&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<header>News & Events
					<span class="more-link"><a href="/category/departments/purchasing/news-events">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=news-eventsfiat-apac-purchasing&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Redbook
					<span class="more-link"><a href="/category/departments/purchasing/redbook">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=redbook&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Policies & Process
					<span class="more-link"><a href="/category/departments/purchasing/policies-process">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=policies-process&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>ROE
					<span class="more-link"><a href="/category/departments/purchasing/roe">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=roe&posts_per_page=5')?>
						<?while(have_posts()):the_post();?>
						<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
						<?endwhile;?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Contacts
					<span class="more-link"><a href="/category/departments/purchasing/contacts">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?query_posts('category_name=contacts&posts_per_page=5')?>
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
