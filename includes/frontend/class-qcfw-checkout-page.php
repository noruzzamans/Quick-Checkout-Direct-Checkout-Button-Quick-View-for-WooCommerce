<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once QCFW_CHECKOUT_PATH . 'includes/backend/class-qcfw-checkout-settings.php';


class Qcfw_Checkout_Page {

	/**
	 * The single instance of the class.
	 */
	protected static $instance;

	/**
     * Returns the single instance of the class.
     *
     * @return Qcfw_Checkout_Buy_Now Singleton instance of the class.
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

	public function __construct() { 
		add_action( 'woocommerce_before_checkout_form', array( $this, 'qcfw_checkout_rander_remove_coupon' ), 9 );
		add_filter( 'woocommerce_checkout_fields', array( $this, 'qcfw_checkout_rander_remove_fields' ));
		add_filter( 'woocommerce_enable_order_notes_field', array( $this, 'qcfw_checkout_rander_remove_order_notes' ) );
		add_filter( 'woocommerce_checkout_terms_and_conditions', array( $this, 'qcfw_checkout_rander_remove_policy' ) );
		add_action( 'woocommerce_before_checkout_form', array($this, 'qcfw_cart_on_checkout_page'), 11 );
		add_action( 'wp_ajax_qcfw_update_checkout_cart', array( $this, 'qcfw_update_checkout_cart' ) );
		add_action( 'wp_ajax_nopriv_qcfw_update_checkout_cart', array( $this, 'qcfw_update_checkout_cart' ) );
	}

	/**
     * Removed checkout coupon
     */
	public function qcfw_checkout_rander_remove_coupon() {
		$settings   					= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_coupon_form 	= isset( $settings['qcfw_checkout_remove_coupon_form'] ) ? $settings['qcfw_checkout_remove_coupon_form'] : '';
		switch ($qcfw_checkout_remove_coupon_form) {
			case '1':
				remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
				break;
			default:
				// No action required
				break;
		}

	}
	
	/**
     * Removed checkout fields
     */
	public function qcfw_checkout_rander_remove_fields($fields) {
		$settings   					= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_fields 	= isset( $settings['qcfw_checkout_remove_fields'] ) ? $settings['qcfw_checkout_remove_fields'] : '';
	
		if ($qcfw_checkout_remove_fields) {
			$billing_fields_to_remove = array_map(function ($key) {
				return 'billing_' . $key;
			}, $qcfw_checkout_remove_fields);
	
			$shipping_fields_to_remove = array_map(function ($key) {
				return 'shipping_' . $key;
			}, $qcfw_checkout_remove_fields);
	
			$fields['billing'] = array_diff_key($fields['billing'], array_flip($billing_fields_to_remove));
			$fields['shipping'] = array_diff_key($fields['shipping'], array_flip($shipping_fields_to_remove));
		}
	
		return $fields;
	}

	/**
     * Removed checkout Order notes
     */
	public function qcfw_checkout_rander_remove_order_notes($string) {
		$settings   						= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_order_notes 	= isset( $settings['qcfw_checkout_remove_order_notes'] ) ? $settings['qcfw_checkout_remove_order_notes'] : '';
	
		switch ($qcfw_checkout_remove_order_notes) {
			case '1':
				$string = false;
				break;
			default:
				// No action required, $string keeps its original value
				break;
		}
	
		return $string;
	}

	/**
     * Removed checkout policy and trams and conditions
     */
	public function qcfw_checkout_rander_remove_policy() {
		$settings   						= Qcfw_Checkout_Settings::get_settings();
		$qcfw_checkout_remove_policy 	= isset( $settings['qcfw_checkout_remove_policy'] ) ? $settings['qcfw_checkout_remove_policy'] : '';
		$qcfw_checkout_remove_terms 	= isset( $settings['qcfw_checkout_remove_terms'] ) ? $settings['qcfw_checkout_remove_terms'] : '';
	
		switch ($qcfw_checkout_remove_policy) {
			case '1':
				remove_action('woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20);
				break;
			default:
				// No action required
				break;
		}
	
		switch ($qcfw_checkout_remove_terms) {
			case '1':
				remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
				break;
			default:
				// No action required
				break;
		}
	}

	public function qcfw_cart_on_checkout_page() {
		
		do_action( 'woocommerce_before_cart' ); ?>

		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
					<tr>
						<th class="product-remove"><span class="screen-reader-text"><?php esc_html_e( 'Remove item', 'woocommerce' ); ?></span></th>
						<th class="product-thumbnail"><span class="screen-reader-text"><?php esc_html_e( 'Thumbnail image', 'woocommerce' ); ?></span></th>
						<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
						<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
						<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
						<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						/**
						 * Filter the product name.
						 *
						 * @since 2.1.0
						 * @param string $product_name Name of the product in the cart.
						 * @param array $cart_item The product in the cart.
						 * @param string $cart_item_key Key for the product in the cart.
						 */
						$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

								<td class="product-remove">
									<?php
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_cart_item_remove_link',
											sprintf(
												'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												/* translators: %s is the product name */
												esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											),
											$cart_item_key
										);
									?>
								</td>

								<td class="product-thumbnail">
								<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $product_permalink ) {
									echo $thumbnail; // PHPCS: XSS ok.
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
								}
								?>
								</td>

								<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
								<?php
								if ( ! $product_permalink ) {
									echo wp_kses_post( $product_name . '&nbsp;' );
								} else {
									/**
									 * This filter is documented above.
									 *
									 * @since 2.1.0
									 */
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
								}

								do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

								// Meta data.
								echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

								// Backorder notification.
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
								}
								?>
								</td>

								<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
									<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</td>

								<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
								<?php
								if ( $_product->is_sold_individually() ) {
									$min_quantity = 1;
									$max_quantity = 1;
								} else {
									$min_quantity = 0;
									$max_quantity = $_product->get_max_purchase_quantity();
								}

								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $max_quantity,
										'min_value'    => $min_quantity,
										'product_name' => $product_name,
									),
									$_product,
									false
								);

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
								?>
								</td>

								<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
									<?php
										echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
									?>
								</td>
							</tr>
							<?php
						}
					}
					?>

					<?php do_action( 'woocommerce_cart_contents' ); ?>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</tbody>
			</table>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>

		<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

		<div class="cart-collaterals">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_cart' );
	 }

	public function qcfw_update_checkout_cart() {

		$nonce = $_POST['nonce'];
	
		if ( ! wp_verify_nonce( $nonce, 'qcfw_update_checkout_cart_nonce' ) ) {
			die( esc_html__('Nonce not verified!', 'qcfw-checkout') );
		}

		// Set item key as the hash found in input.qty's name
		$qcfw_key = $_POST['hash'];

		// Get the array of values owned by the product we're updating
		$qcfw_product_values = WC()->cart->get_cart_item( $qcfw_key );


		// Get the quantity of the item in the cart
		$qcfw_product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT)) ), $qcfw_key );

		// Update cart validation
		$qcfw_passed_validation  = apply_filters( 'woocommerce_update_cart_validation', true, $qcfw_key, $qcfw_product_values, $qcfw_product_quantity );

		// Update the quantity of the item in the cart
		if ( $qcfw_passed_validation ) {
			WC()->cart->set_quantity( $qcfw_key, $qcfw_product_quantity, true );
		}

		ob_start();
		// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
		?>
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>
		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		<?php
		$data = ob_get_clean();

		wp_send_json( $data );

		wp_die();

	}

}
/** Initialize the class instance. */
Qcfw_Checkout_Page::get_instance();