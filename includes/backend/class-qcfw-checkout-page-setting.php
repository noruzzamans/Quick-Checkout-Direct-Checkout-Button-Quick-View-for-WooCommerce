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
				'name' => esc_html__( 'Checkout Page', 'qcfw-checkout' ),
				'type' => 'title',
			),
			array(
				'id'   => 'qcwf_checkout_remove_fields',
				'name' => esc_html__( 'Hide checkout fields', 'qcfw-checkout' ),
				'desc_tip' => esc_html__( 'Hide checkout fields', 'qcfw-checkout' ),
				'type'     => 'multiselect',
				'class'    => 'chosen_select',
				'options'  => array(
					'first_name' => esc_html__( 'First Name', 'qcfw-checkout' ),
					'last_name'  => esc_html__( 'Last Name', 'qcfw-checkout' ),
					'company'    => esc_html__( 'Company', 'qcfw-checkout' ),
					'address_1'  => esc_html__( 'Address 1', 'qcfw-checkout' ),
					'address_2'  => esc_html__( 'Address 2', 'qcfw-checkout' ),
					'phone'      => esc_html__( 'Phone', 'qcfw-checkout' ),
					'city'       => esc_html__( 'City', 'qcfw-checkout' ),
					'postcode'   => esc_html__( 'Postcode', 'qcfw-checkout' ),
					'state'      => esc_html__( 'State', 'qcfw-checkout' ),
					'country'    => esc_html__( 'Country', 'qcfw-checkout' ),
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