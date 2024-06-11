<?php
/**
 *  Custom metabox register for bookings
 *
 */
class Wsbp_Booking_Custom_Metabox_Register{
   // Register custom post type 'Services'
   public function __construct() {
      add_action('add_meta_boxes', array($this, 'wsbp_booking_customer_metabox'));
      add_action('save_post', array($this, 'wsbp_booking_save_metabox'));
  }

  public function wsbp_booking_customer_metabox( $post ) {
      add_meta_box(
          'wsbp_booking_customer_details',
          __( 'Booking Customer Details', 'wsbp' ),
           'wsbp_booking_customer_details_render',
          'wsbp-bookings',
          'normal',
          'high'
      );

      add_meta_box(
         'wsbp_booking_data_time',
         __( 'Booking Date & Time', 'wsbp' ),
          'wsbp_booking_customer_date_render',
         'wsbp-bookings',
         'normal',
         'high'
     );

     add_meta_box(
      'wsbp_booking_services_assistants',
      __( 'Booking Services & Assistants', 'wsbp' ),
       'wsbp_booking_services_assistants_render',
      'wsbp-bookings',
      'normal',
      'high'
  );
  }

  public function wsbp_booking_save_metabox($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
    }

    if (!current_user_can('edit_post', $post_id)) {
      return;
    }

    //first name
    if (isset($_POST['wsbp_booking_first_name'])) {
      update_post_meta($post_id, 'wsbp_booking_first_name', sanitize_text_field($_POST['wsbp_booking_first_name']));
    }
    //last first
    if (isset($_POST['wsbp_booking_last_name'])) {
      update_post_meta($post_id, 'wsbp_booking_last_name', sanitize_text_field($_POST['wsbp_booking_last_name']));
    }  
    //email
    if (isset($_POST['wsbp_booking_email'])) {
      update_post_meta($post_id, 'wsbp_booking_email', sanitize_text_field($_POST['wsbp_booking_email']));
    }
    //phone
    if (isset($_POST['wsbp_booking_phone'])) {
        update_post_meta($post_id, 'wsbp_booking_phone', sanitize_text_field($_POST['wsbp_booking_phone']));
    }
    //address
    if (isset($_POST['wsbp_booking_address'])) {
        update_post_meta($post_id, 'wsbp_booking_address', sanitize_text_field($_POST['wsbp_booking_address']));
    }
    //date
    if (isset($_POST['wsbp_booking_date'])) {
        update_post_meta($post_id, 'wsbp_booking_date', sanitize_text_field($_POST['wsbp_booking_date']));
    } 
    //time
    if (isset($_POST['wsbp_booking_time'])) {
        update_post_meta($post_id, 'wsbp_booking_time', sanitize_text_field($_POST['wsbp_booking_time']));
    } 
    //duration
    if (isset($_POST['wsbp_booking_duration'])) {
      update_post_meta($post_id, 'wsbp_booking_duration', sanitize_text_field($_POST['wsbp_booking_duration']));
  } 
    //booking status
    if (isset($_POST['wsbp_booking_status'])) {
        update_post_meta($post_id, 'wsbp_booking_status', sanitize_text_field($_POST['wsbp_booking_status']));
    }

    //Booking Services Name
    if (isset($_POST['wsbp_booking_services'])) {
        update_post_meta($post_id, 'wsbp_booking_services', sanitize_text_field($_POST['wsbp_booking_services']));
    }
    //booking assistants
    if (isset($_POST['wsbp_booking_assistants'])) {
        update_post_meta($post_id, 'wsbp_booking_assistants', sanitize_text_field($_POST['wsbp_booking_assistants']));
    } 
    //booking number of person
    if (isset($_POST['wsbp_num_of_person'])) {
        update_post_meta($post_id, 'wsbp_num_of_person', sanitize_text_field($_POST['wsbp_num_of_person']));
    }


  }
 

}

new Wsbp_Booking_Custom_Metabox_Register();


