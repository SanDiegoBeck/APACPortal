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

				if(localStorage && localStorage.sharePrice && $.parseJSON(localStorage.sharePrice).content && ($.parseJSON(localStorage.sharePrice).timestamp > new Date().getTime() - 1.8E6)){

					$('.share-price').html($.parseJSON(localStorage.sharePrice).content);
				}
				else{

					$('.share-price').text('Loading Share Price ...');

					$('.share-price').length && $.get('/share-price/?_=' + new Date().getTime(),function(result){
						result && $('.share-price').html($(result).find('.pr').children('span').prepend('FCAU Share Price: $ ').end().end());
						localStorage.sharePrice=JSON.stringify({
							content: $('.share-price').html(),
							timestamp: new Date().getTime()
						});
					});

				}


				setInterval(function(){

					$.get('/world-time/?_=' + new Date().getTime(),function(time){$('.worldtime').html(time);});

					$.get('/share-price/?_=' + new Date().getTime(),function(result){
						$('.share-price').html($(result).find('.pr').children('span').prepend('FCAU Share Price: $ ').end().end());
						localStorage.sharePrice=JSON.stringify({
							content: $('.share-price').html(),
							timestamp: new Date().getTime()
						});
					});

				},60000);

				$('a[href="#"]').on('click',function(){
					return false;
				});

				$('[ajax-resource]').each(function(){
					var that = this;
					$.get($(this).attr('ajax-resource'), function(response){
						$(that).replaceWith(response);
					});
				});

				$('.search-query').on('focus', function(){
					$(this).removeClass('folded').animate({width: 200}, 100).attr('placeholder', 'Search for:');
				}).on('blur', function(){
					$(this).addClass('folded').animate({width: 0}, 100).attr('placeholder', '');
				});
				
				$('input, textarea').placeholder && $('input, textarea').placeholder();
				
				$('.rslides').responsiveSlides({
					auto: true,
					pager: true,
					pause: true,
					pauseControls: true,
					prevText: '&nbsp;',
					nextText: '&nbsp;'
				});
				
			});
		})(jQuery);
		
	</script>
</body>
</html>