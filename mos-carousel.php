<?php
/*
Plugin Name: Mos Carousel
Description: Mos Carousel allow you to add Slider or carosel.
Version: 0.0.1
Author: Md. Mostak Shahid
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define MOS_CAROUSEL_FILE.
if ( ! defined( 'MOS_CAROUSEL_FILE' ) ) {
	define( 'MOS_CAROUSEL_FILE', __FILE__ );
}
// Define MOS_CAROUSEL_SETTINGS.
if ( ! defined( 'MOS_CAROUSEL_SETTINGS' ) ) {
  define( 'MOS_CAROUSEL_SETTINGS', admin_url('/edit.php?post_type=slider&page=mos_slider_settings') );
	//define( 'MOS_CAROUSEL_SETTINGS', admin_url('/options-general.php?page=mos_carousel_settings') );
}
$mos_carousel_option = get_option( 'mos_carousel_options' );
$plugin = plugin_basename(MOS_CAROUSEL_FILE); 
require_once ( plugin_dir_path( MOS_CAROUSEL_FILE ) . 'mos-carousel-functions.php' );
require_once ( plugin_dir_path( MOS_CAROUSEL_FILE ) . 'mos-carousel-settings.php' );
require_once ( plugin_dir_path( MOS_CAROUSEL_FILE ) . 'mos-carousel-post-types.php' );
// require_once ( plugin_dir_path( MOS_CAROUSEL_FILE ) . 'mos-carousel-taxonomy.php' );
//require_once ( plugin_dir_path( MOS_CAROUSEL_FILE ) . 'custom-settings.php' );

require_once( plugin_dir_path( MOS_CAROUSEL_FILE ) . 'plugins/metabox/init.php');
require_once( plugin_dir_path( MOS_CAROUSEL_FILE ) . 'mos-carousel-metaboxes.php');

require_once('plugins/update/plugin-update-checker.php');
$pluginInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mos-carousel.json',
	MOS_CAROUSEL_FILE,
	'mos-carousel'
);


register_activation_hook(MOS_CAROUSEL_FILE, 'mos_carousel_activate');
add_action('admin_init', 'mos_carousel_redirect');
 
function mos_carousel_activate() {
    $mos_carousel_option = array();
    // $mos_carousel_option['mos_login_type'] = 'basic';
    // update_option( 'mos_carousel_option', $mos_carousel_option, false );
    add_option('mos_carousel_do_activation_redirect', true);
}
 
function mos_carousel_redirect() {
    if (get_option('mos_carousel_do_activation_redirect', false)) {
        delete_option('mos_carousel_do_activation_redirect');
        if(!isset($_GET['activate-multi'])){
            wp_safe_redirect(MOS_CAROUSEL_SETTINGS);
        }
    }
}

// Add settings link on plugin page
function mos_carousel_settings_link($links) { 
  $settings_link = '<a href="'.MOS_CAROUSEL_SETTINGS.'">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
} 
add_filter("plugin_action_links_$plugin", 'mos_carousel_settings_link' );



