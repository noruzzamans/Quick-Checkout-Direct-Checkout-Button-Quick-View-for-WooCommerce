<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Settings {

	public static $plugin_name = QCFW_CHECKOUT_TEXT_DOMAIN;

    public function register_qcfw_checkout_settings(){
        add_action('admin_menu', array($this, 'qcwf_checkout_admin_menu'));
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'qcwf_checkout_add_setting_tab' ), 50 );

		add_action( 'woocommerce_sections_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_add_section' ), 99 );
		add_action( 'woocommerce_settings_save_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_save_settings' ) );
    }

	/**
	 * Add tab
	 *
	 * @param array $settings_tabs.
	 */
	public function qcwf_checkout_add_setting_tab( $settings_tabs ) {
		$settings_tabs[ QCFW_CHECKOUT_SLUG ] = esc_html__( 'Quick Checkout', QCFW_CHECKOUT_TEXT_DOMAIN );
		return $settings_tabs;
	}

    public function qcwf_checkout_admin_menu(){
		add_submenu_page( 'woocommerce', esc_html__( 'Quick Checkout', QCFW_CHECKOUT_TEXT_DOMAIN ), esc_html__( 'Quick Checkout', QCFW_CHECKOUT_TEXT_DOMAIN ), 'manage_woocommerce', admin_url( 'admin.php?page=wc-settings&tab=' . sanitize_title( QCFW_CHECKOUT_SLUG ) ) );
    }

	public function qcwf_checkout_settings(){
		return array(
			array(
				'id'   => 'qcwf_checkout_general_section_title',
				'name' => esc_html__( 'General', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type' => 'title',
				'desc' => esc_html__( 'Simplifies the checkout process.', QCFW_CHECKOUT_TEXT_DOMAIN ),
			),
			array(
				'id'       => 'qcwf_checkout_general_cart_redirect_url',
				'name'     => esc_html__( 'Redirect add to cart url', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Redirect add to cart url', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'select',
				'class'    => 'chosen_select',
				'options'  => array(
					'no'       => esc_html__( 'No', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'checkout' => esc_html__( 'Checkout', QCFW_CHECKOUT_TEXT_DOMAIN ),
					// 'custom'   => esc_html__( 'Custom URL', QCFW_CHECKOUT_TEXT_DOMAIN ),
				),
				'default'  => 'checkout',
			),
			// array(
			// 	'id'          => 'qcwf_checkout_general_cart_redirect_custom_url',
			// 	'name'        => esc_html__( 'Redirect add to cart custom url', QCFW_CHECKOUT_TEXT_DOMAIN ),
			// 	'desc_tip'    => esc_html__( 'Redirect add to cart custom url', QCFW_CHECKOUT_TEXT_DOMAIN ),
			// 	'type'        => 'text',
			// 	'placeholder' => wc_get_checkout_url(),
			// ),
		);
	}


	public function qcwf_checkout_add_section() {
		global $current_section;
		?>
			<ul class="subsubsub">
				<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-settings&tab=' . QCFW_CHECKOUT_SLUG . '&section' ) ); ?>" class="<?php echo ( '' == $current_section ? 'current' : '' ); ?>"><?php esc_html_e( 'General', QCFW_CHECKOUT_SLUG ); ?></a> | </li>
				<li><a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-settings&tab=' . QCFW_CHECKOUT_SLUG . '&section=archives' ) ); ?>" class="<?php echo ( 'archives' == $current_section ? 'current' : '' ); ?>"><?php esc_html_e( 'Archives', QCFW_CHECKOUT_SLUG ); ?></a> | </li>
			</ul>
			<br class="clear" />
		<?php
		if ( '' == $current_section ) {

			$settings = $this->qcwf_checkout_settings();
			woocommerce_admin_fields( $settings );
		}
	}

	public function qcwf_checkout_save_settings(){
		global $current_section;

		if ( '' == $current_section ) {

			woocommerce_update_options( $this->qcwf_checkout_settings() );
		}
	}
	
}