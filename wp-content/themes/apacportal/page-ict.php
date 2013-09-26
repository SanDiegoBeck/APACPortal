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
					<header>Mission
					</header>
					<div class="content">
						Be an agile and  innovative business partner providing high quality, cost effective and secure technology solutions.
					</div>
				</div>
				<div class="box">
					<header>Employee of the Month
					</header>
					<div class="content">
						<dl class="dl-horizontal employee-this-month">
							<dt>
								<img src="<?=get_stylesheet_directory_uri()?>/images/ict/employee.jpg">
							</dt>
							<dd>
								<ul>
									<li>Mark Zuckerberg</li>
									<li>ICT
									<li>New Comer</li>
								</ul>
							</dd>
						</dl>
					</div>
				</div>
				<div class="box">
					<header>
						Resources
						<span class="more-link"><a href="/resources">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('post_parent=33&post_type=attachment&post_status=any')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?=wp_get_attachment_url()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
							<li><a href="/coming-soon">Projects</a></li>
							<li><a href="/coming-soon">ICT Abbreviations</a></li>
							<li><a href="/coming-soon">ICT Orgnizations</a></li>
							<li><a href="/coming-soon">Favorite Links</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>News
						<span class="more-link"><a href="/category/departments/ict/news">More</a></span>
					</header>
					<div class="content">
						<?query_posts('category_name=departments/ict/news&posts_per_page=1')?>
						<?the_post()?>
						<a href="<?the_permalink()?>"><h4><?the_title()?></h4></a>
						<summary><?the_excerpt()?></summary></a>
					</div>
				</div>
				<div class="box">
					<header>
						Technology Update
						<span class="more-link"><a href="/category/departments/ict/technology-updates">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/ict/technology-updates&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>
						Policies
						<span class="more-link"><a href="/policies">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('post_parent=54&post_type=attachment&post_status=any&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><?the_attachment_link()?></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>Processes
						<span class="more-link"><a href="/processes">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('post_parent=100&post_type=attachment&post_status=any&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><?the_attachment_link()?></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>How to
						<span class="more-link"><a href="/how-tos">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('post_parent=112&post_type=attachment&post_status=any&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><?the_attachment_link()?></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>