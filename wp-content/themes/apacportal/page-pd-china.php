<?php get_header(); ?>
<div id="primary" class="content-area">
	<div id="content" class="site-content row-fluid" role="main">
		<div class="span3">
			<div class="box">
				<header>China Product Engineering
				</header>
			</div>
			<div class="box">
				<header>Organization</header>
				<div class="content" style="min-height: 0;">
					<?=apacportal_post_list('organization-china');?>
				</div>
			</div>
			<div class="box">
				<header>Contacts and Logistics Information</header>
				<div class="content">
					<?=apacportal_post_list('contacts-logistics-information',-1);?>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box">
				<div class="content">
					<img src="<?=get_stylesheet_directory_uri()?>/images/pd/china-map.png" style="width: 30%; margin: auto; display: block;" />
					<b>Brief Introduction: </b>
					<p>
						China Product Engineering is the largest department under APAC Product Development. It is the team that undertakes all major projects and the majority of engineering activities. It has a team of diverse cultural background, which includes Chinese, Italian, American, Canandian, Korean, Indian, and Hungarian. 
					</p>
					<p>
						China Product Engineering locates on 4th floor of FIAT-CHRYSLER office in Zizhu Park, Shanghai, CHINA.
					</p>
					<p>
						Our goal is to deliver efficient, quality, affordable and safe cars for our customers all over APAC! 
					</p>
				</div>
			</div>
			<div class="box">
				<header>Forms and Templates
					<span class="more-link"><a href="/category/departments/pd/china/forms-templates/">More</a></span>
				</header>
				<div class="content">
					<ul>
						<?=apacportal_post_list('forms-templates');?>
					</ul>
				</div>
			</div>
		</div>
		<div class="span3 col-right">
			<div class="box">
				<header>Policy and Process
					<span class="more-link"><a href="/category/departments/pd/china/policy-process-china/">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('policy-process-china');?>
				</div>
			</div>
			<div class="box">
				<header>Employee Council
					<span class="more-link"><a href="/category/departments/pd/china/employee-council/">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('employee-council');?>
				</div>
			</div>
			<div class="box">
				<header>IT Support
					<span class="more-link"><a href="/category/departments/pd/china/it-support/">More</a></span>
				</header>
				<div class="content">
					<?=apacportal_post_list('it-support');?>
				</div>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>