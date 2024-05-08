<?php
/**
 * Plugin Name:			After_ Loader
 * Plugin URI:			https://afterword.com.au/plugins/after-cta
 * Version:           	1.0.0
 * Description:			An MU-plugin to help load other After_ plugins.
 * Author:            	Andrew Hateley-Browne
 * Author URI:			https://afterword.com.au 
 * Text Domain:       	after-loader
 * Requires at least: 	6.4.3
 * Requires PHP:      	8.1.0
 * Update URI:			https://afterword.com.au/plugins/after-loader
 *
 * @link       https://afterword.com.au/plugins/after-loader
 * @package    Afterword\Loader_Plugin
 * @author     Andrew Hateley-Browne <andrew@afterword.com.au>
 */

namespace Afterword;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

// If After_Loader hasn't been loaded yet, include required files for Plugin and Loader classes.
if( !defined( 'AFTER_LOAD' ) ) { 
    require_once( plugin_dir_path( __FILE__ ) . 'includes/plugin.php' );
    require_once( plugin_dir_path( __FILE__ ) . 'includes/loader.php' );
}


class After_Loader extends Plugin {
	
	/**
     * Creates plugin instance and defines properties of parent class.
     *
     * @since   1.0.0
     * @access	public
     */
    public function __construct() {
        
		parent::__construct( __FILE__ );

        if( !defined( 'AFTER_LOAD' ) ) { 
			define( 'AFTER_LOAD', true );
		}
    }

	/**
     * Registers the class directory in the auto-loader .
     *
     * @since   1.0.0
	 * @access  public
	 * @param   string      $directory        The classes directory name.
     */
	public static function register_classes_directory( string $directory ) {

        spl_autoload_register( function ( $class ) use ( $directory ) {
            
            $file_path =  trailingslashit( $directory ) . $class . '.php';
        
            if( is_readable( $file_path ) ) {
                require_once $file_path;
            }
        } );
	}
}

// Run Plugin.
$After_Loader = new After_Loader();
After_Loader::register_classes_directory( $After_Loader->base_path() . 'includes/' );