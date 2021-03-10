<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/Orinwebsolutions
 * @since      1.0.0
 *
 * @package    Sportpress_Extra_Func
 * @subpackage Sportpress_Extra_Func/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sportpress_Extra_Func
 * @subpackage Sportpress_Extra_Func/includes
 * @author     Amila Priyankara <amilapriyankara16@gmail.com>
 */
class Sportpress_Extra_Func_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if (!is_plugin_active('sportspress/sportspress.php')){
			die('Plugin NOT activated, because Sportspress plugin is not activated in your site, Please activate Sportspress plugin plugin!!');
		}
	}

}
