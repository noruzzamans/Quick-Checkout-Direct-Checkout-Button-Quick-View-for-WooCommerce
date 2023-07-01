<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-add-to-cart-setting.php';


class Qcfw_Checkout_Add_To_Cart {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
     * Register plugin frontend.
     */
	public function register_qcfw_checkout_add_to_cart(){
		add_filter( 'woocommerce_product_add_to_cart_text', array( $this, 'qcwf_checkout_shop_add_to_cart_button_text_archives' ));
		add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'qcwf_checkout_single_add_to_cart_button_text_single' ));
	}

	public function qcwf_checkout_shop_add_to_cart_button_text_archives()
	{
		$qcwf_checkout_shop_simple_add_to_cart_btn = get_option('qcwf_checkout_shop_simple_add_to_cart_btn', 'Add to cart');
		$qcwf_checkout_shop_variable_add_to_cart_btn = get_option('qcwf_checkout_shop_variable_add_to_cart_btn', 'Add to cart');
		$qcwf_checkout_shop_grouped_add_to_cart_btn = get_option('qcwf_checkout_shop_grouped_add_to_cart_btn', 'Add to cart');
		$qcwf_checkout_shop_external_add_to_cart_btn = get_option('qcwf_checkout_shop_external_add_to_cart_btn', 'Add to cart');
		global $product;
		$product_type = $product->get_type();
		
		switch ($product_type) {
			case 'simple':
				return $qcwf_checkout_shop_simple_add_to_cart_btn;
				break;
			case 'variable':
				return $qcwf_checkout_shop_variable_add_to_cart_btn;
				break;
			case 'grouped':
				return $qcwf_checkout_shop_grouped_add_to_cart_btn;
				break;
			case 'external':
				return $qcwf_checkout_shop_external_add_to_cart_btn;
				break;
			default:
				return __( 'Add to Cart', 'qcfw-checkout' );
				break;
		}
	}	

	public function qcwf_checkout_single_add_to_cart_button_text_single(){
		$qcwf_checkout_single_simple_add_to_cart_btn = get_option('qcwf_checkout_single_simple_add_to_cart_btn', 'Add to cart');
		$qcwf_checkout_single_variable_add_to_cart_btn = get_option('qcwf_checkout_single_variable_add_to_cart_btn', 'Add to cart');
		$qcwf_checkout_single_grouped_add_to_cart_btn = get_option('qcwf_checkout_single_grouped_add_to_cart_btn', 'Add to cart');
		$qcwf_checkout_single_external_add_to_cart_btn = get_option('qcwf_checkout_single_external_add_to_cart_btn', 'Add to cart');
		global $product;
		$product_type = $product->get_type();
		
		switch ($product_type) {
			case 'simple':
				return $qcwf_checkout_single_simple_add_to_cart_btn;
				break;
			case 'variable':
				return $qcwf_checkout_single_variable_add_to_cart_btn;
				break;
			case 'grouped':
				return $qcwf_checkout_single_grouped_add_to_cart_btn;
				break;
			case 'external':
				return $qcwf_checkout_single_external_add_to_cart_btn;
				break;
			default:
				return __( 'Add to Cart', 'qcfw-checkout' );
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