<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar('left')?>
				<div class="box department-list">
					<header>
						Joint Ventures
					</header>
					<div class="content" style="min-height: 0">
						<!--<?=apacportal_post_list('joint-ventures',-1,array('orderby'=>'ID','order'=>'ASC'));?>-->
						<ul>
							<li class="coming-soon" style="height: 30px;">
								<a href="#">GAC FIAT</a>
							</li>
							<li class="coming-soon">
								<a href="#">FIAL</a>
							</li>
							<li class="coming-soon">
								<a href="#">HAVECO</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="span9">
				<div class="row-fluid">
					<div class="span6">
						<div class="box department-list">
							<header>
								Industrial
							</header>
							<div class="content">
								<ul>
									<li>
										<a href="/work/manufacturing/">Manufacturing</a>
									</li>
									<li class="coming-soon">
										<a href="#">Powertrain</a>
									</li>
									<li class="coming-soon">
										<a href="#">Product Portfolio</a>
									</li>
									<li>
										<a href="/work/purchasing/">Purchasing and Supplier Quality</a>
									</li>
									<li>
										<a href="/work/quality/">Quality</a>
									</li>
									<li class="coming-soon">
										<a href="/work/pd/">Product Development</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="box department-list">
							<header>
								Corporate
							</header>
							<div class="content">
								<ul>
									<li>
										<a href="/work/bd/">Business Development</a>
									</li>
									<li>
										<a href="/work/communication/">Corporate Communications</a>
									</li>
									<li>
										<a href="/work/ehs/">Environment, Health and Safety (EHS)</a>
									</li>
									<li>
										<a href="/work/administration/">Facilities and Administration</a>
									</li>
									<li class="coming-soon">
										<a href="#">Finance</a>
									</li>
									<li class="coming-soon">
										<a href="#">General Counsel</a>
									</li>
									<li>
										<a href="/work/hr/">Human Resources</a>
									</li>
									<li>
										<a href="/work/ict/">Information and Communication Technology (ICT)</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="span6">
						<?get_sidebar('market-list')?>
						<div class="box department-list">
							<header>
								Commercial
							</header>
							<div class="content">
								<ul>
									<li>
										<a href="/work/dnd/">Dealer Network Development</a>
									</li>
									<li>
										<a href="/work/marketing/">Marketing</a>
									</li>
									<li class="coming-soon">
										<a href="#">MOPAR - Parts and Service</a>
									</li>
									<li>
										<a href="/work/scm/">Supply Chain Management</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>