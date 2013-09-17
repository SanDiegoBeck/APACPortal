<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<div id="left">
				<div class="box">
					<header>People Finder</header>
					<div class="content">
						<br>
						<input type="text" placeholder="Search..." style="width: 150px">
						<button type="submit" style="font-size: 0.8em;">SEARCH</button>
						<br><br>
					</div>
				</div>
				<div class="box">
					<header>Events
						<span class="more-link">More</span>
					</header>
					<div class="content">
						<ul>
							<li><a href="#">Mopar® at the 2013 Frankfurt International Motor Show</a></li>
							<li><a href="#">Panda 4x4 Antartica, Freemont Black Code, new 500 engines at Frankfurt 2013</a></li>
							<li><a href="#">FIAT Freestyle Team is official sponsor of Vans Downtown Showdown 2013</a></li>
							<li><a href="#">Bielsko Biala receives the prestigious Automotive Lean Production Award </a></li>
							<li><a href="#">Fiat is Technical Sponsor of the ‘World Masters Games 2013’.</a></li>
							<li><a href="#">Mopar® at the 2013 Frankfurt International Motor Show</a></li>
							<li><a href="#">Panda 4x4 Antartica, Freemont Black Code, new 500 engines at Frankfurt 2013</a></li>
							<li><a href="#">FIAT Freestyle Team is official sponsor of Vans Downtown Showdown 2013</a></li>
							<li><a href="#">Bielsko Biala receives the prestigious Automotive Lean Production Award </a></li>
							<li><a href="#">Fiat is Technical Sponsor of the ‘World Masters Games 2013’.</a></li>
							<li><a href="#">Mopar® at the 2013 Frankfurt International Motor Show</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div id="main" class="two-columns">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php twentythirteen_post_nav(); ?>
				<?php comments_template(); ?>

			<?php endwhile; ?>
			</div>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>