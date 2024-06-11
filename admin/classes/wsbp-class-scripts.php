<?php
/**
 * Enqueue Scripts
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}
class Wsbp_Salon_plugin_Scripts {
   /**
	 * Initialize scripts
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		add_action( 'admin_enqueue_scripts', array( $this, 'wsbp_salon_plugin_admin_scripts' ) );
      
	}

	/**
	 * Loads css files
	 *
	 * @access public
	 * @return void
	 */

    public function wsbp_salon_plugin_admin_scripts(){
		wp_enqueue_script('jquery');
      wp_enqueue_style( 'wsbp-admin-style', plugin_dir_url( dirname( __FILE__ )) . 'assets/css/wsbp-admin.css', array(), '1.0.0' );
      wp_enqueue_style( 'Bootstrap-5', plugin_dir_url( dirname( __FILE__ )) . 'assets/css/bootstrap.min.css', array(), '5.2.0' );
      wp_enqueue_script('wsbp-custom', plugin_dir_url( dirname( __FILE__ )) . 'js/wsbp-custom.js', array('jquery'), '1.0.0',true );

    }


}
new Wsbp_Salon_plugin_Scripts();