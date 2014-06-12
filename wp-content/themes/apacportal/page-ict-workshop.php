<!DOCTYPE html >
<html lang="en" dir="ltr" class="ms-isBot">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=10" />
		<meta name="GENERATOR" content="Microsoft SharePoint" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="Expires" content="0" />
		<title>APAC ICT Regional Conference</title>
		<?php wp_head(); ?>
		<link href="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/css/screen.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src='<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/js/lib/modernizr-2.7.2.min.js'></script>
		<script type="text/javascript" src='<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/js/lib/jquery-1.10.2.min.js'></script>
		<script type="text/javascript" src='<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/js/lib/plugins.js'></script>
		<script type="text/javascript" src='<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/js/scripts.js'></script>
		<link type="text/xml" rel="alternate" href="http://apaconnect.fiat.chrysler.com/investorday/_vti_bin/spsdisco.aspx" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	</head>

	<body class="interna">

		<div id="s4-workspace">
			<div id="s4-bodyContainer">
				<div class="container-fluid">
					<div class="wrapper-site container">
						<!--header-->
						<header id="header" class="row" style="padding:0 15px;">
							<p class="logo-top col-xs-12">
								<a href="<?= site_url() ?>"><img src="<?= site_url() ?>/wp-content/uploads/2014/04/Fiat-Chrysler-For-Portal-526x188.jpg" class="img-responsive" /></a>
							</p>
							<div class="h-top col-xs-12" style="background: #6e80bf; color: #FFF; padding:20px; text-align: left; font-family:garamond, sans-serif">
								<h2 style="float:left;">APAC ICT</h2>
								<h1 style="float:left;clear:both;">Regional Conference</h1>
								<h3 style="float:right">June. 10<sup>th</sup> - 13<sup>th</sup>, 2014</h3>
							</div>
						</header>
						<!--//header-->
						<!--body-->
						<div class="body">
							<span id="DeltaPlaceHolderMain">

								<div class="page-intro">
									<!--<h1>Lorem ipsum - H1 INTRO</h1>
										 <h2>Lorem ipsum dolor sit amet consectetur adipiscing elit - H2 INTRO</h2>
										 <p>INTRO Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="">Donec nec erat magna.</a> Sed mollis varius nunc, vel rutrum turpis adipiscing sed. Praesent sodales odio vitae nisl aliquet, et lobortis ligula pellentesque. Donec rhoncus urna sapien, eu rhoncus dolor luctus tincidunt. Integer at eros risus. Maecenas lobortis, mi id eleifend elementum, metus est porta justo, in dignissim nunc dui sit amet mi. Vivamus porttitor aliquet magna vitae porttitor.</p>-->

								</div>
								<?php query_posts(array('category_name'=>'ict-workshop', 'post_type'=>'any', 'post_status'=>'inherit')); ?>
								<?php while(have_posts()): the_post(); ?>
								<div class="grid-cards">
									<div class='row cards-row'>
										<div class='card col-sm-12'>
											<div class='row'>
												<div class='c-card col-md-12'> 
													<div class='row'>
														<div class='els col-sm-12'>
															<div class='name'>
																<h3><?php the_excerpt(); ?></h3>
																<h4><?php echo $post->post_content ?></h4>
															</div>
															<div class='list-cp-incard'>
																<div class='row'>
																	<p data-doctype='presentation' class='col-xs-8 col-sm-10'>
																		<a href="<?=wp_get_attachment_url(get_the_ID())?>" class='title' ><?php the_title(); ?></a>
																	</p>
																	<p data-doctype='presentation' class='col-xs-3 col-xs-offset-1  col-sm-2 col-sm-offset-0'>
																		<a href="<?=wp_get_attachment_url(get_the_ID())?>" target='_blank'>
																			<span class='ico ico-pdf-blue'></span><span class='mb'><?=size_format(filesize(get_attached_file($post->ID)));?></span>
																		</a>
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php endwhile; ?>
								<div style='display:none' id='hidZone'><menu class="ms-hide">
										<ie:menuitem id="MSOMenu_Help" iconsrc="/_layouts/15/images/HelpIcon.gif" onmenuclick="MSOWebPartPage_SetNewWindowLocation(MenuWebPart.getAttribute('helpLink'), MenuWebPart.getAttribute('helpMode'))" text="Help" type="option" style="display:none">

										</ie:menuitem>
									</menu></div>
							</span>
						</div>
						<!--//body-->
						<!--footer-->
						<footer class="row-fluid" id="footer">
							<nav>
								<ul>
									<li class="ft-fiat"><a href="http://www.fiat.com/" target="_blank" ><span>Fiat</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/fiat.jpg"></a></li>
									<li class="ft-alfa"><a href="http://www.alfaromeo.com" target="_blank"><span>Alfa Romeo</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/alfaromeo.jpg"></a></li>
									<li class="ft-lancia"><a href="http://www.lancia.com" target="_blank"><span>Lancia</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/lancia.jpg"></a></li>
									<li class="ft-abarth"><a href="http://www.abarth.com/" target="_blank"><span>Abarth</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/abarth.jpg"></a></li>
									<li class="ft-fiatpro"><a href=""http://www.fiatprofessional.com" target="_blank"><span>Fiat professional</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/fiatpro.jpg"></a></li>
									<li class="ft-jeep"><a href="http://www.jeep.com" target="_blank"><span>Jeep</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/jeep.jpg"></a></li>
									<li class="ft-chrysler"><a href="http://www.chrysler.com" target="_blank"><span>Chrysler</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/chrysler.jpg"></a></li>
									<li class="ft-dodge"><a href="http://www.dodge.com" target="_blank"><span>Dodge</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/dodge.jpg"></a></li>
									<li class="ft-ram"><a href="http://www.ramtrucks.com" target="_blank"><span>Ram Truck</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/ram.jpg"></a></li>
									<li class="ft-mopar"><a href="http://www.mopar.com/" target="_blank"><span>Mopar</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/mopar.jpg"></a></li>
									<li class="ft-srt"><a href="http://www.drivesrt.com/" target="_blank"><span>Srt</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/srt.jpg"></a></li>
									<li class="ft-ferrari"><a href="http://www.ferrari.com/" target="_blank"><span>Ferrari</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/ferrari.jpg"></a></li>
									<li class="ft-maserati"><a href="http://www.maserati.com/" target="_blank"><span>Maserati</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/maserati.jpg"></a></li>
									<li class="ft-marelli"><a href="http://magnetimarelli.com/" target="_blank"><span>Magneti Marelli</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/marelli.jpg"></a></li>
									<li class="ft-comau"><a href="http://comau.com/" target="_blank"><span>Comau</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/comau.jpg"></a></li>
									<li class="ft-teksid"><a href="http://www.teksid.com/" target="_blank"><span>Teksid</span><img src="<?= site_url() ?>/wp-content/uploads/investorday/style/FCAInvestorDay/img/shared/loghi-footer/teksid.jpg"></a></li>
								</ul>
							</nav>
							<p class="legal_privacy">
								<a class="legal_notes" href="<?= site_url() ?>">APAConnect</a><span>|</span>
								<a class="legal_notes" href="http://www.fiatspa.com" target="_blank">Fiat SPA</a><span>|</span>
								<a class="legal_notes" href="http://www.chryslergroupllc.com/" target="_blank">Chrysler LLC</a><span>|</span>
								<a class="legal_notes pp" href="<?= site_url() ?>/wp-content/uploads/investorday/pages/legal_notes.html">Legal</a><span>|</span>
								<a class="privacy_police pp" href="<?= site_url() ?>/wp-content/uploads/investorday/pages/privacy_policy.html">Privacy</a><span>|</span>
								<a class="privacy_police pp" href="<?= site_url() ?>/wp-content/uploads/investorday/pages/contacts.html">Contacts</a>
							</p> 
						</footer>
						<!--//footer-->
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
