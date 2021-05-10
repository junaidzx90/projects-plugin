<?php

/**
 * Fired during plugin activation
 *
 * @link       peterkeyser.ca
 * @since      1.0.0
 *
 * @package    Projects_Plugin
 * @subpackage Projects_Plugin/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Projects_Plugin
 * @subpackage Projects_Plugin/includes
 * @author     Peter Keyser <peterkeyser1@gmail.com>
 */
class Projects_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_image_size( 'medium', 300, '', true );
	}

}
