<?php
/*
Plugin Name: Network Uploads
Plugin URI: http://ryan.hoover.ws
Description: WordPress multisite plugin to enable network-specific uploads, plugins, and themes
Version: 0.1
Author: Ryan Hoover
Author URI: http://ryan.hoover.ws
Text Domain: netup
*/
namespace netup;

global $netup_path;
global $netup_url;
$netup_path = plugin_dir_path( __FILE__ );
$netup_url  = plugin_dir_url( __FILE__ );

// require_once( $netup_path . 'lib/core.php' );
// require_once( $netup_url . 'lib/admin.php' );

if( class_exists( 'netup\core\Netup' ) ) {
	$netup = netup\core\Netup::get_instance();
}

if( class_exists( 'netup\admin\NetupAdmin' ) ) {
	$netup_admin = netup\admin\NetupAdmin::get_instance();
}
