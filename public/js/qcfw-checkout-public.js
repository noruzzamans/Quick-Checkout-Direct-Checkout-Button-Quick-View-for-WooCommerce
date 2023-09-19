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
	});
})(jQuery);
