<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              webdesignbyhabby.com
 * @since             1.0.0
 * @package           Mr_Potatohead
 *
 * @wordpress-plugin
 * Plugin Name:       Mr Potato Head
 * Plugin URI:        webdesignbyhabby.com/mr-potatohead
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Habby Whyte
 * Author URI:        webdesignbyhabby.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mr-potatohead
 * Domain Path:       /languages
 */

if (!defined('MR_POTATOHEAD_OPTIONS_NAME')) {
    define('MR_POTATOHEAD_OPTIONS_NAME', 'mr_potatohead_settings');
}
if (!defined('MR_POTATOHEAD_TEXTDOMAIN')) {
    define('MR_POTATOHEAD_TEXTDOMAIN', 'mr_potatohead');
}

if (!defined('MR_POTATOHEAD_VERSION')) {
	define('MR_POTATOHEAD_VERSION', '0.0.1');
}

if (!defined('MR_POTATOHEAD_POST_TYPE')) {
	define('MR_POTATOHEAD_POST_TYPE', 'mrpotatoheads');
}


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mr-potatohead-activator.php
 */
function activate_mr_potatohead() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mr-potatohead-activator.php';
	Mr_Potatohead_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mr-potatohead-deactivator.php
 */
function deactivate_mr_potatohead() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mr-potatohead-deactivator.php';
	Mr_Potatohead_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mr_potatohead' );
register_deactivation_hook( __FILE__, 'deactivate_mr_potatohead' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mr-potatohead.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mr_potatohead() {

	$plugin = new Mr_Potatohead();
	$plugin->run();

}
run_mr_potatohead();
