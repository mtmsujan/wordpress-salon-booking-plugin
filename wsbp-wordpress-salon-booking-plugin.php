<?php

/**
 * Plugin Name: WordPress Salon Booking Plugin
 * Description: WordPress Salon Booking Plugin is a user-friendly tool for managing appointments and bookings for businesses in the beauty and wellness industry. It offers features such as online booking, schedule management, staff management, payment processing, and email notifications, making it a comprehensive solution for salon owners.
 * Plugin URI:  https://github.com/mtmsujan/wordpress-salon-booking-plugin
 * Version:     1.0.0
 * Author:      Mtm Sujan
 * Author URI:  https://github.com/mtmsujan/wordpress-salon-booking-plugin
 * Text Domain: wsbp
 * 
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
if (!class_exists("Wsbp_WordPress_Salon_Booking_Plugin")) {
	final class Wsbp_WordPress_Salon_Booking_Plugin
	{

		// Define plugin properties
		private $version = '1.0.0';
		private $plugin_name = 'wsbp';
		private static $instance;

		public static function getInstance()
		{
			if (!isset(self::$instance) && !(self::$instance instanceof Wsbp_WordPress_Salon_Booking_Plugin)) {
				self::$instance = new Wsbp_WordPress_Salon_Booking_Plugin;
				self::$instance->includes();
			}

			return self::$instance;
		}

		public function includes()
		{


			//admin menu page class
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-admin-menu-page.php';

			//PLugin settings register
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-settings-register.php';

			//Main Setiings display
			require plugin_dir_path(__FILE__) . 'admin/view/wsbp-settings-display.php';

			//Register services class
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-booking-services.php';

			//Register services metabox class
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-services-metabox.php';

			//Register booking class
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-services.php';

			//Register services metabox class
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-booking-metabox.php';

			//Register booking class
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-assistants.php';

			//Register booking services 
			require plugin_dir_path(__FILE__) . 'admin/view/wsbp-booking-services-display.php';

			//Class REST API
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-rest-api.php';

			//add custom colums in booking 
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-booking-colums-add.php';

			//Include scripts
			require plugin_dir_path(__FILE__) . 'admin/classes/wsbp-class-scripts.php';
		}
		// Constructor function
		public function __construct()
		{
			// Load plugin text domain
			add_action('plugins_loaded', array($this, 'load_textdomain'));
		}
		// Load plugin text domain
		public function load_textdomain()
		{
			load_plugin_textdomain('caacg', false, dirname(plugin_basename(__FILE__)) . '/languages');
		}
	}
}
function wsbp_wordpress_salon_booking_plugin()
{

	// Load plugin file
	require_once(__DIR__ . '/elementor/plugin.php');
	// Run the plugin
	\Wsbp_Addon\Plugin::instance();
	return Wsbp_WordPress_Salon_Booking_Plugin::getInstance();
}
add_action('plugins_loaded', 'wsbp_wordpress_salon_booking_plugin');
