<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<header>Welcome to China Product Engineering
				</header>
			</div>
			<div class="box">
				<header>Organization
				</header>
				<div class="content" style="min-height: 0;">
					<b>China product engineering - leadership team</b>
				</div>
			</div>
			<div class="box">
				<header>Contacts and Logistics Information
					<span class="more-link"><a href="/category/departments/pd/china/contacts-and-logistics-information">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('contacts-and-logistics-information');?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<div class="content">
					<img src="<?=get_stylesheet_directory_uri()?>/images/pd/china-map.png" style="width: 30%; margin: auto; display: block;" />
					<p>
						<b>Brief Introduction: </b>China Product Engineering is the largest department under APAC Product Development. It is the team that undertakes all major projects and the majority of engineering activities. It has a team of diverse cultural background, which includes Chinese, Italian, American, Canandian, Korean, Indian, and Hungarian. 
						China Product Engineering locates on 4th floor of FIAT-CHRYSLER office in Zizhu Park, Shanghai, CHINA.
						Our goal is to deliver efficient, quality, affordable and safe cars for our customers all over APAC! 
					</p>
				</div>
			</div>
			<div class="box">
				<header>Forms and Templates
					<span class="more-link"><a href="/category/departments/pd/china/forms-and-templates">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?=apacportal_post_list('forms-and-templates');?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Policy and Process
					<span class="more-link"><a href="/category/departments/pd/china/policy-and-process">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('policy-and-process');?>
				</div>
			</div>
			<div class="box">
				<header>Employee Council
					<span class="more-link"><a href="/category/departments/pd/china/employee-council">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('employee-council');?>
				</div>
			</div>
			<div class="box">
				<header>IT Support
					<span class="more-link"><a href="/category/departments/pd/china/it-support">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('it-support');?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>
