<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Frontend {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
	 * Construct
	 */
	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'qcwf_add_to_cart_redirect' ) );
    }

	/**
	 * Instance
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Add to cart redirect
	 */
	public function qcwf_add_to_cart_redirect(){
		return wc_get_checkout_url();
	}

}

new Qcfw_Checkout_Frontend();

?>