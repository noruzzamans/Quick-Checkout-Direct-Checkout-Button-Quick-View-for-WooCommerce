<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/noruzzamanrubel
 * @since             1.0.0
 * @package           Qcfw_Checkout
 *
 * @wordpress-plugin
 * Plugin Name:       Quick Checkout, Direct Checkout Button, Quick View for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/quick-checkout-for-woocommerce/
 * Description:       Quick Checkout for WooCommerce is a streamlined and user-friendly plugin that simplifies the checkout process for your WooCommerce online store.
 * Version:           1.4.8
 * Author:            Noruzzaman
 * Author URI:        https://github.com/noruzzamanrubel
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
define( 'QCFW_CHECKOUT_VERSION', '1.4.8' );
define( 'QCFW_CHECKOUT_PATH', plugin_dir_path( __FILE__ ) );
define( 'QCFW_CHECKOUT_URL', plugin_dir_url( __FILE__ ) );
define( 'QCFW_CHECKOUT_SLUG', 'qcfw-checkout' );
define( 'QCFW_CHECKOUT_NAME', 'Quick Checkout, Direct Checkout Button, Quick View for WooCommerce' );
define( 'QCFW_CHECKOUT_FULL_NAME', 'Quick Checkout, Direct Checkout Button, Quick View for WooCommerce' );
define( 'QCFW_CHECKOUT_BASE_NAME', plugin_basename( __FILE__ ) );


function qcfw_woocommerce_activation_notice() {

	if (!class_exists('WooCommerce')) {

		add_action('admin_notices', function() {
			?>
				<div class="notice notice-error is-dismissible">
					<p><?php printf(__('The %s plugin requires WooCommerce to be activated in order to work. If WooCommerce is not activated, please activate it before using the plugin.', 'qcfw-checkout'), '<b>' . QCFW_CHECKOUT_FULL_NAME . '</b>'); ?></p>
				</div>
			<?php
		}, 10);

		return false;
	}

	return true;
}
add_action('init', 'qcfw_woocommerce_activation_notice', 10);


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
