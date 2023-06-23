<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-buy-now-setting.php';


class Qcfw_Checkout_Buy_Now {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
     * Register plugin frontend.
     */
	public function register_qcfw_checkout_buy_now(){
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'qcwf_checkout_shop_buy_now_before_btn' ), 10 );
		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'qcwf_checkout_shop_buy_now_after_btn' ), 11 );
		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'qcwf_checkout_shop_buy_now_btn_redirect' ) );
	}

	public function qcfw_shop_buy_now_buton_html() {
		global $qcfw_shop_button_link;
		global $qcfw_shop_button_label;
	
		$defaultLink = '#';
	
		$link = isset($qcfw_shop_button_link) ? esc_url($qcfw_shop_button_link) : $this->qcwf_checkout_shop_buy_now_btn_redirect();
		$label = isset($qcfw_shop_button_label) ? $qcfw_shop_button_label : $this->qcwf_checkout_shop_buy_now_label();
	
		return '<a class="qcfw_shop_buy_now_button button" href="'. $link .'">'. $label .'</a>';
	}

    public function qcwf_checkout_shop_buy_now_label() {
        $shop_buy_now_label = get_option( 'qcwf_checkout_shop_buy_now_btn_label', 'Buy Now' );
        return $shop_buy_now_label;
    }

	public function qcwf_checkout_shop_buy_now_before_btn() {
		$shop_buy_now_btn_position = get_option( 'qcwf_checkout_shop_buy_now_btn_position', 'after_btn' );
		$shop_buy_now_switch_url = get_option( 'qcwf_checkout_shop_buy_now_btn_switch', 'no' );
	
		switch ($shop_buy_now_switch_url) {
			case 'yes':
				switch ($shop_buy_now_btn_position) {
					case 'before_btn':
						echo $this->qcfw_shop_buy_now_buton_html();
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
						echo $this->qcfw_shop_buy_now_buton_html();
						break;
				}
				break;
		}
	}
	

	public function qcwf_checkout_shop_buy_now_btn_redirect(){
		$redirect_shop_buy_now_btn_url = get_option( 'qcwf_checkout_shop_buy_now_btn_redirect_url', 'checkout' );
		switch ( $redirect_shop_buy_now_btn_url ) {
			case 'cart':
				return wc_get_cart_url();
			case 'checkout':
				return wc_get_checkout_url();
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