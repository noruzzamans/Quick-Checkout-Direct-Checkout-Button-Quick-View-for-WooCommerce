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
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'qcwf_checkout_add_setting_tab' ), 50 );
    }

	/**
	 * Add tab
	 *
	 * @param array $settings_tabs Settings tabs.
	 */
	public function qcwf_checkout_add_setting_tab( $settings_tabs ) {
		$settings_tabs[ QCFW_CHECKOUT_SLUG ] = esc_html__( 'Quick Checkout', 'qcfw-checkout' );
		return $settings_tabs;
	}

    public function qcwf_checkout_admin_menu(){
		add_submenu_page( 'woocommerce', esc_html__( 'Quick Checkout', 'qcfw-checkout' ), esc_html__( 'Quick Checkout', 'qcfw-checkout' ), 'manage_woocommerce', admin_url( 'admin.php?page=wc-settings&tab=' . sanitize_title( QCFW_CHECKOUT_SLUG ) ) );
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