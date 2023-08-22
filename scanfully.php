<?php
/*
 * Scanfully WordPress plugin
 *
 * @package   Scanfully\Main
 * @copyright Copyright (C) 2023, Scanfully BV - support@scanfully.com
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 *
 * @wordpress-plugin
 * Plugin Name: Scanfully
 * Version:     1.0.0
 * Plugin URI:  https://www.scanfully.com/wp-plugin
 * Description: Scanfully is your favorite WordPress performance and health monitoring tool.
 * Author:      Scanfully
 * Author URI:  https://www.scanfully.com/
 * Text Domain: scanfully
 * Domain Path: /languages/
 * License:     GPL v3
 * Requires at least: 6.0
 * Requires PHP: 7.2.5
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/** @TODO Add PHP version check */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


function Scanfully(): \Scanfully\Main {
	return \Scanfully\Main::get();
}

add_action( 'plugins_loaded', function () {
	// meta
	define( "SCANFULLY_PLUGIN_FILE", __FILE__ );
	define( "SCANFULLY_VERSION", "1.0.0" );

	// boot
	require 'vendor/autoload.php';
	Scanfully()->setup();
}, 20 );