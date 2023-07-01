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
		add_filter( 'woocommerce_enable_order_notes_field', array( $this, 'qcwf_checkout_rander_remove_order_notes' ) );
		add_filter( 'woocommerce_checkout_terms_and_conditions', array( $this, 'qcwf_checkout_rander_remove_policy' ) );
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
     * Removed checkout Order notes
     */
	public function qcwf_checkout_rander_remove_order_notes($string) {
		$qcwf_checkout_remove_order_notes = get_option('qcwf_checkout_remove_order_notes', 'no');
	
		switch ($qcwf_checkout_remove_order_notes) {
			case 'yes':
				$string = false;
				break;
			default:
				// No action required, $string keeps its original value
				break;
		}
	
		return $string;
	}

	/**
     * Removed checkout policy and trams and conditions
     */
	public function qcwf_checkout_rander_remove_policy() {
		$qcwf_checkout_remove_policy = get_option('qcwf_checkout_remove_policy', 'no');
		$qcwf_checkout_remove_terms = get_option('qcwf_checkout_remove_terms', 'no');
	
		switch ($qcwf_checkout_remove_policy) {
			case 'yes':
				remove_action('woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20);
				break;
			default:
				// No action required
				break;
		}
	
		switch ($qcwf_checkout_remove_terms) {
			case 'yes':
				remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
				break;
			default:
				// No action required
				break;
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