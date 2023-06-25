<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/noruzzamanrubel
 * @since      1.0.0
 *
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/admin
 * @author     Noruzzaman <noruzzamanrubel@gmail.com>
 */
class Qcfw_Checkout_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Qcfw_Checkout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Qcfw_Checkout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/qcfw-checkout-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Qcfw_Checkout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Qcfw_Checkout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/qcfw-checkout-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * Setting link
     *
     * @param $actions
     * @return array
     */
	public function qcfw_checkout_add_action_plugin($actions){

		$qcfw_checkout_setting_link = array(
			'<a class="bd_toc_setting_button" href="'.esc_url(admin_url('/admin.php?page=wc-settings&tab=qcfw-checkout')).'">' . __( 'Settings', QCFW_CHECKOUT_TEXT_DOMAIN ) . '</a>',
		);

        $actions = array_merge( $actions, $qcfw_checkout_setting_link );

        return $actions;
	}

}
