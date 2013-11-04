<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar('left')?>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/apac-news">More</a></span>
						APAC News
					</header>
					<div class="content" style="min-height: 0; height:188px; padding: 0;">
						<div class="slider" id="slider192" style="width: 526px; height:188px; position: absolute;"> 
							<div class="sliderContent" style="width: 526px; height:188px">
								<?query_posts('category_name=apac-news&posts_per_page=3')?>
								<?while(have_posts()):the_post();?>
								<div class="item" style="width:526px; height:188px">
									<a href="<?the_permalink()?>">
										<?the_post_thumbnail('home-news-slider')?>
									</a>
									<summary><?the_title()?></summary>
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
						<?=apacportal_post_list('internal-news');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link" style="margin: auto 0.5em;"><a href="http://scoop.chrysler.com/category/international" target="_blank">Scoop</a></span>
						<span class="more-link"><a href="http://www.fiatspa.com/en-US/media_center/Pages/default.aspx" target="_blank">FIAT</a> &nbsp;&nbsp;|</span>
						Global News
					</header>
					<div class="content">
						<?php // Get RSS Feed(s)
						// Get a SimplePie feed object from the specified feed source.
						$rss_chrysler = fetch_feed( 'http://scoop.chrysler.com/category/international/feed' );
						$rss_fiat = fetch_feed( 'http://www.fiatspa.com/en-US/media_center/_layouts/15/listfeed.aspx?List=7F16150F-5594-419A-8A89-4F567AF5CEC8' );

						if ( ! is_wp_error( $rss_chrysler ) ) : // Checks that the object is created correctly

							// Figure out how many total items there are, but limit it to 5. 
							$maxitems = $rss_chrysler->get_item_quantity( 3 ); 

							// Build an array of all the items, starting with element 0 (first element).
							$rss_items_chrysler = $rss_chrysler->get_items( 0, $maxitems );

						endif;
						
						if ( ! is_wp_error( $rss_fiat ) ) : // Checks that the object is created correctly

							// Figure out how many total items there are, but limit it to 5. 
							$maxitems = $rss_fiat->get_item_quantity( 3 ); 

							// Build an array of all the items, starting with element 0 (first element).
							$rss_items_fiat = $rss_fiat->get_items( 0, $maxitems );

						endif;
						?>
						<ul>
							<?php if ( $maxitems == 0 ) : ?>
								<li><?php _e( 'No items', 'my-text-domain' ); ?></li>
							<?php else : ?>
								<?php // Loop through each feed item and display each item as a hyperlink. ?>
								<?php foreach ( (array)$rss_items_chrysler as $item ) : ?>
									<li>
										<a href="<?php echo esc_url( $item->get_permalink() ); ?>"
											title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>"
											target="_blank">
											<?php echo esc_html( $item->get_title() ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
							
							<?php if ( $maxitems == 0 ) : ?>
								<li><?php _e( 'No items', 'my-text-domain' ); ?></li>
							<?php else : ?>
								<?php // Loop through each feed item and display each item as a hyperlink. ?>
								<?php foreach ( (array)$rss_items_fiat as $item ) : ?>
									<li>
										<a href="<?php echo esc_url( $item->get_permalink() ); ?>"
											title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>"
											target="_blank">
											<?php echo str_replace('_',' ',esc_html( $item->get_title() )); ?>
										</a>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box" id="notices">
					<header>
						<span class="more-link"><a href="/category/notices">More</a></span>
						Notices
					</header>
					<div class="content">
						<?=apacportal_post_list('notices');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/quick-links">More</a></span>
						Quick Links
					</header>
					<div class="content">
						<?=apacportal_post_list('quick-links');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>