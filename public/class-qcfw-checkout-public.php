<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/public
 */
class Qcfw_Checkout_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		 /** Enqueue the main plugin CSS for the public-facing side of the site. */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/qcfw-checkout-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/** Enqueue the WooCommerce "Add to Cart" variation script. */
		wp_enqueue_script( 'wc-add-to-cart-variation' );

		/** Enqueue the Magnific JavaScript file for the public-facing side of the site. */
		wp_enqueue_script( $this->plugin_name.'-magnific', plugin_dir_url( __FILE__ ) . 'js/qcfw-checkout-quick-view-public-magnific.js', array( 'jquery' ), $this->version, false );

		/** Enqueue the main plugin JavaScript file for the public-facing side of the site.*/
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/qcfw-checkout-public.js', array( 'jquery' ), $this->version, false );

		/** Localize the main script with essential data. */
		wp_localize_script($this->plugin_name, 'qcfw_checkout_quick_view', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce( 'qcfw_checkout_quick_view_nonce' ),
		));

	}

}
