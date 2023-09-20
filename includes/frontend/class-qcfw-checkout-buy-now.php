<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-settings.php';


class Qcfw_Checkout_Buy_Now {

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
     * This constructor initializes the Qcfw_Checkout_Settings and determines the placement
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
        $qcwf_checkout_shop_buy_now_btn_position  = isset($settings['qcwf_checkout_shop_buy_now_btn_position']) ? $settings['qcwf_checkout_shop_buy_now_btn_position'] : '';
        
        if ( ! empty( $qcwf_checkout_shop_buy_now_btn_position ) ) {
            /** Based on the selected position, add the appropriate action hook to display the button. */
            switch ($qcwf_checkout_shop_buy_now_btn_position) {
                case 'over_product_image':
                    add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'add_qcfw_button' ], 9 );
                    break;
                case 'over_product_image_hover':
                    add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'add_qcfw_button' ], 10);
                    break;
                case 'after_title':
                    add_action( 'woocommerce_shop_loop_item_title', [ $this, 'add_qcfw_button' ], 11 );
                    break;
                case 'after_rating':
                    add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'add_qcfw_button' ], 6 );
                    break;
                case 'after_price':
                    add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'add_qcfw_button' ], 11 );
                    break;
                case 'before_add_to_cart':
                    add_action( 'woocommerce_after_shop_loop_item', [ $this, 'add_qcfw_button' ], 9 );
                    break;
                case 'after_add_to_cart':
                    add_action( 'woocommerce_after_shop_loop_item', [ $this, 'add_qcfw_button' ], 11 );
                    break;
                default:
                    add_action( 'woocommerce_after_shop_loop_item', [ $this, 'add_qcfw_button' ], 11 );
                    break;
            }
        }   

	}

	/**
     * Adds the quick checkout button if enabled by user settings.
     */
    public function add_qcfw_button(){
        /** Get the user settings for qcfw. */
        $settings       = Qcfw_Checkout_Settings::get_settings();
        $qcwf_checkout_shop_buy_now_btn_switch    = isset( $settings['qcwf_checkout_shop_buy_now_btn_switch'] ) ? $settings['qcwf_checkout_shop_buy_now_btn_switch'] : false;
        if($qcwf_checkout_shop_buy_now_btn_switch){
            echo  $this->qcfw_shop_buy_now_button_html();
        }

    }

	public function qcfw_shop_buy_now_button_html() {

		$settings   = Qcfw_Checkout_Settings::get_settings();
		$label 		= isset( $settings['qcwf_checkout_shop_buy_now_btn_label'] ) ? $settings['qcwf_checkout_shop_buy_now_btn_label'] : '';

		global $product;
		$product_id = $product->get_id();
        if ($product && $product->get_type() !== 'external') {
            return '<button id="qcfw_shop_buy_now_button" class="qcfw_shop_buy_now_button button " data-product-id="'. $product_id .'">'. $label .'</button>';
		}
	}

}

/** Initialize the class instance. */
Qcfw_Checkout_Buy_Now::get_instance();