<?php

namespace Wsbp_Addon;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin
{

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.3';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance()
	{

		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		if ($this->is_compatible()) {
			add_action('elementor/init', [$this, 'init']);
		}
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return false;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return false;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return false;
		}

		return true;
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'wsbp'),
			'<strong>' . esc_html__('Wsbp Addon', 'wsbp') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'wsbp') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wsbp'),
			'<strong>' . esc_html__('Elementor Wsbp Addon', 'wsbp') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'wsbp') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{

		if (isset($_GET['activate'])) unset($_GET['activate']);

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'wsbp'),
			'<strong>' . esc_html__('Elementor Wsbp Addon', 'wsbp') . '</strong>',
			'<strong>' . esc_html__('PHP', 'wsbp') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init()
	{

		add_action('elementor/widgets/register', [$this, 'register_widgets']);
		add_action('wp_enqueue_scripts', [$this, 'dazzel_text_enqueue_script']);
	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager)
	{

		//Booking widget 
		require_once(__DIR__ . '/widgets/wsbp-booking-form-widget.php');
		$widgets_manager->register(new Wsbp_Booking_Widget());
		//Services widget
		require_once(__DIR__ . '/widgets/wsbp-all-services-widget.php');
		$widgets_manager->register(new Wsbp_All_Services_Widget());
	}

	/**
	 * Enqueue script
	 */
	public function dazzel_text_enqueue_script()

	{

		wp_enqueue_style('Semantic',  plugin_dir_url(__FILE__) . 'assets/css/semantic.min.css', array(), '2.1.4', "all");
		wp_enqueue_style('Bootstrap', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css', array(), '5.0', "all");
		wp_enqueue_style('wsbp_main-style', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), '1.0.0', 'all');

		wp_enqueue_script('semantic-js', plugin_dir_url(__FILE__) . 'assets/js/semantic.js', array('jquery'), '2.1.4', true);
		wp_enqueue_script('bootstrap-boundle', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.boundle.js', array(), '5.2.3', true);
		wp_enqueue_script('fontawesome',  plugin_dir_url(__FILE__) . 'assets/js/fontawesome.all.js', array('jquery'), '5.0.1', true);
		wp_enqueue_script('wsbp_custom-js', plugin_dir_url(__FILE__) . 'assets/js/custom.js', array('jquery'), null, true);
		// Localize the script with the input value
		wp_localize_script('wsbp_custom-js', 'wsbp_plugin_data', array(
			'home_url' => esc_url(home_url()),
		 ));
	}
}
