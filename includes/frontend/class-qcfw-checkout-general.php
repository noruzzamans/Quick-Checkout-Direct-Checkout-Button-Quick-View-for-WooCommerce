<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-settings.php';


class Qcfw_Checkout_General {

   /**
     * The single instance of the class.
     */
    protected static $instance;

    /**
     * Returns the single instance of the class.
     *
     * @return Qcfw_Checkout_General Singleton instance of the class.
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'qcwf_checkout_add_to_cart_redirect' ) );
		add_filter( 'woocommerce_get_script_data', array($this, 'qcwf_checkout_get_script_data_filter'), 10, 2 );
	}

	/**
	 * Add to cart redirect
	 */
	public function qcwf_checkout_add_to_cart_redirect() {
		// Global Redirect setting
		$settings = Qcfw_Checkout_Settings::get_settings();
		$qcfw_global_redirect_options = isset($settings['qcfw_global_redirect_options']) ? $settings['qcfw_global_redirect_options'] : '';

		switch ($qcfw_global_redirect_options) {
			case 'no':
				return wc_get_cart_url();
			case 'cart':
				return wc_get_cart_url();
			case 'checkout':
			default:
				return wc_get_checkout_url();
		}
	}


	public function qcwf_checkout_get_script_data_filter($params, $handle) {

		$settings       								= Qcfw_Checkout_Settings::get_settings();
		$qcfw_global_redirect_options 					= isset( $settings['qcfw_global_redirect_options'] ) ? $settings['qcfw_global_redirect_options'] : '';
		
		switch ($qcfw_global_redirect_options) {
			case 'checkout':
				if ('wc-add-to-cart' == $handle) {
					$params = array_merge($params, array(
						'cart_redirect_after_add' => 'yes',
					));
				}
				break;
			
			case 'cart':
				if ('wc-add-to-cart' == $handle) {
					$params = array_merge($params, array(
						'cart_redirect_after_add' => 'yes',
					));
				}
				break;
				
			default:
				if ('wc-add-to-cart' == $handle) {
					$params = array_merge($params, array(
						'cart_redirect_after_add' => 'no',
					));
				}
				break;
		}
		
		return $params;
	}	

}

/** Initialize the class instance. */
Qcfw_Checkout_General::get_instance();