<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="primary" class="row-fluid content-area">
	<div id="content" class="site-content clearfix" role="main">

		<?php if(get_post_format() !== 'gallery'){ ?>
		<div class="span3">
			<?=do_shortcode('[sidebar id="left"]')?>
		</div>
		<?php } ?>
		<?php if(get_post_format() !== 'gallery'){ ?>
		<div class="span9">
		<?php }else{ ?>
		<div class="span12">
		<?php } ?>
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		</div>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>