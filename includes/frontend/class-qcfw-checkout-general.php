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

	/**
     * Register plugin frontend.
     */
	public function register_qcfw_checkout_general(){
		add_filter( 'woocommerce_add_to_cart_redirect', array( $this, 'qcwf_checkout_add_to_cart_redirect' ) );
		add_filter( 'woocommerce_get_script_data', array($this, 'qcwf_checkout_get_script_data_filter'), 10, 2 );
	}

	/**
	 * Add to cart redirect
	 */
	public function qcwf_checkout_add_to_cart_redirect() {
		//Shop page Buy now button redirect
		if(isset($_POST['qcfw_checkout']) || isset($_GET['qcfw_checkout'])){
			$shop_btn_redirect_link = Qcfw_Checkout_Buy_Now::qcwf_checkout_shop_buy_now_btn_redirect();
			return $shop_btn_redirect_link;
		}

		//Single page Buy now button redirect
		if(isset($_POST['qcfw_checkouts']) || isset($_GET['qcfw_checkouts'])){
			$single_btn_redirect_link = Qcfw_Checkout_Single_Buy_Now::qcwf_checkout_single_buy_now_btn_redirect();
			return $single_btn_redirect_link;
		}

		//Global Redirect
		$settings       					= Qcfw_Checkout_Settings::get_settings();
		$qcfw_global_redirect_options 		= isset( $settings['qcfw_global_redirect_options'] ) ? $settings['qcfw_global_redirect_options'] : '';
		switch ( $qcfw_global_redirect_options ) {
			case 'no':
				return wc_get_cart_url();
			case 'cart':
				return wc_get_cart_url();
			case 'checkout':
				return wc_get_checkout_url();
			default:
				return wc_get_checkout_url();
		}
	}

	public function qcwf_checkout_get_script_data_filter($params, $handle) {

		$settings       					= Qcfw_Checkout_Settings::get_settings();
		$qcfw_global_redirect_options 		= isset( $settings['qcfw_global_redirect_options'] ) ? $settings['qcfw_global_redirect_options'] : '';
		
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