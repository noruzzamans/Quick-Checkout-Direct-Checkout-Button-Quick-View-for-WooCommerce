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

    public function __construct() {

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
        
            /** Button Settings */
            CSF::createSection( $prefix, array(
            'name'   => 'qcfw_button_settings',
            'title'  => esc_html__( 'Button', 'qcfw-checkout' ),
            'fields' => array(
                array(
                    'id'        => 'qcfw_switch',
                    'type'      => 'switcher',
                    'default'   => true,
                    'output'    => '.easy_woo_quick_view_btn',
                    'title'     => esc_html__( 'Enable quick view', 'qcfw-checkout' ),
                ), 
                array(
                    'id'        => 'qcfw_btn_position',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Position', 'qcfw-checkout' ),
                    'subtitle'  => esc_html__( 'Choose the placement of the quick view button.', 'qcfw-checkout' ),
                    'options'   => array(
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
                    'id'            => 'qcfw_btn_label',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Text', 'qcfw-checkout' ),
                    'default'       => esc_html__( 'Quick View', 'qcfw-checkout' ),
                ),
                array(
                    'id'            => 'qcfw_icon_switch',
                    'type'          => 'switcher',
                    'default'       => false,
                    'title'         => esc_html__( 'Enable icon', 'qcfw-checkout' ),
                    'desc'          => esc_html__( 'To display only the icon, remove the button text.', 'qcfw-checkout' ),
                ), 
                array(
                    'id'            => 'qcfw_btn_icon',
                    'type'          => 'icon',
                    'title'         => esc_html__( 'Icon', 'qcfw-checkout' ),
                    'default'       => 'far fa-eye',
                    'dependency'    => array( 'qcfw_icon_switch', '==', 'true' )
                ),
                array(
                    'id'            => 'qcfw_btn_icon_font_size',
                    'type'          => 'number',
                    'unit'          => 'px',
                    'title'         => esc_html__( 'Icon font size', 'boomdevs-toc' ),
                    'default'       => 16,
                    'dependency'    => array( 'qcfw_icon_switch', '==', 'true' )
                ),
                array(
                    'id'                => 'qcfw_btn_icon_font_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Icon color', 'qcfw-checkout' ),
                    'output_important'  => true,
                    'output'            => '.easy_woo_quick_view_btn i',
                    'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                    'dependency'        => array( 'qcfw_icon_switch', '==', 'true' )
                ),
                array(
                    'id'                => 'qcfw_btn_icon_select',
                    'type'              => 'select',
                    'title'             => esc_html__( 'Icon position', 'qcfw-checkout' ),
                    'options' => array(
                      'before'  => 'Before',
                      'after'   => 'After',
                    ),
                    'default'          => 'before',
                    'dependency'       => array( 'qcfw_icon_switch', '==', 'true' )
                ),
                array(
                    'id'            => 'qcfw_btn_icon_margin_right',
                    'type'          => 'spacing',
                    'title'         => esc_html__( 'Icon margin right', 'qcfw-checkout' ),
                    'output_mode'   => 'margin',
                    'top'           => false,
                    'bottom'        => false,
                    'right'         => true,
                    'left'          => false,
                    'default'=> array(
                        'right'  => '0',
                        'unit'   => 'px',
                    ),
                    'dependency'    => array( 'qcfw_icon_switch', '==', 'true' )
                ),
                array(
                    'id'            => 'qcfw_btn_icon_margin_left',
                    'type'          => 'spacing',
                    'title'         => esc_html__( 'Icon margin left', 'qcfw-checkout' ),
                    'output_mode'   => 'margin',
                    'top'           => false,
                    'bottom'        => false,
                    'right'         => false,
                    'left'          => true,
                    'default'=> array(
                        'left'   => '0',
                        'unit'   => 'px',
                    ),
                    'dependency'    => array( 'qcfw_icon_switch', '==', 'true')
                ),
                array(
                    'id'            => 'qcfw_icon_only_switch',
                    'type'          => 'switcher',
                    'default'       => false,
                    'title'         => esc_html__( 'Enable icon only', 'qcfw-checkout' ),
                    'dependency'    => array( 'qcfw_icon_switch', '==', 'true' )
                ),
                array(
                    'id'            => 'qcfw_icon_btn_style',
                    'type'          => 'select',
                    'title'         => esc_html__( 'Icon button style', 'qcfw-checkout' ),
                    'options'=> array(
                        'square'        => esc_html__( 'Square', 'qcfw-checkout' ),
                        'round'         => esc_html__( 'Round', 'qcfw-checkout' ),
                        'rounded_square'=> esc_html__( 'Rounded square', 'qcfw-checkout' ),
                    ),
                    'default'       => 'square',
                    'dependency'    => array( 'qcfw_icon_only_switch', '==', 'true' )
                ),
                array(
                    'id'         => 'qcfw_btn_align_position_top',
                    'type'       => 'number',
                    'unit'       => 'px',
                    'title'      => esc_html__( 'Top', 'boomdevs-toc' ),
                    'desc'       => esc_html__( 'Position top works when you select Over Product Image or Over Product Image options', 'qcfw-checkout' ),
                    'default'    => 0,
                ),
                array(
                    'id'         => 'qcfw_btn_align_position_top_left',
                    'type'       => 'number',
                    'unit'       => 'px',
                    'title'      => esc_html__( 'Top left', 'boomdevs-toc' ),
                    'desc'       => esc_html__( 'Position top left works when you select Over Product Image or Over Product Image options', 'qcfw-checkout' ),
                    'default'    => '',
                ),
                array(
                    'id'         => 'qcfw_btn_align_position_top_right',
                    'type'       => 'number',
                    'unit'       => 'px',
                    'title'      => esc_html__( 'Top right', 'boomdevs-toc' ),
                    'default'    => '',
                    'desc'       => esc_html__( 'Position top right works when you select Over Product Image or Over Product Image options', 'qcfw-checkout' ),
                ),           
                array(
                    'id'               => 'qcfw_btn_font_family',
                    'title'            => esc_html__( 'Typography', 'qcfw-checkout' ),
                    'type'             => 'typography',
                    'output'           => 'a.easy_woo_quick_view_btn',
                    'output_important' => true,
                    'font_family'      => true,
                    'font_weight'      => true,
                    'subset'           => true,
                    'font_style'       => true,
                    'font_size'        => true,
                    'line_height'      => true,
                    'letter_spacing'   => true,
                    'text_align'       => true,
                    'text_transform'   => true,
                    'color'            => false,
                    'default'          => array(
                        'font-family'  => '',
                        'font-size'    => '16',
                        'font-weight'  => '500',
                        'unit'         => 'px',
                        'type'         => 'google',
                    ),
                ),
                array(
                    'id'                => 'qcfw_btn_bg_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Background color', 'qcfw-checkout' ),
                    'output_mode'       => 'background-color',
                    'output_important'  => true,
                    'output'            => '.easy_woo_quick_view_btn',
                    'default'           => esc_html__( '#eb7a61', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_btn_bg_hover_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Background hover color', 'qcfw-checkout' ),
                    'output_mode'       => 'background-color',
                    'output_important'  => true,
                    'output'            => '.easy_woo_quick_view_btn:hover',
                    'default'           => esc_html__( '#15c7a4', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_btn_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Text color', 'qcfw-checkout' ),
                    'output_important'  => true,
                    'output'            => '.easy_woo_quick_view_btn',
                    'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_btn_hover_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Text hover color', 'qcfw-checkout' ),
                    'output_important'  => true,
                    'output'            => '.easy_woo_quick_view_btn:hover',
                    'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_btn_padding',
                    'type'              => 'spacing',
                    'title'             => esc_html__( 'Padding', 'qcfw-checkout' ),
                    'output'            => '.easy_woo_quick_view_btn',
                    'output_mode'       => 'padding',
                    'output_important'  => true,
                    'default'           => array(
                        'top'    => '10',
                        'right'  => '16',
                        'bottom' => '10',
                        'left'   => '16',
                        'unit'   => 'px',
                    ),
                ),
                array(
                    'id'                => 'qcfw_btn_margin',
                    'type'              => 'spacing',
                    'title'             => esc_html__( 'Margin', 'qcfw-checkout' ),
                    'output'            => '.easy_woo_quick_view_btn',
                    'output_mode'       => 'margin',
                    'output_important'  => true,
                    'default'           => array(
                        'top'    => '16',
                        'right'  => '0',
                        'bottom' => '0',
                        'left'   => '0',
                        'unit'   => 'px',
                    ),
                ),
                array(
                    'id'                => 'qcfw_btn_border',
                    'type'              => 'border',
                    'title'             => esc_html__( 'Border', 'qcfw-checkout' ),
                    'output'            => '.easy_woo_quick_view_btn',
                    'output_important'  => true,
                    'default'           => array(
                        'style'  => 'solid',
                        'color'  => '#ffffff',
                        'top'    => '0',
                        'right'  => '0',
                        'bottom' => '0',
                        'left'   => '0',
                        'unit'   => 'px',
                    ),
                ),
                array(
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Border Radius', 'qcfw-checkout' ),
                ),
                array(
                    'id'      => 'qcfw_btn_border_radius_top',
                    'type'    => 'number',
                    'unit'    => 'px',
                    'default' => '0',
                    'title'   => esc_html__( 'Top', 'qcfw-checkout' ),
                ),
                array(
                    'id'      => 'qcfw_btn_border_radius_right',
                    'type'    => 'number',
                    'unit'    => 'px',
                    'default' => '0',
                    'title'   => esc_html__( 'Right', 'qcfw-checkout' ),
                ),
                array(
                    'id'      => 'qcfw_btn_border_radius_bottom',
                    'type'    => 'number',
                    'unit'    => 'px',
                    'default' => '0',
                    'title'   => esc_html__( 'Bottom', 'qcfw-checkout' ),
                ),
                array(
                    'id'      => 'qcfw_btn_border_radius_left',
                    'type'    => 'number',
                    'unit'    => 'px',
                    'default' => '0',
                    'title'   => esc_html__( 'Left', 'qcfw-checkout' ),
                ),                            
            )
            ) );
        
            /** Modal Settings */
            CSF::createSection( $prefix, array(
            'name'   => 'qcfw_modal_settings',
            'title'  => esc_html__( 'Modal', 'qcfw-checkout' ),
            'fields' => array(
                array(
                    'type'              => 'subheading',
                    'content'           => esc_html__( 'Global Setting', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_modal_width_height',
                    'type'              => 'dimensions',
                    'title'             => esc_html__( 'Modal size', 'qcfw-checkout' ),
                    'subtitle'          => esc_html__( 'For best results, use 2:1 width-to-height ratio.', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_modal_z_index',
                    'type'              => 'number',
                    'title'             => esc_html__( 'Modal Z-Index', 'qcfw-checkout' ),
                    'default'           => 999999
                ),
                array(
                    'id'                => 'qcfw_modal_bg_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Background color', 'qcfw-checkout' ),
                    'output_mode'       => 'background',
                    'output_important'  => true,
                    'output'            => '.easy-wqv-product-modal',
                    'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_modal_bg_overlay',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Background overlay color', 'qcfw-checkout' ),
                    'output_mode'       => 'background',
                    'output_important'  => true,
                    'output'            => '.mfp-bg.mfp-qcfw',
                    'default'           => esc_html__( '#0b0b0b', 'qcfw-checkout' ),
                ),
                array(
                    'type'              => 'subheading',
                    'content'           => esc_html__( 'Close Button', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_close_btn_switch',
                    'type'              => 'switcher',
                    'default'           => true,
                    'title'             => esc_html__( 'Button show/hide', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_close_btn_switch_bg',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Button background color', 'qcfw-checkout' ),
                    'output_mode'       => 'background',
                    'output_important'  => true,
                    'output'            => '.easy-wqv-product-modal .mfp-close',
                    'default'           => esc_html__( 'transparent', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_close_btn_switch_bg_hover',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Button background hover color', 'qcfw-checkout' ),
                    'output_mode'       => 'background',
                    'output_important'  => true,
                    'output'            => '.easy-wqv-product-modal .mfp-close:hover',
                    'default'           => esc_html__( '#eb7a61', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_close_btn_switch_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Button icon color', 'qcfw-checkout' ),
                    'output_important'  => true,
                    'output'            => '.easy-wqv-product-modal .mfp-close',
                    'default'           => esc_html__( '#333', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_close_btn_switch_hover_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Button icon hover color', 'qcfw-checkout' ),
                    'output_important'  => true,
                    'output'            => '.easy-wqv-product-modal .mfp-close:hover',
                    'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                ),
                array(
                    'type'              => 'subheading',
                    'content'           => esc_html__( 'Scrollbar', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_scrollbar_bg',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Scrollbar background color', 'qcfw-checkout' ),
                    'output_mode'       => 'background',
                    'default'           => esc_html__( '#333', 'qcfw-checkout' ),
                ),
                array(
                    'type'              => 'subheading',
                    'content'           => esc_html__( 'Loading Animation', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_loading_switch',
                    'type'              => 'switcher',
                    'default'           => true,
                    'title'             => esc_html__( 'Preloader', 'qcfw-checkout' ),
                ),
                array(
                    'id'                => 'qcfw_loading_text',
                    'type'              => 'text',
                    'title'             => esc_html__( 'Loading text', 'qcfw-checkout' ),
                    'default'           => esc_html__( 'Loading...', 'qcfw-checkout' ),
                    'dependency'        => array( 'qcfw_loading_switch', '==', 'true' )
                ),
                array(
                    'id'                => 'qcfw_loading_text_color',
                    'type'              => 'color',
                    'title'             => esc_html__( 'Loading text color', 'qcfw-checkout' ),
                    'output_important'  => true,
                    'output'            => '.loading-overlay .loading-text',
                    'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                    'dependency'        => array( 'qcfw_loading_switch', '==', 'true' ),
                ),
            )
            ) );

            /** Thumbnails Settings */
            CSF::createSection( $prefix, array(
                'name'   => 'qcfw_thumbnails_settings',
                'title'  => esc_html__( 'Thumbnails', 'qcfw-checkout' ),
                'fields' => array(
                    array(
                        'type'      => 'subheading',
                        'content'   => esc_html__( 'Slider', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'        => 'qcfw_slider_dot_switch',
                        'type'      => 'switcher',
                        'default'   => true,
                        'title'     => esc_html__( 'Slider dot show/hide', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'        => 'qcfw_slider_btn_icon_size',
                        'type'      => 'number',
                        'title'     => esc_html__( 'Slider icon size', 'qcfw-checkout' ),
                        'default'   => 24,
                        'unit'      => 'px',
                    ),
                    array(
                        'id'        => 'qcfw_slider_btn_icon_color',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Slider icon color', 'qcfw-checkout' ),
                        'default'   => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'        => 'qcfw_slider_btn_icon_hover_color',
                        'type'      => 'color',
                        'title'     => esc_html__( 'Slider icon hover color', 'qcfw-checkout' ),
                        'default'   => esc_html__( '#fff', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'            => 'qcfw_slider_btn_icon_bg_color',
                        'type'          => 'color',
                        'title'         => esc_html__( 'Slider icon background color', 'qcfw-checkout' ),
                        'output_mode'   => 'background-color',
                        'default'       => esc_html__( 'transparent', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'            => 'qcfw_slider_btn_icon_bg_hover_color',
                        'type'          => 'color',
                        'title'         => esc_html__( 'Slider icon background hover color', 'qcfw-checkout' ),
                        'output_mode'   => 'background-color',
                        'default'       => esc_html__( '#000', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'            => 'qcfw_slider_btn_left_icon',
                        'type'          => 'icon',
                        'title'         => esc_html__( 'Slider left icon', 'qcfw-checkout' ),
                        'default'       => 'fas fa-chevron-left',
                    ),
                    array(
                        'id'            => 'qcfw_slider_btn_right_icon',
                        'type'          => 'icon',
                        'title'         => esc_html__( 'Slider right icon', 'qcfw-checkout' ),
                        'default'       => 'fas fa-chevron-right',
                    ),
                )
            ) );
            /** Content Settings */
            CSF::createSection( $prefix, array(
                'name'   => 'qcfw_content_settings',
                'title'  => esc_html__( 'Content', 'qcfw-checkout' ),
                'fields' => array(
                    array(
                        'id'                => 'qcfw_modal_content_padding',
                        'type'              => 'spacing',
                        'title'             => esc_html__( 'Content wrapper padding', 'qcfw-checkout' ),
                        'output'            => '.easy-wqv-summary-wrapper',
                        'output_mode'       => 'padding',
                        'output_important'  => true,
                        'default'           => array(
                            'top'    => '20',
                            'right'  => '20',
                            'bottom' => '20',
                            'left'   => '20',
                            'unit'   => 'px',
                        ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Product info show/hide options', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_title_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Title', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_rating_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Rating', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_Price_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Price', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_excerpt_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Excerpt', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_add_to_cart_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Add To Cart', 'qcfw-checkout' ),
                    ), 
                    array(
                        'id'                => 'qcfw_meta_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Meta', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_social_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Social Share', 'qcfw-checkout' ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Title', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_title_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .product_title',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Review and Rating', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_review_link_switch',
                        'type'              => 'switcher',
                        'default'           => true,
                        'title'             => esc_html__( 'Review link', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_review_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Review color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .woocommerce-product-rating .woocommerce-review-link',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_rating_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Rating color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .woocommerce-product-rating .star-rating',
                        'default'           => esc_html__( '#dd9933', 'qcfw-checkout' ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Price', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_price_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .price',
                        'default'           => esc_html__( '#77a464', 'qcfw-checkout' ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Excerpt', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_excerpt_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .woocommerce-product-details__short-description p',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Variations Form ', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_variation_description',
                        'type'              => 'switcher',
                        'default'           => false,
                        'title'             => esc_html__( 'Variation description', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_variation_label_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Label color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .variations_form .variations th',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_variation_value_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Value color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .variations_form .variations td select',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Add To Cart', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_add_to_cart_bg',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Button background color', 'qcfw-checkout' ),
                        'output_mode'       => 'background',
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .cart .single_add_to_cart_button',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_add_to_cart_bg_hover',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Button background hover color', 'qcfw-checkout' ),
                        'output_mode'       => 'background',
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .cart .single_add_to_cart_button:hover',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_add_to_cart_text_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Button text color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .cart .single_add_to_cart_button',
                        'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_add_to_cart_text_hover_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Button text hover color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .cart .single_add_to_cart_button:hover',
                        'default'           => esc_html__( '#fff', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_add_to_cart_btn_padding',
                        'type'              => 'spacing',
                        'title'             => esc_html__( 'Button padding', 'qcfw-checkout' ),
                        'output'            => '.easy-wqv-summary-content .cart .single_add_to_cart_button',
                        'output_mode'       => 'padding',
                        'output_important'  => true,
                        'default'           => array(
                            'top'    => '10',
                            'right'  => '16',
                            'bottom' => '10',
                            'left'   => '16',
                            'unit'   => 'px',
                        ),
                    ),
                    array(
                        'id'                => 'qcfw_content_add_to_cart_btn_margin',
                        'type'              => 'spacing',
                        'title'             => esc_html__( 'Button margin', 'qcfw-checkout' ),
                        'output'            => '.easy-wqv-summary-content .cart .single_add_to_cart_button',
                        'output_mode'       => 'margin',
                        'output_important'  => true,
                        'default'           => array(
                            'top'    => '0',
                            'right'  => '0',
                            'bottom' => '0',
                            'left'   => '0',
                            'unit'   => 'px',
                        ),
                    ),
                    array(
                        'id'                => 'qcfw_content_add_to_cart_btn_border',
                        'type'              => 'border',
                        'title'             => esc_html__( 'Button border', 'qcfw-checkout' ),
                        'output'            => '.easy-wqv-summary-content .cart .single_add_to_cart_button',
                        'output_important'  => true,
                        'default'           => array(
                            'style'  => 'solid',
                            'color'  => '#ffffff',
                            'top'    => '0',
                            'right'  => '0',
                            'bottom' => '0',
                            'left'   => '0',
                            'unit'   => 'px',
                        ),
                    ),
                    array(
                        'type'    => 'subheading',
                        'content' => esc_html__( 'Button Border Radius', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'      => 'qcfw_content_add_to_cart_btn_border_radius_top',
                        'type'    => 'number',
                        'unit'    => 'px',
                        'default' => '3',
                        'title'   => esc_html__( 'Top', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'      => 'qcfw_content_add_to_cart_btn_border_radius_right',
                        'type'    => 'number',
                        'unit'    => 'px',
                        'default' => '3',
                        'title'   => esc_html__( 'Right', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'      => 'qcfw_content_add_to_cart_btn_border_radius_bottom',
                        'type'    => 'number',
                        'unit'    => 'px',
                        'default' => '3',
                        'title'   => esc_html__( 'Bottom', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'      => 'qcfw_content_add_to_cart_btn_border_radius_left',
                        'type'    => 'number',
                        'unit'    => 'px',
                        'default' => '3',
                        'title'   => esc_html__( 'Left', 'qcfw-checkout' ),
                    ),
                    array(
                        'type'              => 'subheading',
                        'content'           => esc_html__( 'Meta', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_meta_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Text color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .product_meta, .easy-wqv-summary-content .product_meta .sku_wrapper, .easy-wqv-summary-content .product_meta .posted_in',
                        'default'           => esc_html__( '#222', 'qcfw-checkout' ),
                    ),
                    array(
                        'id'                => 'qcfw_content_meta_link_color',
                        'type'              => 'color',
                        'title'             => esc_html__( 'Link color', 'qcfw-checkout' ),
                        'output_important'  => true,
                        'output'            => '.easy-wqv-summary-content .product_meta a',
                        'default'           => esc_html__( '#1e73be', 'qcfw-checkout' ),
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