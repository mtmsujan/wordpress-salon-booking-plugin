<?php
/**
 *  custom colums add in bookings
 *
 */
function wsbp_bookings_custom_post_type_columns($columns) {
    $new_columns = array(
        'booking_id' => __('Booking ID', 'wsbp'),
        'booking_date' => __('Booking Date', 'wsbp'),
        'booking_status' => __('Booking Status', 'wsbp'),
        'full_name' => __('Full Name', 'wsbp'),
        'assistants' => __('Assistants', 'wsbp'),
        'per_person' => __('Person', 'wsbp'),
        'duration' => __('Duration', 'wsbp'),
        'price' => __('Price', 'wsbp'),
        'booking_services' => __('Booking Services', 'wsbp')
    );
   
    $columns = array_slice($columns, 0, 3, true) + $new_columns + array_slice($columns, 3, NULL, true);
    // Remove the 'author' column
    unset($columns['author']);
    unset($columns['title']);
    unset($columns['date']);
    return $columns;
}
add_filter('manage_wsbp-bookings_posts_columns', 'wsbp_bookings_custom_post_type_columns');

function wsbp_bookings_custom_post_type_column_values($column_name, $post_id) {
   switch ($column_name) {
      case 'booking_id':
          echo "#".$post_id;
          break;
      case 'booking_date':
          echo get_post_meta($post_id, 'wsbp_booking_date', true);
          break;
      case 'booking_status':
          echo '<b class="wsbp-booking-status">'.get_post_meta($post_id, 'wsbp_booking_status', true).'<b>';
          break;
      case 'full_name':
          echo get_post_meta($post_id, 'wsbp_booking_first_name', true)." ".get_post_meta($post_id, 'wsbp_booking_last_name', true);
          break;
      case 'assistants':
          echo get_the_title(get_post_meta($post_id, 'wsbp_booking_assistants', true));
          break;
      case 'duration':
          echo get_post_meta($post_id, 'wsbp_booking_duration', true);
          break;
     case 'per_person':
            echo get_post_meta($post_id, 'wsbp_num_of_person', true);
            break;
      case 'price':
          echo get_post_meta($post_id, 'wsbp_booking_price', true)."$";
          break;
      case 'booking_services':
          echo get_the_title(get_post_meta($post_id, 'wsbp_booking_services', true));
          break;
  }
}
add_action('manage_wsbp-bookings_posts_custom_column', 'wsbp_bookings_custom_post_type_column_values', 10, 2);
