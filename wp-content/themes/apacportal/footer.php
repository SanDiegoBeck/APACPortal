<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrapper">
				<?//php get_sidebar( 'main' ); ?>
				<nav>
					<ul>
						<li><a href="#">Sitemap</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Legal Disclaimer</a></li>
						<li><a href="#">Contact Us</a></li>
						<li><a href="#">Terms of Use</a></li>
					</ul>
				</nav>
				<div class="site-info pull-right">
					© 2013 FIAT S.P.A.
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>