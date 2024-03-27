<?php
/**
 * Add Loader
 * 
 * A trait definition to add a loader to objects.
 *
 * @link       https://afterword.com.au
 * @since      1.0.0
 * @package    after-loader
 * @author     Andrew Hateley-Browne <andrew@afterword.com.au>
 */
namespace Afterword\Loader_Plugin;
	use Afterword\Loader_Plugin\Loader;

include_once trailingslashit( WPMU_PLUGIN_DIR ) . 'after-loader/loader.php';

trait Add_Loader {
	/**
	 * Loader singleton object.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		Loader				The loader object.
	 */
	private static $loader;

	/**
	 * Instantiate the loader if it does not exist, and return the instance.
	 *
	 * @since	1.0.0
	 * @access  public
	 * @return	$loader		The loader singleton object.
	 */
	public static function loader() {

		if( !isset( self::$loader ) ) {
			self::$loader = new Loader;
		}

		return self::$loader;
	}
}