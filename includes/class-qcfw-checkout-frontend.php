<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/class-qcfw-checkout-setting.php';

$redirect_url = get_option( 'qcwf_checkout_general_cart_redirect_url', 'checkout' );


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
	public function qcwf_add_to_cart_redirect() {
		$redirect_url = get_option( 'qcwf_checkout_general_cart_redirect_url', 'checkout' );

		switch ( $redirect_url ) {
			case 'no':
				return false; // No redirection needed
			case 'checkout':
				return wc_get_checkout_url();
			// case 'custom':
			// 	$custom_url = get_option( 'qcwf_checkout_general_cart_redirect_custom_url', wc_get_checkout_url() );
			// 	return esc_url( $custom_url );
			default:
				return wc_get_checkout_url();
		}
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