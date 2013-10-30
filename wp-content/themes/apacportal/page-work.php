<?php get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid" role="main">
			<div class="span3">
				<?get_sidebar('left')?>
				<div class="box">
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
						<div class="box">
							<header>
								Commercial
							</header>
							<div class="content">
								<?=apacportal_post_list('commercial',-1,array('orderby'=>'ID','order'=>'ASC'));?>
							</div>
						</div>
						<div class="box">
							<header>
								Industrial
							</header>
							<div class="content">
								<?=apacportal_post_list('industrial',-1,array('orderby'=>'ID','order'=>'ASC'));?>
							</div>
						</div>
						<div class="box">
							<header>
								Corporate Function
							</header>
							<div class="content">
								<?=apacportal_post_list('corporate-function',-1,array('orderby'=>'ID','order'=>'ASC'));?>
							</div>
						</div>
					</div>
					<div class="span6">
						<?get_sidebar('market-list')?>
					</div>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>