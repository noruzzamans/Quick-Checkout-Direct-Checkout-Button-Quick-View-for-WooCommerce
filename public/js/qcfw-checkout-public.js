(function($) {
	'use strict';

	$(document).ready(function() {

		/** Click event handler for the quick view button */
		$('.qcfw_shop_buy_now_button').on('click', function(e) {
			e.preventDefault();
			let productId = $(this).data('product-id');

			/** Create a loading overlay HTML content */
			let loading_text = 'Loading...';
			let loadingHtml = `
			<div class="loading-overlay">
				<div class="loading-text">${loading_text}</div>
			</div>`;		

			/** Append the loading overlay to the body of the web page */
			$('body').append(loadingHtml);

			/** AJAX request to retrieve the product details */
			$.ajax({
				url: qcfw_checkout_quick_view.ajax_url,
				type: 'POST',
				data: {
					action: 'qcfw_checkout_quick_view',
					nonce: qcfw_checkout_quick_view.nonce,
					product_id: productId
				},
				success: function(response) {
					setTimeout(function() { 
						/** Open the Magnific Popup and display the product details */
						$.magnificPopup.open({
							items: {
								src: response
							},
							type: 'inline',
							mainClass: 'mfp-ewqv',
							closeBtnInside: true,
							closeOnBgClick: true,
							showCloseBtn: true,
						});

						/** Initialize WooCommerce variation forms if WooCommerce is active. */
						if (typeof wc_add_to_cart_variation_params !== 'undefined') {
							var form_variation = $('.qcfw-checkout-product-modal').find('.variations_form');
							form_variation.each(function () {
								$(this).wc_variation_form();
							});
						}

						// Remove loading overlay upon successful AJAX completion
						$('.loading-overlay').remove();

					}, 1000);
				},
				error: function() {
					console.log('Error retrieving product details.');
				}
			});
			
		});

		/**
		 * This script handles the click event for elements with the class 'qcfw_single_buy_now_button'.
		 * It constructs a URL for adding a product to the cart and redirects the user to the appropriate page.
		 */
		$(document).on('click', '.qcfw_single_buy_now_button', function (e) {
			e.preventDefault();
			e.stopPropagation();
		
			const qcfw_button = $(this);
			const $form = qcfw_button.closest('form.cart');
			const product_id = $form.find('[name=add-to-cart]').val() || 0;
			const variation_id = $form.find('input[name=variation_id]').val();
			let params = $form.serialize().replace(/\%5B%5D/g, '[]') || '';
		
			if (qcfw_button.is('.disabled')) {
				return;
			}
		
			if (typeof variation_id !== 'undefined' && variation_id === 0) {
				return false;
			}
		
			if (params) {
				params = '&' + params;
			}
		
			let href = qcfw_button.attr('data-href') || '';
		
			if (href.indexOf('?') !== -1) {
				href += '&add-to-cart=' + product_id + params;
			} else {
				href += '?add-to-cart=' + product_id + params;
			}
		
			if (href !== 'undefined') {
				document.location.href = href;
			}
		
			return false;
		});
		
	});
})(jQuery);
