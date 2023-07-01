<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-page-setting.php';


class Qcfw_Checkout_Page {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
     * Register plugin frontend.
     */
	public function register_qcfw_checkout_page(){
		add_filter( 'woocommerce_checkout_fields', array( $this, 'qcwf_checkout_rander_remove_fields' ));
	}
	
	/**
     * Removed checkout fields
     */
	public function qcwf_checkout_rander_remove_fields($fields) {
		$qcwf_checkout_remove_fields = get_option('qcwf_checkout_remove_fields');
	
		if ($qcwf_checkout_remove_fields) {
			$billing_fields_to_remove = array_map(function ($key) {
				return 'billing_' . $key;
			}, $qcwf_checkout_remove_fields);
	
			$shipping_fields_to_remove = array_map(function ($key) {
				return 'shipping_' . $key;
			}, $qcwf_checkout_remove_fields);
	
			$fields['billing'] = array_diff_key($fields['billing'], array_flip($billing_fields_to_remove));
			$fields['shipping'] = array_diff_key($fields['shipping'], array_flip($shipping_fields_to_remove));
		}
	
		return $fields;
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