<?php 
/**
 * Plugin Name: Post Shortcode
 * Plugin URI: 
 * Description: An post display beautifully.
 * Version: 1.0.0
 * Author: Sachin Jadhav
 * Author URI: http://sachin8600.wordpress.com/
 * Requires at least: 4.0
 * Tested up to: 4.1
 *
 * Text Domain: pcs
 * Domain Path: /languages/
 *
 * @package pcs
 * @author 
 */ 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'PostCustomize' ) ) :
/**
 * Main PostCustomize Class
 *
 * @class PostCustomize
 * @version	1.0.0
 */
final class PostCustomize {
	/**
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * @var PostCustomize The single instance of the class
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * Main PostCustomize Instance
	 *
	 * Ensures only one instance of PostCustomize is loaded or can be loaded.
	 *
	 * @since 1.0
	 * @static
	 * @see pcs()
	 * @return PostCustomize - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	/**
	 * Cloning is forbidden.
	 * @since 1.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'pcs' ), '1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since 1.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'pcs' ), '1.0' );
	}


	/**
	 * PostCustomize Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters
	 * @since  1.0
	 */
	private function init_hooks() {
		add_action('wp_enqueue_scripts', array($this,'pcs_style_script') );
	}

	/**
	 * Define pcs Constants
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir();
		$this->define( 'PCS_DIR', plugin_dir_path( __FILE__ ) );
		$this->define( 'PCS_URL',plugin_dir_url( __FILE__ ) );
		$this->define( 'PCS_CSS_URL',PCS_URL."css/" );
		$this->define( 'PCS_JS_URL',PCS_URL."js/" );
		$this->define( 'PCS_IMG_URL',PCS_URL."images/" );
		$this->define( 'PCS_VERSION', $this->version );
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
		include_once("inc/box-style-post.php");
	}

	/**
	 * Used to add css and js file on the frontend.
	 */
	function pcs_style_script(){
		wp_enqueue_style('normalize',PCS_CSS_URL."normalize.css");
		wp_enqueue_style('bsp',PCS_CSS_URL."box-style-posts.css");
	}
}
endif;
/**
 * Returns the main instance of pcs to prevent the need to use globals.
 *
 * @since  1.0
 * @return PostCustomize
 */
function pcs() {
	return PostCustomize::instance();
}

// Global for backwards compatibility.
$GLOBALS['pcs'] = pcs();
?>