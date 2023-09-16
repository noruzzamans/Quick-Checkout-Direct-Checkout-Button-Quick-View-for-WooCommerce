<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Qcfw_Checkout_Settings {

    /**
     * Plugin settings prefix.
     *
     * @var string
     */
    public static $prefix = QCFW_CHECKOUT_SLUG;

    /**
     * The single instance of the class.
     */
    protected static $instance;

    /**
     * Returns single instance of the class
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function register_qcfw_options_settings(){

        /** Set a unique slug-like ID */
        $prefix = QCFW_CHECKOUT_SLUG;
    
        /** Plugin options */
        CSF::createOptions( $prefix, array(
        'menu_title'        => esc_html__('Quick Checkout', 'qcfw-checkout'),
        'menu_slug'         => 'qcfw-checkout',
        'menu_type'         => 'menu',
        'ajax_save'         => true,
        'show_reset_all'    => false,
        'show_search'       => false,
        'show_footer'       => false,
        'show_all_options'  => false,       
        'show_sub_menu'     => false,
        'show_reset_section'=> false,
        'nav'               => 'inline',
        'theme'             => 'light',
        'class'             => 'qcfw_checkout_framework',
        'menu_position'     => 59,
        'framework_title'   => esc_html__( 'Quick Checkout Settings', 'qcfw-checkout' ),
        /** footer */
        'footer_text'       => '',
        'footer_after'      => '',
        'footer_credit'     => '',
        ) );

        /** General Settings */
        CSF::createSection( $prefix, array(
            'name'   => 'qcfw_general_settings',
            'title'  => esc_html__( 'General', 'qcfw-checkout' ),
            'fields' => array(
                array(
                    'type'      => 'subheading',
                    'content'   => esc_html__( 'General Setting', 'qcfw-checkout' ),
                ),
                array(
                    'id'        => 'qcfw_global_redirect_options',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Globally Redirect add to cart url.', 'qcfw-checkout' ),
                    'options'   => array(
                        'cart'          => esc_html__( 'Cart', 'qcfw-checkout' ),
                        'checkout'      => esc_html__( 'Checkout', 'qcfw-checkout' ),
                        'no'            => esc_html__( 'No', 'qcfw-checkout' ),
                    ),
                    'default'   => 'checkout',
                ),
            )
        ) );

        /** Add To Cart Settings */
        CSF::createSection( $prefix, array(
            'name'   => 'qcfw_add_to_cart_settings',
            'title'  => esc_html__( 'Add To Cart', 'qcfw-checkout' ),
            'fields' => array(
                array(
                    'type'      => 'subheading',
                    'content'   => esc_html__( 'Add To Cart Button Text For Archive/Shop Pages', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_simple_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Simple product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update shop page simple product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Add to cart', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_variable_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Variable product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update shop page variable product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Select options', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_grouped_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Grouped product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update shop page grouped product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'View products', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_external_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'External/Affiliate product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update shop page external/affiliate product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Buy product', 'qcfw-checkout' ),
                ),
                array(
                    'type'          => 'subheading',
                    'content'       => esc_html__( 'Add To Cart Button Text For Single Page', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_simple_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Simple product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update Single page simple product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Add to cart', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_variable_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Variable product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update Single page variable product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Add to cart', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_grouped_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Grouped product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update Single page grouped product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Add to cart', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_external_add_to_cart_btn',
                    'type'          => 'text',
                    'title'         => esc_html__( 'External/Affiliate product', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'Update Single page external/affiliate product add to cart button text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Buy product', 'qcfw-checkout' ),
                ),
            )
        ) );

        /** Buy Now Button In Shop Page Settings */
        CSF::createSection( $prefix, array(
            'name'   => 'qcfw_shop_buy_now_settings',
            'title'  => esc_html__( 'Shop Page', 'qcfw-checkout' ),
            'fields' => array(
                array(
                    'type'      => 'subheading',
                    'content'   => esc_html__( 'Buy Now Button for Products on the Archive/Shop Page', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_switch',
                    'type'          => 'switcher',
                    'title'         => esc_html__( 'Buy now button switch', 'qcfw-checkout' ),
                    'default'       => false,
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_label',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Buy now button label', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Buy Now', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_position',
                    'type'          => 'select',
                    'title'         => esc_html__( 'Position', 'qcfw-checkout' ),
                    'subtitle'      => esc_html__( 'Choose the placement of the buy now button.', 'qcfw-checkout' ),
                    'options'       => array(
                        'over_product_image'        => esc_html__( 'Over product image', 'qcfw-checkout' ),
                        'over_product_image_hover'  => esc_html__( 'Over product image hover', 'qcfw-checkout' ),
                        'after_title'               => esc_html__( 'After title', 'qcfw-checkout' ),
                        'after_rating'              => esc_html__( 'After rating', 'qcfw-checkout' ),
                        'after_price'               => esc_html__( 'After price', 'qcfw-checkout' ),
                        'before_add_to_cart'        => esc_html__( 'Before add to cart button', 'qcfw-checkout' ),
                        'after_add_to_cart'         => esc_html__( 'After add to cart button', 'qcfw-checkout' ),
                    ),
                    'default'   => 'after_add_to_cart',
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_redirect_url',
                    'type'          => 'select',
                    'title'          => esc_html__( 'Redirect to cart or checkout page', 'qcfw-checkout' ),
                    'options'       => array(
                        'cart'          => esc_html__( 'Cart', 'qcfw-checkout' ),
                        'checkout'      => esc_html__( 'Checkout', 'qcfw-checkout' ),
                    ),
                    'default'       => 'checkout',
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_bg_color',
                    'type'          => 'color',
                    'output_mode'   => 'background-color',
                    'output'        => '.qcfw_shop_buy_now_button',
                    'output_important'  => true,
                    'title'         => esc_html__( 'Buy now button backguound color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#1c61e7', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_bg_hover_color',
                    'type'          => 'color',
                    'output_mode'   => 'background-color',
                    'output_important'  => true,
                    'output'        => '.qcfw_shop_buy_now_button:hover',
                    'title'         => esc_html__( 'Buy now button backguound hover color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#eb7a61', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_text_color',
                    'type'          => 'color',
                    'output'        => '.qcfw_shop_buy_now_button',
                    'output_important'  => true,
                    'title'         => esc_html__( 'Buy now button text color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#ffffff', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_shop_buy_now_btn_text_hover_color',
                    'type'          => 'color',
                    'output'        => '.qcfw_shop_buy_now_button:hover',
                    'output_important'  => true,
                    'title'         => esc_html__( 'Buy now button text hover color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#ffffff', 'qcfw-checkout' ),
                ),
            )
        ) );

        /** Buy Now Button In Single Page Settings */
        CSF::createSection( $prefix, array(
            'name'   => 'qcfw_single_buy_now_settings',
            'title'  => esc_html__( 'Single page', 'qcfw-checkout' ),
            'fields' => array(
                array(
                    'type'      => 'subheading',
                    'content'   => esc_html__( 'Product Single page', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_switch',
                    'type'          => 'switcher',
                    'title'         => esc_html__( 'Buy now button switch', 'qcfw-checkout' ),
                    'default'       => false,
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_label',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Buy now button label', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Buy Now', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_position',
                    'type'          => 'select',
                    'title'         => esc_html__( 'Position', 'qcfw-checkout' ),
                    'subtitle'      => esc_html__( 'Choose the placement of the buy now button.', 'qcfw-checkout' ),
                    'options'       => array(
                        'before_add_to_cart'    => esc_html__( 'Before add to cart button', 'qcfw-checkout' ),
                        'after_add_to_cart'     => esc_html__( 'After add to cart button', 'qcfw-checkout' ),
                    ),
                    'default'   => 'after_add_to_cart',
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_redirect_url',
                    'type'          => 'select',
                    'title'          => esc_html__( 'Redirect to cart or checkout page', 'qcfw-checkout' ),
                    'options'       => array(
                        'cart'          => esc_html__( 'Cart', 'qcfw-checkout' ),
                        'checkout'      => esc_html__( 'Checkout', 'qcfw-checkout' ),
                    ),
                    'default'       => 'checkout',
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_bg_color',
                    'type'          => 'color',
                    'output_mode'   => 'background-color',
                    'output'        => '.qcfw_single_buy_now_button',
                    'output_important'  => true,
                    'title'         => esc_html__( 'Buy now button backguound color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#1c61e7', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_bg_hover_color',
                    'type'          => 'color',
                    'output_mode'   => 'background-color',
                    'output_important'  => true,
                    'output'        => '.qcfw_single_buy_now_button:hover',
                    'title'         => esc_html__( 'Buy now button backguound hover color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#eb7a61', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_text_color',
                    'type'          => 'color',
                    'output'        => '.qcfw_single_buy_now_button',
                    'output_important'  => true,
                    'title'         => esc_html__( 'Buy now button text color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#ffffff', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_single_buy_now_btn_text_hover_color',
                    'type'          => 'color',
                    'output'        => '.qcfw_single_buy_now_button:hover',
                    'output_important'  => true,
                    'title'         => esc_html__( 'Buy now button text hover color', 'qcfw-checkout' ),
                    'default'       => esc_html__( '#ffffff', 'qcfw-checkout' ),
                ),
            )
        ) );

        /** Checkout Page Settings */
        CSF::createSection( $prefix, array(
            'name'   => 'qcfw_checkout_settings',
            'title'  => esc_html__( 'Checkout Page', 'qcfw-checkout' ),
            'fields' => array(
                array(
                    'type'      => 'subheading',
                    'content'   => esc_html__( 'Checkout Page', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcwf_checkout_remove_coupon_form',
                    'type'          => 'switcher',
                    'title'         =>  esc_html__( 'Remove checkout coupon form', 'qcfw-checkout' ),
                    'default'       => false,
                ),
                array(
                    'id'          => 'qcwf_checkout_remove_fields',
                    'type'        => 'select',
                    'title'       => esc_html__( 'Remove checkout fields', 'qcfw-checkout' ),
                    'chosen'      => true,
                    'multiple'    => true,
                    'placeholder' => 'Select an option',
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
                    'id'            => 'qcwf_checkout_remove_order_notes',
                    'type'          => 'switcher',
                    'title'         =>  esc_html__( 'Remove checkout order notes', 'qcfw-checkout' ),
                    'default'       => false,
                ),
                array(
                    'id'            => 'qcwf_checkout_remove_policy',
                    'type'          => 'switcher',
                    'title'         =>  esc_html__( 'Remove checkout policy', 'qcfw-checkout' ),
                    'default'       => false,
                ),
                array(
                    'id'            => 'qcwf_checkout_remove_terms',
                    'type'          => 'switcher',
                    'title'         =>  esc_html__( 'Remove checkout terms and conditions', 'qcfw-checkout' ),
                    'default'       => false,
                ),
            )
        ) );
        
    }

    /**
     * Return plugin all settings.
     *
     * @return string|array Settings values.
     */
    public static function get_settings() {
        return get_option( Qcfw_Checkout_Settings::$prefix );
    }

}

/** Initialize the class instance. */
Qcfw_Checkout_Settings::get_instance();