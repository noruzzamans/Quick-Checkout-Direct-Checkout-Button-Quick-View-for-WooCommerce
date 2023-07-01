<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Single_Buy_Now_Setting {

    public function register_qcfw_checkout_single_buy_now_settings(){
		add_action( 'woocommerce_sections_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_add_single_buy_now_section' ) );
		add_action( 'woocommerce_settings_save_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_save_single_buy_now_settings' ) );
    }

	public function qcwf_checkout_single_buy_now_settings(){
		return array(
			array(
				'id'   => 'qcwf_checkout_single_buy_now_section_title',
				'name' => esc_html__( 'Product Single page', 'qcfw-checkout' ),
				'type' => 'title',
			),
			array(
				'id'   => 'qcwf_checkout_single_buy_now_btn_switch',
				'name' => esc_html__( 'Buy now button switch', 'qcfw-checkout' ),
				'desc_tip' => esc_html__( 'Buy now button switch', 'qcfw-checkout' ),
				'type'     => 'select',
				'class'    => 'chosen_select',
				'options'  => array(
					'no'       => esc_html__( 'No', 'qcfw-checkout' ),
					'yes'       => esc_html__( 'Yes', 'qcfw-checkout' ),
				),
				'default'  => 'no',
			),
			array(
				'id'   => 'qcwf_checkout_single_buy_now_btn_label',
				'name' => esc_html__( 'Buy now button label', 'qcfw-checkout' ),
				'desc_tip' => esc_html__( 'Buy now button label', 'qcfw-checkout' ),
				'type'     => 'text',
				'default'  => 'Buy Now',
			),
			array(
				'id'   => 'qcwf_checkout_single_buy_now_btn_position',
				'name' => esc_html__( 'Buy now button position', 'qcfw-checkout' ),
				'desc_tip' => esc_html__( 'Buy now button position', 'qcfw-checkout' ),
				'type'     => 'select',
				'class'    => 'chosen_select',
				'options'  => array(
					'before_btn'       => esc_html__( 'Before add to cart button', 'qcfw-checkout' ),
					'after_btn'       => esc_html__( 'After add to cart button', 'qcfw-checkout' ),
				),
				'default'  => 'after_btn',
			),
			array(
				'id'       => 'qcwf_checkout_single_buy_now_btn_redirect_url',
				'name'     => esc_html__( 'Redirect to cart or checkout page', 'qcfw-checkout' ),
				'desc_tip' => esc_html__( 'Redirect to cart or checkout page', 'qcfw-checkout' ),
				'type'     => 'select',
				'class'    => 'chosen_select',
				'options'  => array(
					'cart'       => esc_html__( 'Cart', 'qcfw-checkout' ),
					'checkout' => esc_html__( 'Checkout', 'qcfw-checkout' ),
				),
				'default'  => 'checkout',
			),
			array(
				'id'   => 'qcwf_checkout_single_buy_now_btn_bg_color',
				'name' => esc_html__( 'Buy now button backguound color', 'qcfw-checkout' ),
				'desc_tip' => esc_html__( 'Buy now button backguound color', 'qcfw-checkout' ),
				'type'     => 'color',
				'default'  => '#ebe9eb',
			),
			array(
				'id'   => 'qcwf_checkout_single_buy_now_btn_text_color',
				'name' => esc_html__( 'Buy now button text color', 'qcfw-checkout' ),
				'desc_tip' => esc_html__( 'Buy now button text color', 'qcfw-checkout' ),
				'type'     => 'color',
				'default'  => '#515151',
			),
			array(
				'type' => 'sectionend',
			),
		);
	}


	public function qcwf_checkout_add_single_buy_now_section() {
		global $current_section;

		if ( 'single-buy-now' == $current_section ) {

			$settings = $this->qcwf_checkout_single_buy_now_settings();
			woocommerce_admin_fields( $settings );
		}
	}

	public function qcwf_checkout_save_single_buy_now_settings(){
		global $current_section;

		if ( 'single-buy-now' == $current_section ) {

			woocommerce_update_options( $this->qcwf_checkout_single_buy_now_settings() );
		}
	}
	
}