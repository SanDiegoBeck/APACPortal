<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>
						Corporate History
					</header>
					<div class="content">
						<?=apacportal_post_list('corporate-history');?>
					</div>
				</div>
				<div class="box">
					<header>
						Executives
					</header>
					<div class="content">
						<?query_posts('category_name=departments/communication/executive-photos&order=ASC&posts_per_page=-1')?>
						<?while(have_posts()):the_post();?>
						<dl class="dl-horizontal employee-this-month">
							<dt>
								<?the_post_thumbnail('thumbnail')?>
							</dt>
							<dd>
								<ul>
									<li><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
									<summary><?the_excerpt()?></summary>
								</ul>
							</dd>
						</dl>
						<?endwhile;?>
					</div>
				</div>
				<div class="box">
					<header>
						Corporate Image
					</header>
					<div class="content">
						<?=apacportal_post_list('corporate-image');?>
					</div>
				</div>
			</div>
			<div class="span9">
				<div class="box product-picture">
					<header>
						Product Pictures
					</header>
					<div class="content">
					<?foreach(get_posts(array('category_name'=>'product-pictures','order'=>'ASC','posts_per_page'=>-1)) as $post){?>
						<dl>
							<dt><a href="<?the_permalink()?>" target="_blank"><?the_post_thumbnail('thumbnail')?></a></dt>
							<dd><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></dd>
						</dl>
					<?}?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/communication/press-releases">More</a></span>
						Press Releases
					</header>
					<div class="content">
						<?=apacportal_post_list('press-releases');?>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
