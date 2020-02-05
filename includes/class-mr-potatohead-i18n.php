<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       webdesignbyhabby.com
 * @since      1.0.0
 *
 * @package    Mr_Potatohead
 * @subpackage Mr_Potatohead/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mr_Potatohead
 * @subpackage Mr_Potatohead/includes
 * @author     Habby Whyte <bahybaj@hotmail.com>
 */
class Mr_Potatohead_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mr-potatohead',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
