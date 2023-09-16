<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://https://github.com/noruzzamanrubel
 * @since      1.0.0
 *
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/includes
 * @author     Noruzzaman <noruzzamanrubel@gmail.com>
 */
class Qcfw_Checkout {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Qcfw_Checkout_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'QCFW_CHECKOUT_VERSION' ) ) {
			$this->version = QCFW_CHECKOUT_VERSION;
		} else {
			$this->version = '1.3.0';
		}
		$this->plugin_name = 'qcfw-checkout';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->register_settings();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Qcfw_Checkout_Loader. Orchestrates the hooks of the plugin.
	 * - Qcfw_Checkout_i18n. Defines internationalization functionality.
	 * - Qcfw_Checkout_Admin. Defines all hooks for the admin area.
	 * - Qcfw_Checkout_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-qcfw-checkout-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-qcfw-checkout-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-qcfw-checkout-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-qcfw-checkout-public.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'libs/codestar-framework/codestar-framework.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-qcfw-checkout-general.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-qcfw-checkout-buy-now.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-qcfw-checkout-single-buy-now.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-qcfw-checkout-add-to-cart.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-qcfw-checkout-page.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/backend/class-qcfw-checkout-settings.php';

		$this->loader = new Qcfw_Checkout_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Qcfw_Checkout_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Qcfw_Checkout_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Qcfw_Checkout_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_filter( 'plugin_action_links_' . QCFW_CHECKOUT_BASE_NAME, $plugin_admin, 'qcfw_checkout_add_action_plugin', 15, 2 );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Qcfw_Checkout_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Qcfw_Checkout_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Register plugin settings.
	 *
	 * @access private
	 */
    private function register_settings() {
        $plugin_settings = new Qcfw_Checkout_Settings();
        $plugin_settings->register_qcfw_options_settings();
    }
}
