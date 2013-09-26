<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>Corporate History
						<span class="more-link"><a href="/category/departments/communication/corporate-history">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/communication/corporate-history&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="box">
					<header>Product Pictures
						<span class="more-link"><a href="/category/departments/communication/product-pictures">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/communication/product-pictures&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>Corporate Image
						<span class="more-link"><a href="/category/departments/communication/corporate-image">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/communication/corporate-image&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>Executive Photos
						<span class="more-link"><a href="/category/departments/communication/executive-photos">More</a></span>
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=departments/communication/executive-photos&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>Press Releases
						<span class="more-link"><a href="/press-releases">More</a></span>
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

<?php get_footer(); ?>