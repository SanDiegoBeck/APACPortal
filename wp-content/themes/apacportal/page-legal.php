<?php get_header(); ?>

	<div id="primary" class="content-area page-india">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<div class="content">
						<img src="<?=get_stylesheet_directory_uri()?>/images/legal/logo.jpg" />
					</div>
				</div>
				<div class="box market-list">
					<header>
						Our Team
						<span class="more-link"><a href="/category/department/legal/our-team-legal/">More</a></span>
					</header>
					<div class="content">
						<?=apacportal_post_list('our-team-legal')?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<div class="content">
						<p>The APAC legal team is responsible for the delivery of legal services to Fiat Chrysler APAC entities which include Chrysler Asia Pacific Investment Co., Ltd., Chrysler Group (China) Sales Limited, Mopar (Shanghai) Auto Parts Trading Co., Ltd., Chrysler (Hong Kong) Automotive Ltd., Chrysler Australia Pty Ltd., Chrysler Japan Co., Ltd., Chrysler Korea Limited, Chrysler South East Asia Pte. Ltd., Fiat China Business Co., Ltd., Fiat legal Technologies (Shanghai) R&D Co., Ltd., Fiat Group Automobiles India, and Fiat Japan Co., Ltd. We also support Fiat Chrysler’s investment in the APAC region, as well as shareholder relationship in relation to GAC Fiat Automobiles Co., Ltd., Fiat India Automobiles Limited, and Hangzhou IVECO Automobile Transmission Technology Co., Ltd.. The APAC legal team handles a broad range of legal matters affecting virtually every aspect of Fiat Chrysler APAC`s business.</p>
						<p>The APAC legal team is a client-driven, service organization committed to providing Fiat Chrysler APAC with world-class legal support in an efficient and highly responsive manner.</p>
						<p>We encourage you to provide us with your suggestions for any enhancements that would assist us in better serving you.</p>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/legal/our-services">More</a></span>
						Our Services
					</header>
					<div class="content">
						<?=apacportal_post_list('our-services')?>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<div class="content" style="height: 245px; padding-top: 25px;">
						<img src="<?=get_stylesheet_directory_uri()?>/images/legal/libra.png" />
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/legal/policies-legal">More</a></span>
						Policies
					</header>
					<div class="content">
						<?=apacportal_post_list('policies-legal')?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
