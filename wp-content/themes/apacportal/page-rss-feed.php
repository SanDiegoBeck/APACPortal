<?php

require_once( ABSPATH . WPINC . '/class-feed.php' );

$feed_data = unserialize(get_option('feed_data'));

if(empty($feed_data) || ($feed_data['timestamp'] < time() - 7200)){
	$feed_data['chrysler'] = fetch_feed( 'http://scoop.chrysler.com/feed' );
	$feed_data['fiat'] = file_get_html('http://www.fcagroup.com/en-us/_layouts/15/FIAT.Web.Publishing.VisualWebParts/FIATDocumentsPicker.aspx?isPriceSensitive=False&isEventViewer=False&subsite=en-us&showFilterByYear=True&listPath=en-US/media_center/fca_press_release/FiatDocuments&year=0')->find('.els-list ul li');
	$feed_data['timestamp'] = time();
	update_option('feed_data', serialize($feed_data));
}

if ( ! is_wp_error( $feed_data['chrysler'] ) ){

	// Figure out how many total items there are, but limit it to 5. 
	$maxitems = $feed_data['chrysler']->get_item_quantity( 3 ); 

	// Build an array of all the items, starting with element 0 (first element).
	$rss_items_chrysler = $feed_data['chrysler']->get_items( 0, $maxitems );

}

?>
<ul>
	<?php if ( $maxitems == 0 ) : ?>
		<li><?php _e( 'No items', 'my-text-domain' ); ?></li>
	<?php else : ?>
		<?php // Loop through each feed item and display each item as a hyperlink. ?>
		<?php foreach ( (array)$rss_items_chrysler as $item ) : ?>
			<li>
				<a href="<?php echo esc_url( $item->get_permalink() ); ?>"
					title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>"
					target="_blank">
					<?php echo esc_html( $item->get_title() ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if ( $maxitems == 0 ) : ?>
		<li><?php _e( 'No items', 'my-text-domain' ); ?></li>
	<?php else : ?>
		<?php // Loop through each feed item and display each item as a hyperlink. ?>
		<?php foreach ( (array)$feed_data['fiat'] as $index => $item ) : ?>
			<?php if($index > 2) break; ?>
			<li>
				<a href="http://www.fcagroup.com<?php echo esc_url( $item->find('a', 0)->href ); ?>"
					title="<?php echo $item->find('p', 0); ?>"
					target="_blank">
					<?php echo $item->find('p', 0)->find('text', 0); ?>
				</a>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>
