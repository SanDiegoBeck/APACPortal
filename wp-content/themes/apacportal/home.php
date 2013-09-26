<?php get_header(); ?>

<style>
	.box header{
		background: #EFF4F7 url('/wp-content/themes/apacportal/images/navbg.png') repeat-x;
		font-weight: bold;
	}
</style>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar()?>
			</div>
			<div class="span6">
				<div class="box">
					<header>APAC News
						<span class="more-link">More</span>
					</header>
					<div class="content" style="height: 135px; padding: 5px 0;">
						<div class="slider" id="slider192" style="width: 530px; height:135px; position: absolute;"> 
							<div class="sliderContent" style="width: 530px; height:135px">
								<div class="item">
									<a href="">
										<img src="<?=get_stylesheet_directory_uri()?>/images/news_0.jpg" alt="News 0">
										<div style="position: relative; top:-1.5em; color: #FFF; background: rgba(0,0,0,0.5); padding-left: 1em;">News Title News Title News Title News Title News Title News Title</div>
									</a>
								</div>
								<div class="item">
									<a href="">
										<img src="<?=get_stylesheet_directory_uri()?>/images/news_5.jpg" alt="News 0">
										<div style="position: relative; top:-1.5em; color: #FFF; background: rgba(0,0,0,0.5); padding-left: 1em;">News Title News Title News Title News Title News Title News Title</div>
									</a>
								</div>
								<div class="item">
									<a href="">
										<img src="<?=get_stylesheet_directory_uri()?>/images/news_6.jpg" alt="News 0">
										<div style="position: relative; top:-1.5em; color: #FFF; background: rgba(0,0,0,0.5); padding-left: 1em;">News Title News Title News Title News Title News Title News Title</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box">
					<header>Internal News
						<span class="more-link">More</span>
					</header>
					<div class="content">
						<ul>
							<li><a href="#">Mopar® at the 2013 Frankfurt International Motor Show</a></li>
							<li><a href="#">Panda 4x4 Antartica, Freemont Black Code, new 500 engines at Frankfurt 2013</a></li>
							<li><a href="#">FIAT Freestyle Team is official sponsor of Vans Downtown Showdown 2013</a></li>
							<li><a href="#">Bielsko Biala receives the prestigious Automotive Lean Production Award </a></li>
							<li><a href="#">Fiat is Technical Sponsor of the ‘World Masters Games 2013’.</a></li>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>Global News
						<span class="more-link">More</span>
					</header>
					<div class="content">
						<ul>
							<li><a href="#">Mopar® at the 2013 Frankfurt International Motor Show</a></li>
							<li><a href="#">Panda 4x4 Antartica, Freemont Black Code, new 500 engines at Frankfurt 2013</a></li>
							<li><a href="#">FIAT Freestyle Team is official sponsor of Vans Downtown Showdown 2013</a></li>
							<li><a href="#">Bielsko Biala receives the prestigious Automotive Lean Production Award </a></li>
							<li><a href="#">Fiat is Technical Sponsor of the ‘World Masters Games 2013’.</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="span3 col-right">
				<div class="box">
					<header>Notices
						<span class="more-link">More</span>
					</header>
					<div class="content">
						<ul>
							<li><a href="#">Mopar® at the 2013 Frankfurt International Motor Show</a></li>
							<li><a href="#">Panda 4x4 Antartica, Freemont Black Code, new 500 engines at Frankfurt 2013</a></li>
							<li><a href="#">FIAT Freestyle Team is official sponsor of Vans Downtown Showdown 2013</a></li>
							<li><a href="#">Bielsko Biala receives the prestigious Automotive Lean Production Award </a></li>
							<li><a href="#">Fiat is Technical Sponsor of the ‘World Masters Games 2013’.</a></li>
						</ul>
					</div>
				</div>
				<div class="box">
					<header>Quick Links
						<span class="more-link">More</span>
					</header>
					<div class="content">
						<ul>
							<li><a href="#">Mopar® at the 2013 Frankfurt International Motor Show</a></li>
							<li><a href="#">Panda 4x4 Antartica, Freemont Black Code, new 500 engines at Frankfurt 2013</a></li>
							<li><a href="#">FIAT Freestyle Team is official sponsor of Vans Downtown Showdown 2013</a></li>
							<li><a href="#">Bielsko Biala receives the prestigious Automotive Lean Production Award </a></li>
							<li><a href="#">Fiat is Technical Sponsor of the ‘World Masters Games 2013’.</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>