<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-settings.php';


class Qcfw_Checkout_Single_Buy_Now {

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

	    /**
     * Class Constructor.
     *
     * This constructor initializes the Qcfw_Checkout_Single_Buy_Now and determines the placement
     * of the quick view button on WooCommerce shop loop items based on user settings. The placement can
     * be configured to display the button over the product image, after the title, after the rating,
     * after the price, before the add to cart button, or after the add to cart button.
     *
     * @since 1.0.0
     */
    public function __construct() {
        /** Get the user settings for Quick Checkout for WooCommerce. */
        $settings       = Qcfw_Checkout_Settings::get_settings();

        /** Determine the position of the quick view button based on user settings. */
        $qcwf_checkout_single_buy_now_btn_position  = isset($settings['qcwf_checkout_single_buy_now_btn_position']) ? $settings['qcwf_checkout_single_buy_now_btn_position'] : '';
        
        if ( ! empty( $qcwf_checkout_single_buy_now_btn_position ) ) {
            /** Based on the selected position, add the appropriate action hook to display the button. */
            switch ($qcwf_checkout_single_buy_now_btn_position) {
                case 'before_add_to_cart':
                    add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'add_single_qcfw_button' ], 10 );
                    break;
                case 'after_add_to_cart':
                    add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'add_single_qcfw_button' ], 10 );
                    break;
                default:
                    add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'add_single_qcfw_button' ], 10 );
                    break;
            }
        }   

	}

	/**
     * Adds the quick checkout button if enabled by user settings.
     */
    public function add_single_qcfw_button(){
        /** Get the user settings for qcfw. */
        $settings       = Qcfw_Checkout_Settings::get_settings();
        $qcwf_checkout_single_buy_now_btn_switch    = isset( $settings['qcwf_checkout_single_buy_now_btn_switch'] ) ? $settings['qcwf_checkout_single_buy_now_btn_switch'] : false;
        if($qcwf_checkout_single_buy_now_btn_switch){
            echo  $this->qcfw_single_buy_now_button_html();
        }

    }

	public function qcfw_single_buy_now_button_html() {
		$settings   = Qcfw_Checkout_Settings::get_settings();
		$label 		= isset( $settings['qcwf_checkout_single_buy_now_btn_label'] ) ? $settings['qcwf_checkout_single_buy_now_btn_label'] : '';

		global $product;
		$product_id = $product->get_id();
		$link = $this->get_single_add_to_cart_link($product_id);
		
		if ( $product->get_type() == 'simple' ) {
			return '<a class="qcfw_single_buy_now_button single_add_to_cart_button button" href="'. $link .'">'. $label .'</a>';
		}
	}

	public function get_single_add_to_cart_link($product_id) {
		$product = wc_get_product($product_id);
		$shop_add_to_cart_link = $product->add_to_cart_url() . '&qcfw_checkouts=1';
		return $shop_add_to_cart_link;
	}
	

	public static function qcwf_checkout_single_buy_now_btn_redirect(){

		$settings   									= Qcfw_Checkout_Settings::get_settings();
		$qcwf_checkout_single_buy_now_btn_redirect_url 	= isset( $settings['qcwf_checkout_single_buy_now_btn_redirect_url'] ) ? $settings['qcwf_checkout_single_buy_now_btn_redirect_url'] : '';

		if($qcwf_checkout_single_buy_now_btn_redirect_url == 'checkout'){
			$checkout = wc_get_checkout_url();
		}else{
			$checkout = wc_get_cart_url();
		}

		return $checkout;
	}

}
/** Initialize the class instance. */
Qcfw_Checkout_Single_Buy_Now::get_instance();