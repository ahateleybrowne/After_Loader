<?php
/**
 * Plugin Name:			After_ Loader
 * Description:			An MU-plugin to help load other After_ plugins.
 * Requires at least:	6.4.3
 * Requires PHP:		8.1.0
 * Version:           	1.0.0
 * Author:				Andrew Hateley-Browne
 * Author URI:			https://afterword.com.au
 * Update URI:			https://afterword.com.au/plugins/after-loader
 * License:				GPL-2.0-or-later
 * License URI:			https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:			after-loader
 *
 * @link       https://afterword.com.au/plugins/after-loader
 * @package    Afterword\Loader_Plugin
 * @author     Andrew Hateley-Browne <andrew@afterword.com.au>
 */

namespace Afterword;
	use Afterword\Loader_Plugin\Singleton;
	use Afterword\Loader_Plugin\Add_Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Makes singleton class with Singleton trait.
include_once trailingslashit( WPMU_PLUGIN_DIR ) . 'after-loader/trait-singleton.php';
// Adds loader with Add Loader trait
include_once trailingslashit( WPMU_PLUGIN_DIR ) . 'after-loader/trait-add-loader.php';

class Loader_Plugin {
	use Singleton;
	use Add_Loader;

	/**
	 * The singular label for this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    	The plugin label.
	 */
	public static $label;

    /**
	 * The singular slug for this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    	The plugin slug.
	 */
	public static $slug;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    	The plugin version.
	 */
	public static $version;

	/**
	 * Defines plugin properties.
	 *
	 * @since   1.0.0
	 * @access	public
	 */
	private function define_plugin_props() {
		
		if( ! function_exists( 'get_plugin_data' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		// Gets plugin data from root file header.
		$plugin_data = get_plugin_data( __FILE__ );

		// Sets plugin properties.
		self::$label 	= $plugin_data[ 'Name' ];
		self::$slug 	= $plugin_data[ 'TextDomain' ]; 
		self::$version 	= $plugin_data[ 'Version' ];

		// Sets constant for confirming plugin is active.
		define( 'LOADER_PLUGIN', true );
	}

	/**
	 * Returns Singleton trait for inclusion.
	 *
	 * @since   1.0.0
	 * @access	public
	 */
	public function make_singleton() {
		return trailingslashit( WPMU_PLUGIN_DIR ) . 'after-loader/trait-singleton.php';
	}

	/**
	 * Returns Add Loader file for inclusion.
	 *
	 * @since   1.0.0
	 * @access	public
	 */
	public function add_loader() {
		return trailingslashit( WPMU_PLUGIN_DIR ) . 'after-loader/trait_add_loader.php';
	}

	/**
	 * Runs the After_ Loader plugin.
	 * 
	 * Defines After_ Loader plugin properties, and hooks the loader 
	 * to register all of its hooks with WordPress 
	 * once all other plugins have loaded.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function run() {

		// Define Plugin Properties.
		$this->define_plugin_props();
		// Instantiate loader for use of plugins.
		$this->loader();
		// Hook Loader to register all of its hooks once plugins have loaded.
		add_action( 'plugins_loaded', function() {
			self::instance()->loader()->run();
		}, 10 );
	}
}

// Run Plugin.
Loader_Plugin::instance()->run();