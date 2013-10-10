<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>
						Corporate History
					</header>
					<div class="content">
						<ul>
							<li><a href="/category/departments/communication/corporate-history/fiat-group/">Fiat Group</a></li>
							<li><a href="/category/departments/communication/corporate-history/chrysler-group-llc/">Chrysler Group LLC</a></li>
							<li><a href="/heritage/">Heritage</a></li>
							<li><a href="/category/departments/communication/corporate-history/about-the-founders/">About the Founders</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="box">
					<header>
						Product Pictures
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/communication/product-pictures&order=ASC&posts_per_page=-1')?>
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
						Corporate Image
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/communication/corporate-image&order=ASC&posts_per_page=-1')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						Executives
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/communication/executive-photos&order=ASC&posts_per_page=-1')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/press-releases">More</a></span>
						Press Releases
					</header>
					<div class="content">
						<ul>
							<?query_posts('post_parent=225&post_type=attachment&post_status=any&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><?the_attachment_link()?></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<?get_sidebar('market-list')?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?wp_reset_query()?>
<?php get_footer(); ?>
