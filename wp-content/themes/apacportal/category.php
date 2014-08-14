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
					<h1 class="archive-title"><?php printf(single_cat_title( '', false ) ); ?></h1>

					<?php if ( category_description() ) : // Show an optional category description ?>
					<div class="archive-meta"><?php echo category_description(); ?></div>
					<?php endif; ?>
				</header><!-- .archive-header -->

				<div class="content">
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title">
						<?php
							$post_type = get_post_type();
							switch($post_type){
								case 'link':
									echo '<a href="'.get_the_content().'" target="_blank">'.get_the_title().'</a>';
									break;
								case 'attachment':
									the_attachment_link();
									break;
								default:
									echo '<a href="'.get_permalink().'" target="_blank">'.get_the_title().'</a>';
							}
						?>
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="entry-meta edit-link">', '</span>' ); ?>
						</h1>
						<dl class="dl-horizontal">
							<dt>
								<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
								<div class="entry-thumbnail">
									<?php the_post_thumbnail(); ?>
									&nbsp;
								</div>
								<?php elseif ($post_type === 'attachment') : ?>
									<?php
									$fileinfo = wp_check_filetype(get_post_meta(get_the_ID(), '_wp_attached_file', true));
									if(file_exists(get_stylesheet_directory() . '/images/file_icons/' . $fileinfo['ext']  . '.' . 'png')): ?>
									<img src="<?=get_stylesheet_directory_uri() . '/images/file_icons/' . $fileinfo['ext']  . '.' . 'png'?>">
									<?php endif; ?>
								<?php endif; ?>
							</dt>
							<dd>
								<?php if(get_post_type()=='post'){ the_excerpt(); }?>
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

<?php get_footer(); ?>