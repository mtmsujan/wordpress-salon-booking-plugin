<?php 
/**
 *  Render booking metabox info
 *
 */
 function wsbp_booking_customer_details_render($post) {

   $first_name =  get_post_meta($post->ID, 'wsbp_booking_first_name', true);
   $last_name =  get_post_meta($post->ID, 'wsbp_booking_last_name', true);
   $email =  get_post_meta($post->ID, 'wsbp_booking_email', true);
   $phone =  get_post_meta($post->ID, 'wsbp_booking_phone', true);
   $address =  get_post_meta($post->ID, 'wsbp_booking_address', true);
   $price = get_post_meta($post->ID, 'wsbp_services_price', true);
  
   ?>
 <div class="wsbp-custom-field-metabox">
  <div class="wsbp-booking-customer-details">
    <div class="row mt-3 p-2">
      <div class="col-md-3">
        <label for="wsbp_booking_first_name" class="form-label"><?php esc_html_e( 'First Name', 'wsbp' ); ?></label>
        <input type="text" class="form-control" id="wsbp_booking_first_name" name="wsbp_booking_first_name" value="<?php echo esc_attr( $first_name ); ?>" required>
      </div>
      <div class="col-md-3">
        <label for="wsbp_booking_last_name" class="form-label"><?php esc_html_e( 'Last Name', 'wsbp' ); ?></label>
        <input type="text" class="form-control" id="wsbp_booking_last_name" name="wsbp_booking_last_name" value="<?php echo esc_attr( $last_name ); ?>" required>
      </div>
      <div class="col-md-3">
        <label for="wsbp_booking_email" class="form-label"><?php esc_html_e( 'Email', 'wsbp' ); ?></label>
        <input type="email" class="form-control" id="wsbp_booking_email" name="wsbp_booking_email" value="<?php echo esc_attr( $email ); ?>" required>
      </div>
      <div class="col-md-3">
        <label for="wsbp_booking_phone" class="form-label"><?php esc_html_e( 'Phone', 'wsbp' ); ?></label>
        <input type="text" class="form-control" id="wsbp_booking_phone" name="wsbp_booking_phone" value="<?php echo esc_attr( $phone ); ?>" required>
      </div>
      <div class="col-md-12 mt-3">
        <label for="wsbp_booking_address" class="form-label"><?php esc_html_e( 'Address', 'wsbp' ); ?></label>
        <textarea class="form-control" id="floatingTextarea2" name="wsbp_booking_address" style="height: 100px"><?php echo esc_textarea( $address ); ?></textarea>
      </div>
    </div>
  </div>
</div>

   <?php
 }

 function wsbp_booking_customer_date_render($post) {
  $date = get_post_meta($post->ID, 'wsbp_booking_date', true);
  $time = get_post_meta($post->ID, 'wsbp_booking_time', true);
  $duration = get_post_meta($post->ID, 'wsbp_booking_duration', true);
  $booking_status = get_post_meta($post->ID, 'wsbp_booking_status', true);
 
  ?>
  <div class="wsbp-custom-field-metabox">
  <div class="wsbp-booking-customer-details">
    <div class="row mt-3 p-2">
      <div class="col-md-3">
        <label for="wsbp_booking_date" class="form-label"><?php esc_html_e('Date', 'wsbp'); ?></label>
        <input type="text" class="form-control" id="wsbp_booking_date" name="wsbp_booking_date" value="<?php echo esc_html($date); ?>" required>
      </div>
      <div class="col-md-3">
        <label for="wsbp_booking_time" class="form-label"><?php esc_html_e('Time', 'wsbp'); ?></label>
        <input type="text" class="form-control" id="wsbp_booking_time" name="wsbp_booking_time" value="<?php echo esc_html($time); ?>" required>
      </div>
      <div class="col-md-3">
        <label for="wsbp_booking_duration" class="form-label"><?php esc_html_e('Duration', 'wsbp'); ?></label>
        <?php
        $duration_array = array();
        for ($i = 15; $i <= 1440; $i += 15) {
          $hours = floor($i / 60);
          $minutes = $i % 60;
          $label = '';
          if ($hours > 0) {
            $label .= $hours . 'h ';
          }
          if ($minutes > 0) {
            $label .= $minutes . 'min';
          }
          $value = $hours * 60 + $minutes;
          $duration_array[$value] = $label;
        }
        ?>
        <select class="form-control" id="wsbp_booking_duration" name="wsbp_booking_duration">
          <?php
          foreach ($duration_array as $value => $label) {
            $selected = ($value == $duration) ? 'selected' : '';
            echo '<option value="' . esc_attr($value) . '" ' . esc_attr($selected) . '>' . esc_html($label) . '</option>';
          }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <label for="wsbp_booking_status" class="form-label"><?php esc_html_e('Status', 'wsbp'); ?></label>
        <select class="form-select" name="wsbp_booking_status" required>
          <option value="" disabled selected><?php esc_html_e('Select Status', 'wsbp'); ?></option>
          <option value="pending"<?php selected($booking_status, 'pending'); ?>><?php esc_html_e('Pending', 'wsbp'); ?></option>
          <option value="confirmed"<?php selected($booking_status, 'confirmed'); ?>><?php esc_html_e('Confirmed', 'wsbp'); ?></option>
          <option value="cancelled"<?php selected($booking_status, 'cancelled'); ?>><?php esc_html_e('Cancelled', 'wsbp'); ?></option>
        </select>
      </div>
    </div>
  </div>
</div>

  <?php
}

function wsbp_booking_services_assistants_render($post) {
  $booking_assistants = get_post_meta($post->ID, 'wsbp_booking_assistants', true);
  $services_name = get_post_meta($post->ID, 'wsbp_booking_services', true);
  $services_price = get_post_meta($post->ID, 'wsbp_booking_price', true);

  ?>
 <div class="wsbp-custom-field-metabox">
  <div class="wsbp-booking-customer-details">
    <div class="row mt-3 p-2">
      <div class="col-md-6">
        <select class="form-select" name="wsbp_booking_services">
          <option value="" disabled selected><?php esc_html_e('Select Service', 'wsbp'); ?></option>
          <?php
            $services = get_posts(array(
              'post_type' => 'wsbp-services',
              'post_status' => 'publish',
              'orderby' => 'title',
              'order' => 'ASC',
              'numberposts' => -1,
            ));
            foreach ($services as $service) {
              $selected = '';
              if ($services_name == $service->ID) {
                $selected = 'selected';
              }
              echo '<option value="' . $service->ID. '"' . $selected . '>' . esc_html($service->post_title) . '</option>';
            }
          ?>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-select" name="wsbp_booking_assistants">
          <option value="" disabled selected><?php esc_html_e('Select Assistants', 'wsbp'); ?></option>
          <?php
            $assistants = get_posts(array(
              'post_type' => 'wsbp-assistants',
              'post_status' => 'publish',
              'orderby' => 'title',
              'order' => 'ASC',
              'numberposts' => -1,
            ));
            foreach ($assistants as $assistant) {
              $selected = '';
              if ($booking_assistants == $assistant->ID) {
                $selected = 'selected';
              }
              echo '<option value="' . $assistant->ID. '"' . $selected . '>' . esc_html($assistant->post_title) . '</option>';
            }
          ?>
        </select>
      </div>
    </div>
    <div class="row mt-3 p-2">
      <div class="col-md-12">
        <h3 class="total_amount"><?php esc_html_e('Total Amount:', 'wsbp'); ?> <?php echo esc_html($services_price); ?>$</h3>
      </div>
    </div>
  </div>
</div>

 
 </div>
  <?php
}