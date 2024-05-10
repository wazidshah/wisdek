<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://xyz.com
 * @since             1.0.0
 * @package           Bms
 *
 * @wordpress-plugin
 * Plugin Name:       Books Management System
 * Plugin URI:        https://xyz.com
 * Description:       Web based book management system
 * Version:           1.0.0
 * Author:            Wazid Shah
 * Author URI:        https://xyz.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bms
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
define( 'BMS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bms-activator.php
 */
function activate_bms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bms-activator.php';
	Bms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bms-deactivator.php
 */
function deactivate_bms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bms-deactivator.php';
	Bms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bms' );
register_deactivation_hook( __FILE__, 'deactivate_bms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bms() {

	$plugin = new Bms();
	$plugin->run();

}
run_bms();
