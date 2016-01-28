<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://saivarun.me/
 * @since      1.0.0
 *
 * @package    Zoorvy_Social_Share
 * @subpackage Zoorvy_Social_Share/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Zoorvy_Social_Share
 * @subpackage Zoorvy_Social_Share/includes
 * @author     Sai Varun KN <saivarunk@gmail.com>
 */
class Zoorvy_Social_Share_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'zoorvy-social-share',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
