<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-settings.php';


class Qcfw_Checkout_Add_To_Cart {

   /**
     * The single instance of the class.
     */
    protected static $instance;

    /**
     * Returns the single instance of the class.
     *
     * @return Qcfw_Checkout_Add_To_Cart Singleton instance of the class.
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

	public function __construct() { 
		add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'qcfw_checkout_shop_add_to_cart_button_text_archives' ));
		add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'qcfw_checkout_single_add_to_cart_button_text_single' ));
	}


	public function qcfw_checkout_shop_add_to_cart_button_text_archives(){

		global $product;

		// Ensure $product is defined and is an instance of WC_Product before proceeding
		if ( ! isset( $product ) || ! is_a( $product, 'WC_Product' ) ) {
			return __( 'Add to Cart', 'qcfw-checkout' );
		}
		
		$product_type 									= $product->get_type();
		$settings       								= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_shop_simple_add_to_cart_btn 		= isset( $settings['qcfw_checkout_shop_simple_add_to_cart_btn'] ) ? $settings['qcfw_checkout_shop_simple_add_to_cart_btn'] : '';
		$qcfw_checkout_shop_variable_add_to_cart_btn 	= isset( $settings['qcfw_checkout_shop_variable_add_to_cart_btn'] ) ? $settings['qcfw_checkout_shop_variable_add_to_cart_btn'] : '';
		$qcfw_checkout_shop_grouped_add_to_cart_btn 	= isset( $settings['qcfw_checkout_shop_grouped_add_to_cart_btn'] ) ? $settings['qcfw_checkout_shop_grouped_add_to_cart_btn'] : '';
		$qcfw_checkout_shop_external_add_to_cart_btn 	= isset( $settings['qcfw_checkout_shop_external_add_to_cart_btn'] ) ? $settings['qcfw_checkout_shop_external_add_to_cart_btn'] : '';
		
		switch ($product_type) {
			case 'simple':
				return $qcfw_checkout_shop_simple_add_to_cart_btn;
				break;
			case 'variable':
				return $qcfw_checkout_shop_variable_add_to_cart_btn;
				break;
			case 'grouped':
				return $qcfw_checkout_shop_grouped_add_to_cart_btn;
				break;
			case 'external':
				return $qcfw_checkout_shop_external_add_to_cart_btn;
				break;
			default:
				return __( 'Add to Cart', 'qcfw-checkout' );
				break;
		}
	}	

	public function qcfw_checkout_single_add_to_cart_button_text_single(){

		global $product;
		$product_type 									= $product->get_type();
		$settings       								= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_single_simple_add_to_cart_btn 	= isset( $settings['qcfw_checkout_single_simple_add_to_cart_btn'] ) ? $settings['qcfw_checkout_single_simple_add_to_cart_btn'] : '';
		$qcfw_checkout_single_variable_add_to_cart_btn 	= isset( $settings['qcfw_checkout_single_variable_add_to_cart_btn'] ) ? $settings['qcfw_checkout_single_variable_add_to_cart_btn'] : '';
		$qcfw_checkout_single_grouped_add_to_cart_btn 	= isset( $settings['qcfw_checkout_single_grouped_add_to_cart_btn'] ) ? $settings['qcfw_checkout_single_grouped_add_to_cart_btn'] : '';
		$qcfw_checkout_single_external_add_to_cart_btn 	= isset( $settings['qcfw_checkout_single_external_add_to_cart_btn'] ) ? $settings['qcfw_checkout_single_external_add_to_cart_btn'] : '';
		
		switch ($product_type) {
			case 'simple':
				return $qcfw_checkout_single_simple_add_to_cart_btn;
				break;
			case 'variable':
				return $qcfw_checkout_single_variable_add_to_cart_btn;
				break;
			case 'grouped':
				return $qcfw_checkout_single_grouped_add_to_cart_btn;
				break;
			case 'external':
				return $qcfw_checkout_single_external_add_to_cart_btn;
				break;
			default:
				return __( 'Add to Cart', 'qcfw-checkout' );
				break;
		}
	}

}

/** Initialize the class instance. */
Qcfw_Checkout_Add_To_Cart::get_instance();