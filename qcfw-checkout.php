<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/noruzzamanrubel
 * @since             1.0.0
 * @package           Qcfw_Checkout
 *
 * @wordpress-plugin
 * Plugin Name:       Quick Checkout for WooCommerce
 * Plugin URI:        https://https://github.com/noruzzamanrubel
 * Description:       Quick Checkout for WooCommerce is a streamlined and user-friendly plugin that simplifies the checkout process for your WooCommerce online store.
 * Version:           1.0.0
 * Author:            Noruzzaman
 * Author URI:        https://https://github.com/noruzzamanrubel
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       qcfw-checkout
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'QCFW_CHECKOUT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-qcfw-checkout-activator.php
 */
function qcfw_checkout_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qcfw-checkout-activator.php';
	Qcfw_Checkout_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-qcfw-checkout-deactivator.php
 */
function qcfw_checkout_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qcfw-checkout-deactivator.php';
	Qcfw_Checkout_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'qcfw_checkout_activate' );
register_deactivation_hook( __FILE__, 'qcfw_checkout_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-qcfw-checkout.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_qcfw_checkout() {

	$plugin = new Qcfw_Checkout();
	$plugin->run();

}
run_qcfw_checkout();
