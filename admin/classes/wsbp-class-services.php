<?php
/**
 *  Services post type register
 *
 */
class Wsbp_Services_Post_Type_Register{
   // Register custom post type 'Services'
   public function __construct(){
      add_action('init', array($this,'wsbp_custom_services_post_type'));
     
   }

   public function wsbp_custom_services_post_type() {
      $labels = array(
         'name' => __('Services', 'wsbp'),
         'singular_name' => __('Service', 'wsbp'),
         'menu_name' => __('Services', 'wsbp'),
         'all_items' => __('All Services', 'wsbp'),
         'add_new' => __('Add New', 'wsbp'),
         'add_new_item' => __('Add New Service', 'wsbp'),
         'edit_item' => __('Edit Service', 'wsbp'),
         'new_item' => __('New Service', 'wsbp'),
         'view_item' => __('View Service', 'wsbp'),
         'search_items' => __('Search Services', 'wsbp'),
         'not_found' => __('No services found', 'wsbp'),
         'not_found_in_trash' => __('No services found in trash', 'wsbp')
     );
     $args = array(
         'labels' => $labels,
         'public' => true,
         'show_ui' => true,
         'show_in_menu' => 'salon-booking-plugin',
         'menu_position' => 30,
         'supports' => array('title','thumbnail'),
         'has_archive' => true,
         'rewrite' => array('slug' => 'services'),
     );
     register_post_type('wsbp-services', $args);

      // Services Categories
      $labels = array(
         'name' => __('Services Categories', 'wsbp'),
         'singular_name' => __('Services Category', 'wsbp'),
         'menu_name' => __('Categories', 'wsbp'),
         'all_items' => __('All Categories', 'wsbp'),
         'edit_item' => __('Edit Category', 'wsbp'),
         'view_item' => __('View Category', 'wsbp'),
         'update_item' => __('Update Category', 'wsbp'),
         'add_new_item' => __('Add New Category', 'wsbp'),
         'new_item_name' => __('New Category Name', 'wsbp'),
         'search_items' => __('Search Categories', 'wsbp'),
         'popular_items' => __('Popular Categories', 'wsbp'),
         'not_found' => __('No categories found', 'wsbp'),
         'no_terms' => __('No categories', 'wsbp'),
         'items_list' => __('Categories list', 'wsbp'),
         'items_list_navigation' => __('Categories list navigation', 'wsbp'),
      );
   
      $args = array(
         'labels' => $labels,
         'public' => true,
         'show_ui' => true,
         'show_in_menu' => 'salon-booking-plugin',
         'menu_position' => 1,
         'show_admin_column' => true,
         'hierarchical' => true,
         'rewrite' => array('slug' => 'wsbp-services'),
      );
   
   register_taxonomy('wsbp-services-categories', array('wsbp-services'), $args);

   }
   



}

new Wsbp_Services_Post_Type_Register();