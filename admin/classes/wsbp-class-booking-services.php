<?php
/**
 *  Booking post type register
 *
 */
class Wsbp_Booking_Post_Type_Register{

   public function __construct(){
      add_action('init', array($this,'wsbp_register_salon_booking_post_types'));
   }

   public function wsbp_register_salon_booking_post_types() {
   $labels = array(
      'name' => __('Bookings', 'wsbp'),
      'singular_name' => __('Booking', 'wsbp'),
      'menu_name' => __('Bookings', 'wsbp'),
      'all_items' => __('All Bookings', 'wsbp'),
      'add_new' => __('Add New', 'wsbp'),
      'add_new_item' => __('Add New Booking', 'wsbp'),
      'edit_item' => __('Edit Booking', 'wsbp'),
      'new_item' => __('New Booking', 'wsbp'),
      'view_item' => __('View Booking', 'wsbp'),
      'search_items' => __('Search Bookings', 'wsbp'),
      'not_found' => __('No bookings found', 'wsbp'),
      'not_found_in_trash' => __('No bookings found in trash', 'wsbp')
  );
  $args = array(
      'labels' => $labels,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => 'salon-booking-plugin',
      'menu_position' => 30,
      'supports' => array(''),
      'has_archive' => true,
      'rewrite' => array('slug' => 'bookings'),
  );
  register_post_type('wsbp-bookings', $args);
}



}
new Wsbp_Booking_Post_Type_Register();