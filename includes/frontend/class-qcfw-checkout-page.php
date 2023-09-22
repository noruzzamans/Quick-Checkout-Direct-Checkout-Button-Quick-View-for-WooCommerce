<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-settings.php';


class Qcfw_Checkout_Page {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
     * Returns the single instance of the class.
     *
     * @return Qcfw_Checkout_Buy_Now Singleton instance of the class.
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

	public function __construct() { 
		add_action( 'woocommerce_before_checkout_form', array( $this, 'qcfw_checkout_rander_remove_coupon' ), 9 );
		add_filter( 'woocommerce_checkout_fields', array( $this, 'qcfw_checkout_rander_remove_fields' ));
		add_filter( 'woocommerce_enable_order_notes_field', array( $this, 'qcfw_checkout_rander_remove_order_notes' ) );
		add_filter( 'woocommerce_checkout_terms_and_conditions', array( $this, 'qcfw_checkout_rander_remove_policy' ) );
	}

	/**
     * Removed checkout coupon
     */
	public function qcfw_checkout_rander_remove_coupon() {
		$settings   					= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_coupon_form 	= isset( $settings['qcfw_checkout_remove_coupon_form'] ) ? $settings['qcfw_checkout_remove_coupon_form'] : '';
		switch ($qcfw_checkout_remove_coupon_form) {
			case '1':
				remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
				break;
			default:
				// No action required
				break;
		}

	}
	
	/**
     * Removed checkout fields
     */
	public function qcfw_checkout_rander_remove_fields($fields) {
		$settings   					= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_fields 	= isset( $settings['qcfw_checkout_remove_fields'] ) ? $settings['qcfw_checkout_remove_fields'] : '';
	
		if ($qcfw_checkout_remove_fields) {
			$billing_fields_to_remove = array_map(function ($key) {
				return 'billing_' . $key;
			}, $qcfw_checkout_remove_fields);
	
			$shipping_fields_to_remove = array_map(function ($key) {
				return 'shipping_' . $key;
			}, $qcfw_checkout_remove_fields);
	
			$fields['billing'] = array_diff_key($fields['billing'], array_flip($billing_fields_to_remove));
			$fields['shipping'] = array_diff_key($fields['shipping'], array_flip($shipping_fields_to_remove));
		}
	
		return $fields;
	}

	/**
     * Removed checkout Order notes
     */
	public function qcfw_checkout_rander_remove_order_notes($string) {
		$settings   						= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_order_notes 	= isset( $settings['qcfw_checkout_remove_order_notes'] ) ? $settings['qcfw_checkout_remove_order_notes'] : '';
	
		switch ($qcfw_checkout_remove_order_notes) {
			case '1':
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
	public function qcfw_checkout_rander_remove_policy() {
		$settings   						= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_policy 	= isset( $settings['qcfw_checkout_remove_policy'] ) ? $settings['qcfw_checkout_remove_policy'] : '';
		$qcfw_checkout_remove_terms 	= isset( $settings['qcfw_checkout_remove_terms'] ) ? $settings['qcfw_checkout_remove_terms'] : '';
	
		switch ($qcfw_checkout_remove_policy) {
			case '1':
				remove_action('woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20);
				break;
			default:
				// No action required
				break;
		}
	
		switch ($qcfw_checkout_remove_terms) {
			case '1':
				remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
				break;
			default:
				// No action required
				break;
		}
	}

}
/** Initialize the class instance. */
Qcfw_Checkout_Page::get_instance();