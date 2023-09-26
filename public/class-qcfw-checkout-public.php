<?php

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-settings.php';

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/public
 */
class Qcfw_Checkout_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/** Get the user settings for Quick Checkout for WooCommerce. */
		$settings       = Qcfw_Checkout_Settings::get_settings();

		/** Retrieve shop buy now button settings for border radious. */
		$qcfw_btn_border_radius_top        	= isset($settings['qcfw_btn_border_radius_top']) ? $settings['qcfw_btn_border_radius_top'] : '';
		$qcfw_btn_border_radius_right      	= isset($settings['qcfw_btn_border_radius_right']) ? $settings['qcfw_btn_border_radius_right'] : '';
		$qcfw_btn_border_radius_bottom     	= isset($settings['qcfw_btn_border_radius_bottom']) ? $settings['qcfw_btn_border_radius_bottom'] : '';
		$qcfw_btn_border_radius_left       	= isset($settings['qcfw_btn_border_radius_left']) ? $settings['qcfw_btn_border_radius_left'] : '';

		/** Retrieve single page buy now button settings for border radious. */
		$qcfw_single_btn_border_radius_top    = isset($settings['qcfw_single_btn_border_radius_top']) ? $settings['qcfw_single_btn_border_radius_top'] : '';
		$qcfw_single_btn_border_radius_right  = isset($settings['qcfw_single_btn_border_radius_right']) ? $settings['qcfw_single_btn_border_radius_right'] : '';
		$qcfw_single_btn_border_radius_bottom = isset($settings['qcfw_single_btn_border_radius_bottom']) ? $settings['qcfw_single_btn_border_radius_bottom'] : '';
		$qcfw_single_btn_border_radius_left   = isset($settings['qcfw_single_btn_border_radius_left']) ? $settings['qcfw_single_btn_border_radius_left'] : '';

		/** Retrieve shop buy now button icon settings */
		$qcfw_icon_switch 					= isset( $settings['qcfw_icon_switch'] ) ? $settings['qcfw_icon_switch'] : '';
		$qcfw_btn_icon_font_size       		= isset($settings['qcfw_btn_icon_font_size']) ? $settings['qcfw_btn_icon_font_size'] : '';
		$qcfw_icon_only_switch       		= isset($settings['qcfw_icon_only_switch']) ? $settings['qcfw_icon_only_switch'] : '';
		$qcfw_icon_btn_style       			= isset($settings['qcfw_icon_btn_style']) ? $settings['qcfw_icon_btn_style'] : '';

		/** Retrieve shop buy now button alignment settings. */
		$qcfw_btn_align_position_top       	= isset($settings['qcfw_btn_align_position_top']) ? $settings['qcfw_btn_align_position_top'] : '';
		$qcfw_btn_align_position_top_left   = isset($settings['qcfw_btn_align_position_top_left']) ? $settings['qcfw_btn_align_position_top_left'] : '';
		$qcfw_btn_align_position_top_right  = isset($settings['qcfw_btn_align_position_top_right']) ? $settings['qcfw_btn_align_position_top_right'] : '';

		/** Retrieve modal window settings. */
		$qcfw_modal_width					= isset($settings['qcfw_modal_width_height']['width']) ? $settings['qcfw_modal_width_height']['width'] : '';
		$qcfw_modal_height					= isset($settings['qcfw_modal_width_height']['height']) ? $settings['qcfw_modal_width_height']['height'] : '';
		$qcfw_modal_z_index					= isset($settings['qcfw_modal_z_index']) ? $settings['qcfw_modal_z_index'] : '';
		$qcfw_close_btn_switch				= isset($settings['qcfw_close_btn_switch']) ? $settings['qcfw_close_btn_switch'] : '';
		$qcfw_review_link_switch			= isset($settings['qcfw_review_link_switch']) ? $settings['qcfw_review_link_switch'] : '';

		/** Retrieve modal slider settings */
		$qcfw_slider_dot_switch				= isset($settings['qcfw_slider_dot_switch']) ? $settings['qcfw_slider_dot_switch'] : '';
		$qcfw_slider_btn_icon_size			= isset($settings['qcfw_slider_btn_icon_size']) ? $settings['qcfw_slider_btn_icon_size'] : '';
		$qcfw_slider_btn_icon_color			= isset($settings['qcfw_slider_btn_icon_color']) ? $settings['qcfw_slider_btn_icon_color'] : '';
		$qcfw_slider_btn_icon_hover_color	= isset($settings['qcfw_slider_btn_icon_hover_color']) ? $settings['qcfw_slider_btn_icon_hover_color'] : '';
		$qcfw_slider_btn_icon_bg_color		= isset($settings['qcfw_slider_btn_icon_bg_color']) ? $settings['qcfw_slider_btn_icon_bg_color'] : '';
		$qcfw_slider_btn_icon_bg_hover_color= isset($settings['qcfw_slider_btn_icon_bg_hover_color']) ? $settings['qcfw_slider_btn_icon_bg_hover_color'] : '';

		/** Retrieve modal cart button settings */
		$qcfw_cart_btn_border_radius_top    = isset($settings['qcfw_content_add_to_cart_btn_border_radius_top']) ? $settings['qcfw_content_add_to_cart_btn_border_radius_top'] : '';
		$qcfw_cart_btn_border_radius_right  = isset($settings['qcfw_content_add_to_cart_btn_border_radius_right']) ? $settings['qcfw_content_add_to_cart_btn_border_radius_right'] : '';
		$qcfw__cart_btn_border_radius_bottom= isset($settings['qcfw_content_add_to_cart_btn_border_radius_bottom']) ? $settings['qcfw_content_add_to_cart_btn_border_radius_bottom'] : '';
		$qcfw_cart_btn_border_radius_left   = isset($settings['qcfw_content_add_to_cart_btn_border_radius_left']) ? $settings['qcfw_content_add_to_cart_btn_border_radius_left'] : '';

		/** Retrieve scrollbar background color. */
		$qcfw_scrollbar_bg   			    = isset($settings['qcfw_scrollbar_bg']) ? $settings['qcfw_scrollbar_bg'] : '';
		
		/** Retrieve content variation description setting. */
		$qcfw_content_variation_description = isset($settings['qcfw_content_variation_description']) ? $settings['qcfw_content_variation_description'] : '';

		/** Retrieve button position and icon margin settings. */
		$qcfw_btn_position 					= isset($settings['qcfw_checkout_shop_buy_now_btn_position']) ? $settings['qcfw_checkout_shop_buy_now_btn_position'] : '';
		$qcfw_btn_icon_select 				= isset($settings['qcfw_btn_icon_select']) ? $settings['qcfw_btn_icon_select'] : '';
		$qcfw_btn_icon_margin_right 		= isset($settings['qcfw_btn_icon_margin_right']['right']) ? $settings['qcfw_btn_icon_margin_right']['right'] : '';
		$qcfw_btn_icon_margin_left 			= isset($settings['qcfw_btn_icon_margin_left']['left']) ? $settings['qcfw_btn_icon_margin_left']['left'] : '';

		/** Retrieve loading animation settings. */
		$qcfw_loading_switch 				= isset($settings['qcfw_loading_switch']) ? $settings['qcfw_loading_switch'] : '';

		?>

		<style>

			.qcfw_shop_buy_now_button i {
				font-size: <?php echo $qcfw_btn_icon_font_size; ?>px !important;
			}
			.qcfw-checkout-summary-content::-webkit-scrollbar-thumb {
				background: <?php echo $qcfw_scrollbar_bg; ?>!important;
			}
			.qcfw_shop_buy_now_button {
				transition: ease-in-out .5s !important;
				border-top-left-radius:     <?php echo $qcfw_btn_border_radius_top; ?>px!important;
				border-top-right-radius:    <?php echo $qcfw_btn_border_radius_right; ?>px!important;
				border-bottom-right-radius: <?php echo $qcfw_btn_border_radius_bottom; ?>px!important;
				border-bottom-left-radius:  <?php echo $qcfw_btn_border_radius_left; ?>px!important;
			}
			.qcfw-checkout-summary-content .cart .qcfw_single_buy_now_button {
				transition: ease-in-out .5s !important;
				border-top-left-radius:     <?php echo $qcfw_cart_btn_border_radius_top; ?>px!important;
				border-top-right-radius:    <?php echo $qcfw_cart_btn_border_radius_right; ?>px!important;
				border-bottom-right-radius: <?php echo $qcfw__cart_btn_border_radius_bottom; ?>px!important;
				border-bottom-left-radius:  <?php echo $qcfw_cart_btn_border_radius_left; ?>px!important;
			}
			.qcfw_single_buy_now_button {
				transition: ease-in-out .5s !important;
				border-top-left-radius:     <?php echo $qcfw_single_btn_border_radius_top; ?>px!important;
				border-top-right-radius:    <?php echo $qcfw_single_btn_border_radius_right; ?>px!important;
				border-bottom-right-radius: <?php echo $qcfw_single_btn_border_radius_bottom; ?>px!important;
				border-bottom-left-radius:  <?php echo $qcfw_single_btn_border_radius_left; ?>px!important;
			}

			.qcfw-checkout-product-modal {
				max-width: <?php echo $qcfw_modal_width ; ?>px !important;
			}
			.qcfw-checkout-product-modal {
				max-height: <?php echo $qcfw_modal_height ; ?>px !important;
			}
			.qcfw-checkout-product-modal .slick-arrow i {
				font-size: <?php echo $qcfw_slider_btn_icon_size ; ?>px !important;
			}
			.qcfw-checkout-product-modal .slick-arrow {
				color: <?php echo $qcfw_slider_btn_icon_color ; ?> !important;
				background-color: <?php echo $qcfw_slider_btn_icon_bg_color ; ?> !important;
				transition: ease-in-out .5s !important;
			}
			.qcfw-checkout-product-modal .slick-arrow:hover {
				color: <?php echo $qcfw_slider_btn_icon_hover_color ; ?> !important;
				background-color: <?php echo $qcfw_slider_btn_icon_bg_hover_color ; ?> !important;
			}
			<?php if($qcfw_icon_switch && $qcfw_icon_only_switch == '1' && $qcfw_icon_btn_style == 'square'): ?>
				button.qcfw_shop_buy_now_button {
					font-size: 0px !important;
					width: 38px !important;
					height: 38px !important;
					margin: 0 !important;
					padding: 0 !important;
				}
			<?php endif; ?>
			<?php if($qcfw_icon_switch && $qcfw_icon_only_switch == '1' && $qcfw_icon_btn_style == 'round'): ?>
				button.qcfw_shop_buy_now_button {
					font-size: 0px !important;
					width: 38px !important;
					height: 38px !important;
					margin: 0 !important;
					padding: 0 !important;
					border-radius: 50% !important;
				}
			<?php endif; ?>
			<?php if($qcfw_icon_switch && $qcfw_icon_only_switch == '1' && $qcfw_icon_btn_style == 'rounded_square'): ?>
				button.qcfw_shop_buy_now_button {
					font-size: 0px !important;
					width: 38px !important;
					height: 38px !important;
					margin: 0 !important;
					padding: 0 !important;
					border-radius: 20% !important;
				}
			<?php endif; ?>
			<?php if($qcfw_btn_position == 'over_product_image'): ?>
				button.qcfw_shop_buy_now_button {
					position: absolute !important;
					top: 	<?php echo $qcfw_btn_align_position_top; ?>px !important;
					left: 	<?php echo $qcfw_btn_align_position_top_left; ?>px !important;
					right: 	<?php echo $qcfw_btn_align_position_top_right; ?>px !important;
				}
			<?php endif; ?>
			<?php if($qcfw_btn_position == 'over_product_image_hover'): ?>
				button.qcfw_shop_buy_now_button {
					position: absolute !important;
					opacity: 0;
					top: 	<?php echo $qcfw_btn_align_position_top; ?>px !important;
					left: 	<?php echo $qcfw_btn_align_position_top_left; ?>px !important;
					right: 	<?php echo $qcfw_btn_align_position_top_right; ?>px !important;
				}
				.woocommerce-LoopProduct-link:hover .qcfw_shop_buy_now_button, .product a:hover .qcfw_shop_buy_now_button {
					opacity: 1;
				}
			<?php endif; ?>
			<?php if($qcfw_btn_icon_select == 'before'): ?>
				.qcfw_shop_buy_now_button i {
					margin-right: <?php echo $qcfw_btn_icon_margin_right ; ?>px;
				}
			<?php endif; ?>
			<?php if($qcfw_btn_icon_select == 'after'): ?>
				.qcfw_shop_buy_now_button i {
					margin-left: <?php echo $qcfw_btn_icon_margin_left ; ?>px;
				}
			<?php endif; ?>
			<?php if(array_key_exists('qcfw_modal_z_index', $settings)): ?>
				.mfp-bg.mfp-qcfw {
					z-index: <?php echo esc_html($settings['qcfw_modal_z_index']);?>!important;
				}
			<?php endif; ?>
			<?php if($qcfw_close_btn_switch == '0') : ?>
				.qcfw-checkout-product-modal .mfp-close {
					display: none;
				}
			<?php endif; ?>	
			<?php if($qcfw_review_link_switch == '0') : ?>
				.qcfw-checkout-summary-content .woocommerce-product-rating .woocommerce-review-link {
					display: none;
				}
			<?php endif; ?>	
			<?php if($qcfw_content_variation_description == '0') : ?>
				.qcfw-checkout-summary-content .woocommerce-variation-description {
					display: none;
				}
			<?php endif; ?>	
			<?php if($qcfw_slider_dot_switch == '0') : ?>
				.qcfw-checkout-product-modal .qcfw-checkout-product-images-slider .slick-dots {
					display: none !important;
				}
			<?php endif; ?>
			<?php if($qcfw_loading_switch == '0') : ?>
				.loading-overlay .loading-text {
					display: none !important;
				}
			<?php endif; ?>
        </style>
        <?php

		/** Enqueue the Font Awesome CSS for the public-facing side of the site. */
		wp_enqueue_style( $this->plugin_name. '-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), $this->version, 'all' );

		/** Enqueue the Slick CSS for the public-facing side of the site. */
		wp_enqueue_style( $this->plugin_name. '-slick', plugin_dir_url( __FILE__ ) . 'css/slick.min.css', array(), $this->version, 'all' );
		/** Enqueue the Magnific CSS for the public-facing side of the site. */
		wp_enqueue_style( $this->plugin_name.'-magnific', plugin_dir_url( __FILE__ ) . 'css/qcfw-quick-view-public-magnific.css', array(), $this->version, 'all' );

		 /** Enqueue the main plugin CSS for the public-facing side of the site. */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/qcfw-checkout-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/** Enqueue the WooCommerce "Add to Cart" variation script. */
		wp_enqueue_script( 'wc-add-to-cart-variation' );

		/** Enqueue the Slick JavaScript file for the public-facing side of the site. */
		wp_enqueue_script( $this->plugin_name.'-slick', plugin_dir_url( __FILE__ ) . 'js/qcfw-checkout-quick-view-public-slick.min.js', array( 'jquery' ), $this->version, false );

		/** Enqueue the Magnific JavaScript file for the public-facing side of the site. */
		wp_enqueue_script( $this->plugin_name.'-magnific', plugin_dir_url( __FILE__ ) . 'js/qcfw-checkout-quick-view-public-magnific.js', array( 'jquery' ), $this->version, false );

		/** Enqueue the main plugin JavaScript file for the public-facing side of the site.*/
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/qcfw-checkout-public.js', array( 'jquery' ), $this->version, false );

		/** Localize the main script with essential data. */
		wp_localize_script($this->plugin_name, 'qcfw_checkout_quick_view', array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'nonce'    => wp_create_nonce( 'qcfw_checkout_quick_view_nonce' ),
		));

		/** Retrieve settings from the plugin's options page. */
		$settings       		= Qcfw_Checkout_Settings::get_settings();

		/** Retrieve settings related to icons and buttons. */
		$qcfw_icon_switch 		= isset( $settings['qcfw_icon_switch'] ) ? $settings['qcfw_icon_switch'] : '';
		$qcfw_btn_icon 			= isset( $settings['qcfw_btn_icon'] ) ? $settings['qcfw_btn_icon'] : '';
		$qcfw_btn_icon_select 	= isset( $settings['qcfw_btn_icon_select'] ) ? $settings['qcfw_btn_icon_select'] : '';

		/** Retrieve settings for slider button icons. */
		$qcfw_slider_btn_left_icon				= isset($settings['qcfw_slider_btn_left_icon']) ? $settings['qcfw_slider_btn_left_icon'] : '';
		$qcfw_slider_btn_right_icon				= isset($settings['qcfw_slider_btn_right_icon']) ? $settings['qcfw_slider_btn_right_icon'] : '';

		/** Retrieve loading animation text. */
		$qcfw_loading_text 						= isset($settings['qcfw_loading_text']) ? $settings['qcfw_loading_text'] : '';

		/** Localize script with button icon data if icon switch is enabled. */
		if ($qcfw_icon_switch) {
			wp_localize_script($this->plugin_name, 'qcfw_btn', array(
				'icon' 			=> $qcfw_btn_icon,
				'icon_position' => $qcfw_btn_icon_select,
			));
		}

		/** Localize script with slider button icon data. */
		wp_localize_script($this->plugin_name, 'qcfw_slidrt_icon', array(
			'left' 				=> $qcfw_slider_btn_left_icon,
			'right' 			=> $qcfw_slider_btn_right_icon,
		));

		/** Localize script with loading animation text. */
		wp_localize_script($this->plugin_name, 'loading', array(
			'animation_text' 	=> $qcfw_loading_text,
		));

	}

}
