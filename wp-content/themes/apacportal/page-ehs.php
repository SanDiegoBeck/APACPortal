<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<header>Environment, Health and Safety</header>
			</div>
			<div class="box">
				<header>Team & Contact Information
					<span class="more-link"><a href="/category/departments/ehs/ehs-team-contact-information">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('ehs-team-contact-information');?>
				</div>
			</div>
			<div class="box">
				<header>Quick Links
					<span class="more-link"><a href="/category/departments/ehs/quick-links-ehs">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('quick-links-ehs');?>
				</div>
			</div>
			<div class="box">
				<header>Emegency Evacuation Plans
					<span class="more-link"><a href="/category/departments/ehs/emergency-evacuation-plans">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('emergency-evacuation-plans');?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<div class="content">
					<div style="text-align: center"><img src="<?=get_stylesheet_directory_uri()?>/images/ehs/logo.png"></div>
					<p><b>MISSION STATEMENT</b>: The APAC Environment, Health and Safety (EHS) team is dedicated to reduce injuries, accidents and environmental impact and are committed to complying with regulatory and corporate requirements on environment, health and safety, regulations, policies and procedures.</p>
					<p>The EHS program reduces these risks through partnerships with APAC employees, joint venture companies and visitors at our facilities. We achieve this by providing high quality training, comprehensive workplace inspections, emergency response programs and hazardous materials management from acquisition to disposal while setting goals and objectives to continuously improve environment, health and safety performances.</p>
				</div>
			</div>
			<div class="box">
				<header>EHS Awards/Recognition
					<span class="more-link"><a href="/category/departments/ehs/ehs-awardsrecognition">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('ehs-awardsrecognition');?>
				</div>
			</div>
			<div class="box">
				<header>EHS Bulletin - News
					<span class="more-link"><a href="/category/departments/ehs/ehs-bulletin-news">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('ehs-bulletin-news');?>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Environment
					<span class="more-link"><a href="/category/departments/ehs/environment">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('environment');?>
				</div>
			</div>
			<div class="box">
				<header>Health and Safety
					<span class="more-link"><a href="/category/departments/ehs/health-and-safety">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('health-and-safety');?>
				</div>
			</div>
			<div class="box">
				<header>WCM Corner
					<span class="more-link"><a href="/category/departments/ehs/wcm-corner">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('wcm-corner');?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
