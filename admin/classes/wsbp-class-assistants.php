<?php
/**
 *  Post type register
 *
 */
class Wsbp_Assistants_Post_Type_Register{

   public function __construct(){
      add_action('init', array($this,'register_salon_assistants_post_types'));
   }
// Register custom post types
function register_salon_assistants_post_types() {
    
   $labels = array(
       'name' => __('Assistants', 'salon-booking'),
       'singular_name' => __('Assistant', 'wsbp'),
       'menu_name' => __('Assistants', 'wsbp'),
       'all_items' => __('All Assistants', 'wsbp'),
       'add_new' => __('Add New', 'wsbp'),
       'add_new_item' => __('Add New Assistant', 'wsbp'),
       'edit_item' => __('Edit Assistant', 'wsbp'),
       'new_item' => __('New Assistant', 'wsbp'),
       'view_item' => __('View Assistant', 'wsbp'),
       'search_items' => __('Search Assistants', 'wsbp'),
       'not_found' => __('No assistants found', 'wsbp'),
       'not_found_in_trash' => __('No assistants found in trash', 'wsbp')
   );
   
   $args = array(
       'labels' => $labels,
       'public' => true,
       'show_ui' => true,
       'show_in_menu' => 'salon-booking-plugin',
       'menu_position' => 40,
       'supports' => array('title', 'editor','thumbnail'),
       'has_archive' => true,
       'rewrite' => array('slug' => 'assistants'),
   );
   
   register_post_type('wsbp-assistants', $args);
}



}
new Wsbp_Assistants_Post_Type_Register();