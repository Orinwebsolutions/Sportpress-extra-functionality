<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/Orinwebsolutions
 * @since             1.0.0
 * @package           Sportpress_Extra_Func
 *
 * @wordpress-plugin
 * Plugin Name:       Sportpress extra functionality
 * Plugin URI:        https://github.com/Orinwebsolutions
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Amila Priyankara
 * Author URI:        https://github.com/Orinwebsolutions
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sportpress-extra-func
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
define( 'SPORTPRESS_EXTRA_FUNC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sportpress-extra-func-activator.php
 */
function activate_sportpress_extra_func() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sportpress-extra-func-activator.php';
	Sportpress_Extra_Func_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sportpress-extra-func-deactivator.php
 */
function deactivate_sportpress_extra_func() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sportpress-extra-func-deactivator.php';
	Sportpress_Extra_Func_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sportpress_extra_func' );
register_deactivation_hook( __FILE__, 'deactivate_sportpress_extra_func' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sportpress-extra-func.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sportpress_extra_func() {

	$plugin = new Sportpress_Extra_Func();
	$plugin->run();

}
run_sportpress_extra_func();
