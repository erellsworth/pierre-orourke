<?php

function gg_random_rss_gibbs_note(){
	
	include_once( ABSPATH . WPINC . '/feed.php' );
	
	$rss = // Instantiate a new SimplePie_Custom_Sort class.
	$rss = new gg_SimplePie_Random_Sort();
	$rss->set_cache_class( 'WP_Feed_Cache' );
	
	$rss->set_feed_url('http://notetogibbs.com/feed/rss/?post_type=gg_note_to_gibbs');
	$rss->set_item_class('SimplePie_Item_Digg'); // Make sure we use the Digg Add-on
	$rss->init();
	
	if ( ! is_wp_error( $rss ) ) { // Checks that the object is created correctly

    // Figure out how many total items there are, but limit it to 5. 
    $maxitems = $rss->get_item_quantity( 1 ); 

    // Build an array of all the items, starting with element 0 (first element).
    $rss_items = $rss->get_items( 0, $maxitems );

	} 

if ( $maxitems == 0 ) { ?>
        <?php _e( 'No items', 'note_to_gibbs' ); ?>
    <?php } else { ?>
        <?php // Loop through each feed item and display each item as a hyperlink. ?>
        <?php foreach ( $rss_items as $item ) { ?>
            
                
                    <?php echo $item->get_content(); ?>
                
            
        <?php } ?>
    <?php } ?>
	
<?php
}

function ntg_front_end_styles(){	
	wp_register_style( 'ntg_style', plugins_url() . '/note-to-gibbs/core/ntg.css');
	wp_enqueue_style('ntg_style');
}

add_action('wp_enqueue_scripts', 'ntg_front_end_styles');

// Add goggle font Architects Daughter.
function gg_add_Architects_Daughter_font() {

	// Check if SSL is present, if so then use https othereise use http
	$protocol = is_ssl() ? 'https' : 'http';
	?>
	<link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
<?php
}

add_action( 'wp_head', 'gg_add_Architects_Daughter_font' );
	
?>