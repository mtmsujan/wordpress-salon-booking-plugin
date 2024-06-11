<?php
// Register the settings fields
function wsbp_plugin_settings() {
  register_setting( 'wsbp-plugin-settings', 'wsbp_shop_start_time' );
  register_setting( 'wsbp-plugin-settings', 'wsbp_shop_end_time' );
}
add_action( 'admin_init', 'wsbp_plugin_settings' );