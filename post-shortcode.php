<?php 
/**
 * Plugin Name: Post Shortcode
 * Plugin URI: 
 * Description: An post display beautifully.
 * Version: 2.0.1
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
	public $version = '2.0.0';

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
		// enque js css to front end
		add_action('wp_enqueue_scripts', array($this,'pcs_style_script') );
		//enque js css to backend end
		add_action('admin_enqueue_scripts', array($this,'pcs_admin_style_script') );
		//add tiny editor button
		//add_action('admin_head', array($this,'pcs_add_tiny_editor_button') );
		//add menu page
		add_action( 'admin_menu', array($this,'register_pcs_shortcode_menu_page') );
		//add widget 
		add_action( 'widgets_init', array($this,'register_pcs_widget') );
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
	 * @since 2.0
	 */
	public function includes() {
		include_once("inc/pcs-shortcode.php");
		include_once("inc/pcs-widget.php");
		include_once("inc/tiny-shortcode.php");
		include_once("inc/pcs-ajax.php");
		include_once("inc/pcs-menu.php");
	}

	/**
	 * Used to add css and js file on the frontend.
	 * @since 2.0
	 */
	function pcs_style_script(){
		wp_enqueue_style('pcs',PCS_CSS_URL."pcs.css");
	}
	/**
	 * Add menu page in admin menu
	 * @since 2.0
	 */
	function register_pcs_shortcode_menu_page(){
		add_menu_page( 'Post Shortcode', 'Post Shortcode', 'manage_options', 'post-shortcode', 'fn_pcs_menu', PCS_IMG_URL.'icon.png', 61.15 ); 
	}
	/**
	 * Add tiny editor button
	 */
	function pcs_add_tiny_editor_button() {
	    global $typenow;
	    // check user permissions
	    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
	    return;
	    }
	    // check if WYSIWYG is enabled
	    if ( get_user_option('rich_editing') == 'true') {
	        add_filter("mce_external_plugins", array($this,"pcs_add_tinymce_plugin") );
        	add_filter('mce_buttons', array($this,'pcs_register_my_tc_button') );
    	}
    }
    function pcs_add_tinymce_plugin($plugin_array) {
        $plugin_array['pcs_tc_button'] = PCS_JS_URL."tiny-shortcode.js"; // CHANGE THE BUTTON SCRIPT HERE
        return $plugin_array;
    }
    function pcs_register_my_tc_button($buttons) {
       array_push($buttons, "pcs_tc_button");
       return $buttons;
    }
    /**
     * Used to add css and js file on the admin side / back end.
     */
    function pcs_admin_style_script(){
    	wp_enqueue_style('pcs-admin',PCS_CSS_URL.'pcs-admin.css');
    }
     /**
     * Used to add widget
     */
    function register_pcs_widget(){
    	register_widget( 'PCS_Widget' );
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