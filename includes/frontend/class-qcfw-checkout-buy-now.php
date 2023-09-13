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
     * Register plugin frontend.
     */
	public function register_qcfw_checkout_buy_now(){
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'qcwf_checkout_shop_buy_now_before_btn' ), 10 );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'qcwf_checkout_shop_buy_now_after_btn' ), 11 );
	}

	public function qcfw_shop_buy_now_button_html() {

		$settings   = Qcfw_Checkout_Settings::get_settings();
		$label 		= isset( $settings['qcwf_checkout_shop_buy_now_btn_label'] ) ? $settings['qcwf_checkout_shop_buy_now_btn_label'] : '';

		
		global $product;
		$product_id = $product->get_id();
		$link = $this->get_shop_add_to_cart_link($product_id);
		
		if ( $product->get_type() == 'simple' ) {
			return '<a class="qcfw_shop_buy_now_button button" href="'. $link .'">'. $label .'</a>';
		}
	}

	public function get_shop_add_to_cart_link($product_id) {
		$product = wc_get_product($product_id);
		$shop_add_to_cart_link = $product->add_to_cart_url() . '&qcfw_checkout=1';
		return $shop_add_to_cart_link;
	}

	public function qcwf_checkout_shop_buy_now_before_btn() {
		$shop_buy_now_before_btn_position = get_option( 'qcwf_checkout_shop_buy_now_btn_position', 'after_btn' );
		$shop_buy_now_switch_url = get_option( 'qcwf_checkout_shop_buy_now_btn_switch', 'no' );
	
		switch ($shop_buy_now_switch_url) {
			case 'yes':
				switch ($shop_buy_now_before_btn_position) {
					case 'before_btn':
						echo $this->qcfw_shop_buy_now_button_html();
						break;
				}
				break;
		}
	}
	
	public function qcwf_checkout_shop_buy_now_after_btn() {
		$shop_buy_now_after_btn_position = get_option( 'qcwf_checkout_shop_buy_now_btn_position', 'after_btn' );
		$shop_buy_now_switch_url = get_option( 'qcwf_checkout_shop_buy_now_btn_switch', 'no' );
	
		switch ($shop_buy_now_switch_url) {
			case 'yes':
				switch ($shop_buy_now_after_btn_position) {
					case 'after_btn':
						echo $this->qcfw_shop_buy_now_button_html();
						break;
				}
				break;
		}
	}

	public static function qcwf_checkout_shop_buy_now_btn_redirect(){
		$settings   									= Qcfw_Checkout_Settings::get_settings();
		$qcwf_checkout_shop_buy_now_btn_redirect_url 	= isset( $settings['qcwf_checkout_shop_buy_now_btn_redirect_url'] ) ? $settings['qcwf_checkout_shop_buy_now_btn_redirect_url'] : '';
		
		if($qcwf_checkout_shop_buy_now_btn_redirect_url == 'checkout'){
			$checkout = wc_get_checkout_url();
		}else{
			$checkout = wc_get_cart_url();
		}

		return $checkout;
	}

}