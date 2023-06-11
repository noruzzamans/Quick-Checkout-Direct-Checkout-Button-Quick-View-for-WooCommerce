<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/noruzzamanrubel
 * @since      1.0.0
 *
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Qcfw_Checkout
 * @subpackage Qcfw_Checkout/includes
 * @author     Noruzzaman <noruzzamanrubel@gmail.com>
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
