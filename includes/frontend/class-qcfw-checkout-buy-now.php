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
	}

	public function qcfw_shop_buy_now_button_html() {

		$label = get_option( 'qcwf_checkout_shop_buy_now_btn_label', 'Buy Now' );
		$label_bg_color = get_option( 'qcwf_checkout_shop_buy_now_btn_bg_color', '#1c61e7' );
		$label_bg_hover_color = get_option( 'qcwf_checkout_shop_buy_now_btn_bg_hover_color', '#eb7a61' );
		$label_text_color = get_option( 'qcwf_checkout_shop_buy_now_btn_text_color', '#ffffff' );
		$label_text_hover_color = get_option( 'qcwf_checkout_shop_buy_now_btn_text_hover_color', '#ffffff' );
		?>
			<style>
				a.qcfw_shop_buy_now_button {
					background-color: <?php echo esc_html($label_bg_color); ?> !important;
					color: <?php echo esc_html($label_text_color); ?> !important;
				}
				a.qcfw_shop_buy_now_button:hover {
					background-color: <?php echo esc_html($label_bg_hover_color); ?> !important;
					color: <?php echo esc_html($label_text_hover_color); ?> !important;
				}
			</style>
		<?php
		
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
		$redirect_shop_buy_now_btn_url = get_option( 'qcwf_checkout_shop_buy_now_btn_redirect_url', 'checkout' );
		if($redirect_shop_buy_now_btn_url == 'checkout'){
			$checkout = wc_get_checkout_url();
		}else{
			$checkout = wc_get_cart_url();
		}

		return $checkout;
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