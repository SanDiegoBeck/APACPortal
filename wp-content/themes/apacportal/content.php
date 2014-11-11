<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
$the_categories = get_the_category();
foreach($the_categories as $category){
	$category_in[] = $category->slug;
}
$post_date_time = get_the_date('Y-m-d H:i:s');
$previous_post = get_posts(array('posts_per_page'=>1, 'date_query'=>array('before'=>$post_date_time, 'inclusive'=>false, 'column'=>'post_date_gmt'), 'orderby'=>'date', 'order'=>'desc', 'category_name'=>implode('+', $category_in)))[0];
$next_post = get_posts(array('posts_per_page'=>1, 'date_query'=>array('after'=>$post_date_time, 'inclusive'=>false, 'column'=>'post_date_gmt'), 'orderby'=>'date', 'order'=>'asc', 'category_name'=>implode('+', $category_in)))[0];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
<!--		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
-->
		<?php endif; ?>

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
			<div class="views pull-right"><?php echo do_shortcode('[post_view]'); ?>  Views</div>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php twentythirteen_entry_meta(); ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
		
		<hr>
		
		<div class="navigation clearfix">
			<?php if($next_post){ ?><span class="pull-left">Newer Post: <a href="<?=get_the_permalink($next_post->ID)?>"><?=$next_post->post_title?></a></span><?php } ?>
			<?php if($previous_post){ ?><span class="pull-right">Older Post: <a href="<?=get_the_permalink($previous_post->ID)?>"><?=$previous_post->post_title?></a></span><?php } ?>
		</div>
	</footer><!-- .entry-meta -->

</article><!-- #post -->
