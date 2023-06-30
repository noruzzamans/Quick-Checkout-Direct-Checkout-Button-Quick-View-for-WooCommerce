<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Add_To_Cart_Setting {

	public static $plugin_name = QCFW_CHECKOUT_TEXT_DOMAIN;

    public function register_qcfw_checkout_add_to_cart_settings(){
		add_action( 'woocommerce_sections_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_add_to_cart_section' ) );
		add_action( 'woocommerce_settings_save_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_save_add_to_cart_settings' ) );
    }

	public function qcwf_checkout_add_to_cart_settings(){
		return array(
			array(
				'id'   => 'qcwf_checkout_add_to_cart_section_title',
				'name' => esc_html__( 'Add to cart button', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type' => 'title',
			),
			array(
				'id'   => 'qcwf_checkout_add_to_cart_btn_update_text_switch',
				'name' => esc_html__( 'Are you want to change add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Are you want to change add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'select',
				'class'    => 'chosen_select',
				'options'  => array(
					'no'       => esc_html__( 'No', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'yes'       => esc_html__( 'Yes', QCFW_CHECKOUT_TEXT_DOMAIN ),
				),
				'default'  => 'no',
			),
			array(
				'id'   => 'qcwf_checkout_add_to_cart_btn_update_text',
				'name' => esc_html__( 'Update add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Add to cart',
			),
			array(
				'type' => 'sectionend',
			),
		);
	}


	public function qcwf_checkout_add_to_cart_section() {
		global $current_section;

		if ( 'add-to-cart' == $current_section ) {

			$settings = $this->qcwf_checkout_add_to_cart_settings();
			woocommerce_admin_fields( $settings );
		}
	}

	public function qcwf_checkout_save_add_to_cart_settings(){
		global $current_section;

		if ( 'add-to-cart' == $current_section ) {

			woocommerce_update_options( $this->qcwf_checkout_add_to_cart_settings() );
		}
	}
	
}