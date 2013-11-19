<?php get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<div class="box">
					<header>Human Resources
					</header>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/hr-announcement-notice">More</a></span>
						Announcements & Notices
					</header>
					<div class="content">
						<?=apacportal_post_list('hr-announcement-notice');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/hr-contact">More</a></span>
						Contacts
					</header>
					<div class="content">
						<?=apacportal_post_list('hr-contact');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/expatriate-management">More</a></span>
						Expatriate Management
					</header>
					<div class="content">
						<?=apacportal_post_list('expatriate-management');?>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/total-compensation">More</a></span>
						Total Compensation
					</header>
					<div class="content">
						<ul>
							<li>Coming Soon</li>
						</ul>
						<!--<?=apacportal_post_list('total-compensation');?>-->
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/training-development">More</a></span>
						Training & Development
					</header>
					<div class="content">
						<?=apacportal_post_list('training-development');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/plm-sap">More</a></span>
						PLM & SAP
					</header>
					<div class="content">
						<?=apacportal_post_list('plm-sap');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/organizational-charts">More</a></span>
						Organizational Charts
					</header>
					<div class="content">
						<?=apacportal_post_list('organizational-charts');?>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/policy-process">More</a></span>
						Policies & Processes
					</header>
					<div class="content">
						<?=apacportal_post_list('policy-process');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/forms">More</a></span>
						Forms
					</header>
					<div class="content">
						<?=apacportal_post_list('forms');?>
					</div>
				</div>
				<div class="box">
					<header>
						<span class="more-link"><a href="/category/department/hr/career-opportunities">More</a></span>
						Career Opportunities
					</header>
					<div class="content">
						<?=apacportal_post_list('career-opportunities');?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>