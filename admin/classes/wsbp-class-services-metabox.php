<?php
/**
 *  Services custom metabox register
 *
 */
class Wsbp_Services_Custom_Metabox_Register{
   // Register custom post type 'Services'
   public function __construct(){
 
      add_action('add_meta_boxes', array($this, 'wsbp_services_add_metabox'));
      add_action('save_post', array($this, 'wsbp_services_save_metabox'));
   }

   
   public function wsbp_services_add_metabox() {
     add_meta_box(
       'wsbp_services_metabox',
       __('Service Details', 'wsbp'),
       array($this, 'wsbp_services_render_metabox'),
       'wsbp-services',
       'normal',
       'high'
     );
   }

   public function wsbp_services_render_metabox($post) {
     $price = get_post_meta($post->ID, 'wsbp_services_price', true);
     $duration = get_post_meta($post->ID, 'wsbp_services_duration', true);
     $per_person = get_post_meta($post->ID, 'wsbp_services_capacity', true);
     $short_des = get_post_meta($post->ID, 'wsbp_services_short_des', true);
     ?>
    <div class="wsbp-custom-field-metabox">
      <div class="row mt-3 p-2">
        <div class="col-md-4">
          <label for="wsbp_services_price" class="form-label"><?php esc_html_e( 'Price', 'wsbp' ); ?></label>
          <input type="text" class="form-control" id="wsbp_services_price" name="wsbp_services_price" value="<?php echo esc_html__( $price ); ?>" required>
        </div>
        <div class="col-md-4">
          <label for="wsbp_services_duration" class="form-label"><?php esc_html_e( 'Duration', 'wsbp' ); ?></label>   
          <?php
            $duration_array = array();
            for ( $i = 15; $i <= 1440; $i += 15 ) {
                $hours = floor( $i / 60 );
                $minutes = $i % 60;
                $label = '';
                if ( $hours > 0 ) {
                    $label .= $hours . 'h ';
                }
                if ( $minutes > 0 ) {
                    $label .= $minutes . 'min';
                }
                $value = $hours * 60 + $minutes;
                $duration_array[$value] = $label;
            }
            ?>
            <select class="form-control" id="wsbp_services_duration" name="wsbp_services_duration">
            <?php
            foreach ( $duration_array as $value => $label ) {
                $selected = ( $value == $duration ) ? 'selected' : '';
                echo '<option value="' . esc_html__( $value ) . '" ' . esc_html__( $selected ) . '>' . esc_html__( $label ) . '</option>';
            }
            ?>
            </select>
      </div>   
        <div class="col-md-4">
        <label for="wsbp_services_capacity" class="form-label"><?php esc_html_e( 'Capacity', 'wsbp' ); ?></label>
        <select class="form-select" id="wsbp_services_capacity" name="wsbp_services_capacity" required>
        <?php
        for ( $i = 1; $i <= 50; $i++ ) {
          // check if the current option is selected
          $selected = ( $i == $per_person ) ? 'selected' : '';
          echo '<option value="' . esc_html__( $i ) . '" ' . esc_html__( $selected ) . '>' . esc_html__( $i ) . '</option>';
        }
        ?>
      </select>
    </div>
    <div class="col-md-12 mt-3">
        <label for="wsbp_services_short_des" class="form-label"><?php esc_html_e( 'Services Description', 'wsbp' ); ?></label>
        <textarea class="form-control" id="floatingTextarea2" name="wsbp_services_short_des" style="height: 100px"><?php echo esc_html__( $short_des );?></textarea>
    </div>

     <?php
   }

   public function wsbp_services_save_metabox($post_id) {
     if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
       return;
     }

     if (!current_user_can('edit_post', $post_id)) {
       return;
     }

     if (isset($_POST['wsbp_services_price'])) {
       update_post_meta($post_id, 'wsbp_services_price', sanitize_text_field($_POST['wsbp_services_price']));
     }

     if (isset($_POST['wsbp_services_duration'])) {
       update_post_meta($post_id, 'wsbp_services_duration', sanitize_text_field($_POST['wsbp_services_duration']));
     }

     if (isset($_POST['wsbp_services_capacity'])) {
       update_post_meta($post_id, 'wsbp_services_capacity', sanitize_text_field($_POST['wsbp_services_capacity']));
     }
     if (isset($_POST['wsbp_services_short_des'])) {
      update_post_meta($post_id, 'wsbp_services_short_des', sanitize_text_field($_POST['wsbp_services_short_des']));
    }
   }
}

new Wsbp_Services_Custom_Metabox_Register();
