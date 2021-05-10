<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              peterkeyser.ca
 * @since             1.0.1
 * @package           Projects_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Projects Plugin
 * Plugin URI:        peterkeyser.ca/projects-plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            Peter Keyser
 * Author URI:        peterkeyser.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       projects-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Detect plugin.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
// check for plugin using plugin name
if ( !is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
    add_action( 'admin_notices', 'pp_project_admin_noticess' );
}

function pp_project_admin_noticess(){
    $message = sprintf(
        /* translators: 1: Plugin Name 2: classic-editor */
        print_r( '%1$s requires <a href="https://wordpress.org/plugins/classic-editor/">%2$s</a> to be installed and activated.', 'projects-plugin' ),
        '<strong>' . esc_html__( 'Projects Plugin', 'projects-plugin' ) . '</strong>',
        '<strong>' . esc_html__( 'Classic Editor', 'projects-plugin' ) . '</strong>'
    );

    printf( '<div class="notice notice-warning"><p>%1$s</p></div>', $message );
}

/**
 * Currently plugin version.
 * Start at version 1.0.1 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PROJECTS_PLUGIN_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-projects-plugin-activator.php
 */
function activate_projects_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-projects-plugin-activator.php';
	Projects_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-projects-plugin-deactivator.php
 */
function deactivate_projects_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-projects-plugin-deactivator.php';
	Projects_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_projects_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_projects_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-projects-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.1
 */
function run_projects_plugin() {

	$plugin = new Projects_Plugin();
	$plugin->run();

}
run_projects_plugin();
