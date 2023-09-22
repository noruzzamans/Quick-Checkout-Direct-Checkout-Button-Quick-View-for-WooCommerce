<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class QCFW_Checkout_Quick_View_Ajax.
 *
 * This class handles the AJAX functionality for the quick view feature in WooCommerce. It manages the display
 * of product information in a modal when the quick view button is clicked, and handles actions related to
 * quick view, such as avoiding redirection on "Add to Cart".
 *
 * @since 1.0.0
 */
class QCFW_Checkout_Quick_View_Ajax {

	/**
     * The single instance of the class.
     */
    protected static $instance;

    /**
     * Returns the single instance of the class.
     *
     * @return QCFW_Checkout_Quick_View_Ajax Singleton instance of the class.
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

	/**
     * Class Constructor.
     *
     * Initializes the class and sets up action hooks and filters for AJAX functionality related to quick view.
     *
     * @since 1.0.0
     */
	public function __construct() {
		add_action( 'wp_ajax_qcfw_checkout_quick_view', [$this, 'qcfw_checkout_quick_view'] );
        add_action( 'wp_ajax_nopriv_qcfw_checkout_quick_view', [$this, 'qcfw_checkout_quick_view'] );

		add_action( 'qcfw_product_summary', 'woocommerce_template_single_title', 5 );
		add_action( 'qcfw_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'qcfw_product_summary', 'woocommerce_template_single_price', 15 );
		add_action( 'qcfw_product_summary', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'qcfw_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
		add_action( 'qcfw_product_summary', 'woocommerce_template_single_meta', 30 );
		add_action( 'qcfw_product_summary', 'woocommerce_template_single_sharing', 50 );
		add_filter( 'woocommerce_add_to_cart_form_action', array( $this, 'qcfw_checkout_quick_view_avoid_redirecting_to_single_page' ), 10, 1 );
	}

	/**
     * Handles the quick view AJAX request.
     *
     * Retrieves product information and displays it in a modal when the quick view button is clicked.
     *
     * @since 1.0.0
     */
	public function qcfw_checkout_quick_view() {
		$nonce = $_POST['nonce'];
	
		if ( ! wp_verify_nonce( $nonce, 'qcfw_checkout_quick_view_nonce' ) ) {
			die( esc_html__('Nonce not verified!', 'qcfw-checkout') );
		}
	
		global $post, $product;
		$product_id 	= isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
		$product 		= wc_get_product( $product_id );
		$product_name 	= $product->get_name();
	
		/** Get an array of attachment IDs for product images */
		$attachment_ids = array();
		
		/** Add featured image */
		$featured_image_id = get_post_thumbnail_id( $product_id );
		if ( $featured_image_id ) {
			$attachment_ids[] = $featured_image_id;
		}
	
		/** Add gallery images */
		$gallery_attachment_ids = $product->get_gallery_image_ids();
		if ( ! empty( $gallery_attachment_ids ) ) {
			$attachment_ids = array_merge( $attachment_ids, $gallery_attachment_ids );
		}
	
		/** Remove duplicates and re-index the array */
		$attachment_ids = array_values( array_unique( $attachment_ids ) );
	
		if ( $product && ! empty( $attachment_ids ) ) {
			$post = get_post( $product_id );
			setup_postdata( $post );
			?>
			<div class="qcfw-checkout-product-modal">
				<div class="qcfw-checkout-product-images">
					<div id="qcfw-checkout-image-slider" class="qcfw-checkout-product-images-slider">
						<?php foreach ( $attachment_ids as $attachment_id ) : ?>
							<div class="qcfw-checkout-product-image">
								<img src="<?php echo wp_get_attachment_image_url( $attachment_id, 'full' ); ?>" alt="<?php echo esc_attr( $product_name ); ?>">
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="summary entry-summary qcfw-checkout-summary-wrapper">
					<div class="summary-content qcfw-checkout-summary-content">
						<?php do_action( 'qcfw_product_summary'); ?>
					</div>
				</div>
			</div>
			<?php
			wp_reset_postdata();
		}
		wp_die();
	}
	
    /**
     * Checks if the current action is a quick view AJAX request.
     *
     * @return bool Whether the current action is a quick view AJAX request.
     * @since 1.0.0
     */
	public function qcfw_checkout_quick_view_is_quick_view() {
        /** phpcs:ignore WordPress.Security.NonceVerification.Recommended */
        return ( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) && 'qcfw_checkout_quick_view' === $_REQUEST['action'] );
    }

    /**
     * Avoids redirecting to single product page on "Add to Cart" in quick view.
     *
     * @param string $value The current action URL.
     * @return string Modified action URL.
     * @since 1.0.0
     */
	public function qcfw_checkout_quick_view_avoid_redirecting_to_single_page($value){
		if ( $this->qcfw_checkout_quick_view_is_quick_view() ) {
            return '';
        }
        return $value;
	}

}
/** Initialize the class instance. */
QCFW_Checkout_Quick_View_Ajax::get_instance();
