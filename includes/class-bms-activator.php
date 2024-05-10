<?php

/**
 * Fired during plugin activation
 *
 * @link       https://xyz.com
 * @since      1.0.0
 *
 * @package    Bms
 * @subpackage Bms/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Bms
 * @subpackage Bms/includes
 * @author     Wazid Shah <wazidshh@gmail.com>
 */

 include( plugin_dir_path(__FILE__) . 'class-bms-database.php');

class Bms_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		$bms_database = new BMS_Database();
		$bms_database->initialize_tables();

	}

}
