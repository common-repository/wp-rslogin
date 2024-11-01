<?php
/**
 * Plugin Name: WP RSlogin
 * Plugin URI: http://www.sutanaryan.com/wp-rslogin/
 * Description: An elegant jQuery Ajax Wordpress plugin that helps your users login without touching in the admin panel.
 * Version: 2.0
 * Author: Ryan Sutana
 * Author URI: http://www.sutanaryan.com/
 * Requires at least: 4.1
 * Tested up to: 4.8
 * License: GPL2
 *
 * Text Domain: wp-rslogin
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if class already exist
if( ! class_exists('WP_RSLogin')) :

/**
 * Main Product Selector
 *
 * @class WP_RSLogin
 * @version	1.0
 */
final class WP_RSLogin {

	/**
	 * @var WP_PLUGIN_SELECTOR The single instance of the class
	 * @since 2.1
	 */
	protected static $_instance = null;
	
	/**
	 * Main WP_PLUGIN_SELECTOR Instance
	 *
	 * Ensures only one instance of WP_PLUGIN_SELECTOR is loaded or can be loaded.
	 *
	 * @since 2.1
	 * @static
	 * @see WC()
	 * @return WP_PLUGIN_SELECTOR - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * Cloning is forbidden.
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-rslogin' ), '1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-rslogin' ), '1.0' );
	}

	/**
	 * Magic method to prevent a fatal error when calling a method that doesn't exist.
	 *
	 * @since  1.0
	 * @access public
	 * @return void
	 */
	public function __call( $method = '', $args = array() ) {
		_doing_it_wrong( "WP_RSLogin::{$method}", __( 'Method does not exist.', 'wp-rslogin' ), '1.0' );
		unset( $method, $args );
		
		return null;
	}
	
	/**
	 * @desc	Construct the plugin object
	 */
	public function __construct()
	{
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Define Constants
	 */
	private function define_constants() {
		$this->define( 'RS_DOMAIN', 'rs-login' );
		$this->define( 'RS_PLUGIN_URL', plugin_dir_url(__FILE__) );
		$this->define( 'RS_PLUGIN_PATH', plugin_dir_path(__FILE__) );
		$this->define( 'RS_PLUGIN_INC_PATH', RS_PLUGIN_PATH .'inc' );
		$this->define( 'RS_PLUGIN_LIB_PATH', RS_PLUGIN_PATH .'lib' );
	}

	/**
	 * Define constant if not already set
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		include_once ( RS_PLUGIN_LIB_PATH . '/init.php' );
		include_once ( RS_PLUGIN_INC_PATH . '/rslogin.php' );
		include_once ( RS_PLUGIN_INC_PATH . '/shortcode.php' );
	}

	/**
	 * Hook into actions and filters
	 * @since  1.0
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'register_ryan_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_rslogin_scripts' ) );
	}

	public function register_ryan_scripts() {
		// Style
		wp_register_style( 'rs_login_style', plugins_url('css/rslogin-style.css', __FILE__));
		
		// Scripts
		wp_register_script( 'rs_login_custom_jquery', plugins_url('js/custom.js', __FILE__), array('jquery'));
		
		/*
		 * Plugin init
		 */
		wp_enqueue_script( 'rslogin-request', plugin_dir_url( __FILE__ ) . 'js/rslogin.js', array( 'jquery' ) );
		wp_localize_script( 'rslogin-request', 'rs_login', array(
			'url' => admin_url( 'admin-ajax.php' ),
		) );
	}

	public function enqueue_rslogin_scripts() {
		// Style
		wp_enqueue_style( 'rs_login_style' );

		// Scripts
	    wp_enqueue_script( 'rs_login_custom_jquery' );  
	}

}
	
endif;

/**
 * Returns the main instance of WP_RSLogin to prevent the need to use globals.
 *
 * @since  1.0
 * @return WP_RSLogin
 */
function RS_Login() {
	return WP_RSLogin::instance();
}

// Global for backwards compatibility.
$GLOBALS['rs_login'] = RS_Login();