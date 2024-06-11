<?php
/**
 *  Define Salon_Booking_Plugin class
 *
 */
class Wsbp_Salon_Booking_Plugin {
    
   public function __construct() {
       add_action('admin_menu', array($this, 'salon_booking_plugin_menu'));
   }
   
  // Add custom post types to plugin menu
function salon_booking_plugin_menu() {
    add_menu_page('Salon Booking Plugin', 'Salon Booking Plugin', 'manage_options', 'salon-booking-plugin', 'salon_booking_plugin_page', 'dashicons-calendar-alt', 50);
   
    add_submenu_page(
        'salon-booking-plugin',
        __('Settings', 'wsbp'),
        __('Settings', 'wsbp'),
        'manage_options',
        'wsbp-settings',
        'salon_booking_plugin_menu_settings',
        10 // change this value to adjust the menu position
    );
    
   
}
 
}

// Instantiate Salon_Booking_Plugin class
$plugin = new Wsbp_Salon_Booking_Plugin();
