<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar('left')?>
			</div>
			<div class="span6">
				<div class="box">
					<header>Useful Links
					</header>
					<div class="content">
						<ul>
							<li><a href="http://www.embassyworld.com/" target="_blank">Embassies</a></li>
							<li><a href="http://www.timeanddate.com/worldclock/dialing.html?p2=99" target="_blank">International Dialing Codes</a></li>
							<li><a href="http://www.timeanddate.com/worldclock/" target="_blank">Time Zones</a></li>
							<li><a href="http://www.oanda.com/currency/converter/" target="_blank">Currency Converter</a></li>
							<li><a href="http://www.timeanddate.com/weather/" target="_blank">Weather</a></li>
							<li><a href="http://translate.google.cn/?hl=en" target="_blank">Google Translate</a></li>
							<li><a href="/wp-content/uploads/2013/10/Useful-Apps.pdf" target="_blank">Useful Apps</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="box">
					<header>Quote of the Day
					</header>
					<div class="content" style="min-height: 0;">
						<?php echo do_shortcode('[quotcoll orderby="random" limit=1]')?>
					</div>
				</div>
				<div class="box" id="notices">
					<header>
						<span class="more-link"><a href="/notices">More</a></span>
						Notices
					</header>
					<div class="content">
						<ul>
							<?query_posts('post_parent=1198&post_type=attachment&post_status=any')?>
							<?while(have_posts()):the_post();?>
							<li title="<?the_title()?>"><a href="<?=wp_get_attachment_url()?>" target="_blank"><?the_title()?></a></li>
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

<?php get_footer(); ?>