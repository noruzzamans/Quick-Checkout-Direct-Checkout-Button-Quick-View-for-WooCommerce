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
     * Register plugin frontend.
     */
	public function register_qcfw_checkout_frontend(){
		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'qcwf_add_to_cart_redirect' ) );
	}

	/**
	 * Add to cart redirect
	 */
	public function qcwf_add_to_cart_redirect(){
		return wc_get_checkout_url();
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

}