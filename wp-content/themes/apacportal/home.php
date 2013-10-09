<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar()?>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/apac-news">More</a></span>
						APAC News
					</header>
					<div class="content" style="height:135px; padding: 0;">
						<div class="slider" id="slider192" style="width: 530px; height:135px; position: absolute;"> 
							<div class="sliderContent" style="width: 530px; height:135px">
								<?query_posts('category_name=apac-news&posts_per_page=3')?>
								<?while(have_posts()):the_post();?>
								<div class="item">
									<a href="<?the_permalink()?>">
										<?the_post_thumbnail('home-news-slider')?>
										<summary><?the_title()?></summary>
									</a>
								</div>
								<?endwhile;?>
							</div>
						</div>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/internal-news">More</a></span>
						Internal News
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=internal-news&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="http://scoop.chrysler.com/category/international" target="_target">More</a></span>
						Global News
					</header>
					<div class="content">
						<?php // Get RSS Feed(s)
						// Get a SimplePie feed object from the specified feed source.
						$rss = fetch_feed( 'http://scoop.chrysler.com/category/international/feed' );

						if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly

							// Figure out how many total items there are, but limit it to 5. 
							$maxitems = $rss->get_item_quantity( 5 ); 

							// Build an array of all the items, starting with element 0 (first element).
							$rss_items = $rss->get_items( 0, $maxitems );

						endif;
						?>

						<ul>
							<?php if ( $maxitems == 0 ) : ?>
								<li><?php _e( 'No items', 'my-text-domain' ); ?></li>
							<?php else : ?>
								<?php // Loop through each feed item and display each item as a hyperlink. ?>
								<?php foreach ( $rss_items as $item ) : ?>
									<li>
										<a href="<?php echo esc_url( $item->get_permalink() ); ?>"
											title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>"
											target="_blank">
											<?php echo esc_html( $item->get_title() ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/notices">More</a></span>
						Notices
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=notices&posts_per_page=5')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?the_permalink()?>" target="_blank"><?the_title()?></a></li>
							<?endwhile;?>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/quick-links">More</a></span>
						Quick Links
					</header>
					<div class="content">
						<ul>
							<?query_posts('category_name=quick-links&posts_per_page=5')?>
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