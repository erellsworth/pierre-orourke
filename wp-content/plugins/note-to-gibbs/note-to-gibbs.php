<?php
/**
 * @package Note_to_Gibbs
 * @version 1
 */
/*
Plugin Name: Note to Gibbs
Description: Display the latest Note(s) to Gibbs from author Pierre O'Rourke
Author: Graphic Geek
Plugin URI: http://www.graphicgeek.net/event-geek
Version: 1
Author URI: http://graphicgeek.net
*/

define('NTG_ABSPATH', dirname(__FILE__));
define('NTG_CORE_ABSPATH', NTG_ABSPATH . '/core');

require_once NTG_CORE_ABSPATH . '/functions.php';
require_once NTG_CORE_ABSPATH . '/widget.php';



	// Extend the SimplePie class and override the existing sort_items() function with our own.
	require_once( ABSPATH . WPINC . '/class-feed.php' );	

	require_once(NTG_CORE_ABSPATH . '/simplepie_digg.inc');	

		
	class gg_SimplePie_Random_Sort extends SimplePie
	{
		public static function sort_items($a, $b)
		{
			return rand(-1, 1);
		}
	}



function ntg_housekeeping(){
	
	$ntg_options = get_option( 'ntg_options');//get current options
	
	$ntg_options['ntg_version'] = '1'; //set version

	update_option('ntg_options', $ntg_options); //update version	
	
}//ntg_housekeeping
add_action( 'admin_init', 'ntg_housekeeping');

function ntg_languages() {
	load_plugin_textdomain( 'note_to_gibbs', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	
}
//to be added if translations are added
//add_action('plugins_loaded', 'ntg_languages');
?>