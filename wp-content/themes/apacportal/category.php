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
$categories = array();
foreach($wp_query->tax_query->queries as $tax_query){
	$categories[] = get_category_by_slug($tax_query['terms'][0]);
}
$categories_name = array();

foreach($categories as $category){
	$categories_name[] = $category->name;
}


?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content row-fluid clearfix" role="main">
			<div class="span3">
				<?=do_shortcode('[sidebar id="left"]')?>
			</div>
			<div class="span9 box">
			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?=implode(' ', $categories_name)?></h1>

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
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="entry-meta edit-link btn btn-mini">', '</span>' ); ?>
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
								<?php if(get_post_type() === 'post'){ ?>
								<ul style="margin-bottom: 5px;">
									<li><b>Categories: <?php the_category(', '); ?></b></li>
								</ul>
								<?=the_excerpt()?>
								<?php }?>
								<?php if($post_type === 'attachment'): ?>
								<ul>
									<li><b>File Size: </b><?=size_format(filesize(get_attached_file(get_the_ID())))?></li>
									<li><b>Uploaded at: </b><?php the_date(); ?></li>
									<li><b>Categories: </b><?php the_category(', '); ?></li>
								</ul>
								<?php endif; ?>
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