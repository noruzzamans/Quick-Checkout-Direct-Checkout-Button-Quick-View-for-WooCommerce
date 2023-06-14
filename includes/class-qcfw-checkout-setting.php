<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Settings {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

    public function register_qcfw_checkout_settings(){
        add_action('admin_menu', array($this, 'qcwf_checkout_admin_menu'));
    }

    public function qcwf_checkout_admin_menu(){
        add_submenu_page('woocommerce','Quick checkout for woocommerce setting', 'Quick checkout for woocommerce', 'manage_options', 'quick-checkout-for-woocommerce', array($this, 'qcwf_checkout_setting_options'));
    }

    public function qcwf_checkout_setting_options(){
        echo 'hello';
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