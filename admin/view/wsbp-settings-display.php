<?php 
/**
 *  Render booking metabox info
 *
 */

function salon_booking_plugin_menu_settings(){
   ?>
      <H3>General Settings</H3>
     
  <div class="wrap">
    <form method="post" action="options.php">
      <?php settings_fields( 'wsbp-plugin-settings' ); ?>
      <?php do_settings_sections( 'wsbp-settings' ); ?>
      <table class="form-table">
      <tr valign="top">
         <th scope="row">Shop Start Time:</th>
         <td><input type="time" name="wsbp_shop_start_time"  value="<?php echo esc_attr( get_option( 'wsbp_shop_start_time', '00:00:00' ) ); ?>" /></td>
         </tr>
         <tr valign="top">
         <th scope="row">Shop End Time:</th>
         <td><input type="time" name="wsbp_shop_end_time"  value="<?php echo esc_attr( get_option( 'wsbp_shop_end_time', '23:59:59'  ) ); ?>" /></td>
      </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}

