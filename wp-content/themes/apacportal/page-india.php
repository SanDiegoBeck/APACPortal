<?php get_header(); ?>

	<div id="primary" class="content-area page-india">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>APAC Tech Center, Chennai</header>
				</div>
				<div class="box market-list">
					<header>About Us</header>
					<div class="content">
						<?=apacportal_post_list('about-us-india-market',-1)?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/market/india/products-india-market">More</a></span>
						Products
					</header>
					<div class="content">
						<?=apacportal_post_list('products-india-market')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/market/india/work-place-india-market">More</a></span>
						Work Place
					</header>
					<div class="content">
						<?=apacportal_post_list('work-place-india-market')?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/market/india/news-india-market">More</a></span>
						News
					</header>
					<div class="content">
						<?=apacportal_post_list('news-india-market')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/market/india/services-india-market">More</a></span>
						Services
					</header>
					<div class="content">
						<?=apacportal_post_list('services-india-market')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/market/india/travel">More</a></span>
						Travel
					</header>
					<div class="content">
						<?=apacportal_post_list('travel')?>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/market/india/pays-benefits">More</a></span>
						Pays & Benefits
					</header>
					<div class="content">
						<?=apacportal_post_list('pays-benefits')?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/market/india/quick-links-india-market">More</a></span>
						Quick Links
					</header>
					<div class="content">
						<?=apacportal_post_list('quick-links-india-market')?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
