<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid clearfix" role="main">
			<div class="span3">
				<?=get_sidebar()?>
			</div>
			<div class="span9 box">
			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentythirteen' ), single_cat_title( '', false ) ); ?></h1>

					<?php if ( category_description() ) : // Show an optional category description ?>
					<div class="archive-meta"><?php echo category_description(); ?></div>
					<?php endif; ?>
				</header><!-- .archive-header -->

				<div class="content">
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
						<dl class="dl-horizontal">
							<dt>
								<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
								<div class="entry-thumbnail">
									<?php the_post_thumbnail(); ?>
									&nbsp;
								</div>
								<? endif; ?>
							</dt>
							<dd>
								<?php the_excerpt(); ?>
							</dd>
						</dl>
					</article><!-- #post -->
					<hr>
				<?php endwhile; ?>
				</div>
				
				<?php twentythirteen_paging_nav(); ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>