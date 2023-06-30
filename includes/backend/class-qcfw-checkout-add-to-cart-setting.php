<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Add_To_Cart_Setting {

    public function register_qcfw_checkout_add_to_cart_settings(){
		add_action( 'woocommerce_sections_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_add_to_cart_section' ) );
		add_action( 'woocommerce_settings_save_' . QCFW_CHECKOUT_SLUG, array( $this, 'qcwf_checkout_save_add_to_cart_settings' ) );
    }

	public function qcwf_checkout_add_to_cart_settings(){
		return array(
			array(
				'id'   => 'qcwf_checkout_shop_add_to_cart_section_title',
				'name' => esc_html__( 'Add To Cart Button Text For Archive/Shop Pages', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type' => 'title',
			),
			array(
				'id'   => 'qcwf_checkout_shop_simple_add_to_cart_btn',
				'name' => esc_html__( 'Simple product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page simple product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Add to cart',
			),
			array(
				'id'   => 'qcwf_checkout_shop_variable_add_to_cart_btn',
				'name' => esc_html__( 'Variable product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page variable product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Select options',
			),
			array(
				'id'   => 'qcwf_checkout_shop_grouped_add_to_cart_btn',
				'name' => esc_html__( 'Grouped product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page grouped product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'View products',
			),
			array(
				'id'   => 'qcwf_checkout_shop_external_add_to_cart_btn',
				'name' => esc_html__( 'External/Affiliate product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page external/affiliate product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Buy product',
			),
			array(
				'type' => 'sectionend',
			),
			array(
				'id'   => 'qcwf_checkout_single_add_to_cart_section_title',
				'name' => esc_html__( 'Add To Cart Button Text For Single Page', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type' => 'title',
			),
			array(
				'id'   => 'qcwf_checkout_single_simple_add_to_cart_btn',
				'name' => esc_html__( 'Simple product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page simple product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Add to cart',
			),
			array(
				'id'   => 'qcwf_checkout_single_variable_add_to_cart_btn',
				'name' => esc_html__( 'Variable product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page variable product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Add to cart',
			),
			array(
				'id'   => 'qcwf_checkout_single_grouped_add_to_cart_btn',
				'name' => esc_html__( 'Grouped product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page grouped product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Add to cart',
			),
			array(
				'id'   => 'qcwf_checkout_single_external_add_to_cart_btn',
				'name' => esc_html__( 'External/Affiliate product', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'desc_tip' => esc_html__( 'Update shop page external/affiliate product add to cart button text', QCFW_CHECKOUT_TEXT_DOMAIN ),
				'type'     => 'text',
				'default'  => 'Buy product',
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