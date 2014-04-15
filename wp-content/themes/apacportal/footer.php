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
				<?php //get_sidebar( 'main' ); ?>
				<nav>
					<ul class="nav">
						<li><a href="/wp-content/uploads/2013/11/Privacy-Policy.pdf" target="_blank">Privacy Policy</a></li>
						<li>|</li>
						<li><a href="mailto:hr638@chrysler.com">Contact Us</a></li>
					</ul>
				</nav>
				<div class="site-info pull-right">
<!--					© 2013 FIAT S.P.A.-->
				</div><!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
	
	<script type="text/javascript">
		
		(function($){
			$(function(){

				if(localStorage && localStorage.sharePrice && JSON.parse(localStorage.sharePrice).content && (JSON.parse(localStorage.sharePrice).timestamp > new Date().getTime() - 1.8E6)){

					$('.share-price').html(JSON.parse(localStorage.sharePrice).content);
				}
				else{

					$('.share-price').text('Loading Share Price ...');

					$('.share-price').length && $.get('/share-price/',function(result){
						$('.share-price').html($(result.replace(/\<img[^\<^\>]*?\>/g,'').replace(/\<link[^\<^\>]*?\>/g,'').replace(/\<iframe[^\<^\>]*?\>/g,'')).find('#price-panel').children('div:first')).find('.pr').children('span').prepend('Fiat SpA Share Price: € ');
						localStorage.sharePrice=JSON.stringify({
							content: $('.share-price').html(),
							timestamp: new Date().getTime()
						});
					});

				}


				setInterval(function(){

					$.get('/world-time/',function(time){$('.worldtime').html(time);});

					$('.share-price').length && $.get('/share-price/',function(result){
						$('.share-price').html($(result.replace(/\<img[^\<^\>]*?\>/g,'')).find('#price-panel').children('div:first')).find('.pr').children('span').prepend('Fiat SpA Share Price: € ');
						localStorage.sharePrice=JSON.stringify({
							content: $('.share-price').html(),
							timestamp: new Date().getTime()
						});
					});

				},60000);

				$('a[href="#"]').on('click',function(){
					return false;
				});

				$('.slider').mobilyslider({
					transition: 'fade',
					animationSpeed: 1000,
					autoplay: true,
					autoplaySpeed: 5000,
					pauseOnHover: true,
					bullets: true,
					arrows: false
				});

				$('[ajax-resource]').each(function(){
					var that = this;
					$.get($(this).attr('ajax-resource'), function(response){
						$(that).replaceWith(response);
					});
				});

				$('.search-query').on('focus', function(){
					$(this).removeClass('folded').animate({width: 200}, 100);
				}).on('blur', function(){
					$(this).addClass('folded').animate({width: 0}, 100)
				});
				
				$('input, textarea').placeholder();

			});
		})(jQuery);
		
	</script>
</body>
</html>