<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<header>India Product Engineering
				</header>
			</div>
			<div class="box">
				<header>Workplace
					<span class="more-link"><a href="/category/departments/pd/india/workplace">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('workplace');?>
				</div>
			</div>
			<div class="box">
				<header>Products
					<span class="more-link"><a href="/category/departments/pd/india/products">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('products');?>
				</div>
			</div>
			<div class="box">
				<header>Pay and Benefits
					<span class="more-link"><a href="/category/departments/pd/india/pay-and-benefits">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('pay-and-benefits');?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<header>Newsletter
					<span class="more-link"><a href="/category/departments/pd/india/news-letter">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?=apacportal_post_list('news-letter');?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Services
					<span class="more-link"><a href="/category/departments/pd/india/services">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?=apacportal_post_list('services');?>
					</ul>
				</div>
			</div>
			<div class="box">
				<header>Going Abroad
					<span class="more-link"><a href="/category/departments/pd/india/going-abroad">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?=apacportal_post_list('going-abroad');?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>About Us
					<span class="more-link"><a href="/category/departments/pd/india/about-us">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('about-us');?>
				</div>
			</div>
			<div class="box">
				<header>Visiting India
					<span class="more-link"><a href="/category/departments/pd/india/visiting-india">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('visiting-india');?>
				</div>
			</div>
			<div class="box">
				<header>Quick Links
					<span class="more-link"><a href="/category/departments/pd/india/quick-links">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('quick-links');?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
