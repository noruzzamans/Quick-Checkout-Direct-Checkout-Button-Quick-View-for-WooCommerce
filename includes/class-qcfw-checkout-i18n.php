<?php

/**
 * Internationalization functionality for the plugin.
 *
 * This class loads and defines the internationalization files, making the plugin ready for translation.
 *
 * @package Qcfw_Checkout
 * @subpackage Qcfw_Checkout/includes
 * @since 1.0.0
 */
class Qcfw_Checkout_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'qcfw-checkout',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
