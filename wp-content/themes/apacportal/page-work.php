<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar('left')?>
				<div class="box department-list">
					<header>
						Joint Ventures
					</header>
					<div class="content">
						<?=apacportal_post_list('joint-ventures',-1,array('orderby'=>'ID','order'=>'ASC'));?>
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
									<li class="coming-soon">
										<a href="/manufacturing">Manufacturing</a>
									</li>
									<li class="coming-soon">
										<a href="/powertrain">Powertrain</a>
									</li>
									<li class="coming-soon">
										<a href="/pp">Product Portfolio</a>
									</li>
									<li>
										<a href="/purchasing">Purchasing and Supplier Quality</a>
									</li>
									<li class="coming-soon">
										<a href="/quality">Quality</a>
									</li>
									<li class="coming-soon">
										<a href="/rnd">Research and Development</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="box department-list">
							<header>
								Corporate Function
							</header>
							<div class="content">
								<ul>
									<li class="coming-soon">
										<a href="/bd">Business Development</a>
									</li>
									<li>
										<a href="/communication">Corporate Communication</a>
									</li>
									<li>
										<a href="/administration">Facilities and Administration</a>
									</li>
									<li class="coming-soon">
										<a href="/finance">Finance</a>
									</li>
									<li class="coming-soon">
										<a href="/gc">General Counsel</a>
									</li>
									<li class="coming-soon">
										<a href="/gr">Goverment Relations</a>
									</li>
									<li>
										<a href="/hr">Human Resources</a>
									</li>
									<li>
										<a href="/ict">Information and Communication Technology (ICT)</a>
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
										<a href="/dnd">Dealer Network Development</a>
									</li>
									<li>
										<a href="/marketing">Marketing</a>
									</li>
									<li class="coming-soon">
										<a href="/ps">MOPAR - Parts and Service</a>
									</li>
									<li>
										<a href="/scm">Supply Chain Management</a>
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