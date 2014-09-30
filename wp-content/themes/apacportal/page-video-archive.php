<?php

query_posts(array(
	'post_type'=>'attachment',
	'post_status'=>'inherit',
	'post_mime_type'=>'video',
	'posts_per_page'=>5,
	'paged'=>$paged
));

get_header();
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid clearfix" role="main">
			<div class="span3">
				<?=do_shortcode('[sidebar id="left"]')?>
			</div>
			<div class="span9 box">
			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title">Video Gallery</h1>

					<?php if ( category_description() ) : // Show an optional category description ?>
					<div class="archive-meta"><?php echo category_description(); ?></div>
					<?php endif; ?>
				</header><!-- .archive-header -->

				<div class="content">
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</article><!-- #post -->
					<hr>
				<?php endwhile; ?>
				</div>
				
				<?php twentythirteen_paging_nav(); ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; wp_reset_query(); ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_footer();
?>
