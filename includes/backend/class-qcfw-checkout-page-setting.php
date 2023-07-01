<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Page_Setting {

    public function register_qcfw_checkout_page_settings(){
		add_action( 'woocommerce_sections_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_page_section' ) );
		add_action( 'woocommerce_settings_save_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_page_save_settings' ) );
    }

	public function qcwf_checkout_page_settings(){
		return array(
			array(
				'id'   => 'qcwf_checkout_page_section_title',
				'name' => esc_html__( 'Checkout Page', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type' => 'title',
			),
			array(
				'id'   => 'qcwf_checkout_remove_fields',
				'name' => esc_html__( 'Hide checkout fields', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Hide checkout fields', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'multiselect',
				'class'    => 'chosen_select',
				'options'  => array(
					'first_name' => esc_html__( 'First Name', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'last_name'  => esc_html__( 'Last Name', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'company'    => esc_html__( 'Company', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'address_1'  => esc_html__( 'Address 1', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'address_2'  => esc_html__( 'Address 2', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'phone'      => esc_html__( 'Phone', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'city'       => esc_html__( 'City', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'postcode'   => esc_html__( 'Postcode', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'state'      => esc_html__( 'State', QCFW_CHECKOUT_TEXT_DOMAIN ),
					'country'    => esc_html__( 'Country', QCFW_CHECKOUT_TEXT_DOMAIN ),
				),
			),
			array(
				'type' => 'sectionend',
			),
		);
	}

	public function qcwf_checkout_page_section() {
		global $current_section;

		if ( 'checkout' == $current_section ) {

			$settings = $this->qcwf_checkout_page_settings();
			woocommerce_admin_fields( $settings );
		}
	}

	public function qcwf_checkout_page_save_settings(){
		global $current_section;

		if ( 'checkout' == $current_section ) {

			woocommerce_update_options( $this->qcwf_checkout_page_settings() );
		}
	}
	
}