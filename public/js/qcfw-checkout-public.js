(function($) {
	'use strict';

	$(document).ready(function() {

		/** Check if qcfw_btn is defined and has an icon property */
		if (typeof qcfw_btn !== 'undefined' && qcfw_btn.icon) {
			let iconClass = qcfw_btn.icon;
			let iconElement = $('<i class="' + iconClass + '"></i>');
			if (qcfw_btn.icon_position === 'before') {
				$('.qcfw_shop_buy_now_button').prepend(iconElement);
			} else {
				$('.qcfw_shop_buy_now_button').append(iconElement);
			}
		}

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
							mainClass: 'mfp-qcfw',
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

						/** Check if there are gallery images */
						let hasGalleryImages = $('#qcfw-checkout-image-slider .qcfw-checkout-product-image').length > 1;
						let left_icon = qcfw_slidrt_icon.left;
						let right_icon = qcfw_slidrt_icon.right;
						
						/** Initialize Slick slider only if there are gallery images */
						if (hasGalleryImages) {
							$('#qcfw-checkout-image-slider').slick({
								dots: true,
								infinite: true,
								slidesToShow: 1,
								slidesToScroll: 1,
								prevArrow: `<button type="button" class="slick-prev"><i class="${left_icon}"></i></button>`,
								nextArrow: `<button type="button" class="slick-next"><i class="${right_icon}"></i></button>`
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


		let is_blocked = function ($node) {
			return $node.is('.processing') || $node.parents('.processing').length;
		};

		let block = function ($node) {
			if (!is_blocked($node)) {
				$node.data('processing', true);
				$node.block({
					message: null,
					overlayCSS: {
						background: '#fff',
						opacity: 0.6
					}
				});
			}
		};
		
		let unblock = function ($node) {
			$node.data('processing', false);
			$node.unblock();
		};
		

		$( document ).on( 'change', 'input.qty', function() {
			let item_hash = $( this ).attr( 'name' ).replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
			let item_quantity = $( this ).val();
			let currentVal = parseFloat(item_quantity);
			setTimeout(function () {
				$.ajax({
					type: 'POST',
					url: qcfw_update_checkout_cart.ajax_url,
					data: {
						action: 'qcfw_update_checkout_cart',
						nonce: qcfw_update_checkout_cart.nonce,
						hash: item_hash,
						quantity: currentVal
					},
					beforeSend: function (response) {
						// block($('#order_review'));
						block($('.woocommerce-cart-form'));
					},
					complete: function (response) {
						// unblock($('#order_review'));
						unblock($('.woocommerce-cart-form'));
					},
					success: function(response) {
						$('#order_review').html($(response).html()).trigger('updated_checkout');
						$(document.body).trigger('added_to_cart');
						location.reload();
					}
				});
			}, 500);  
		});
		
	});
})(jQuery);
