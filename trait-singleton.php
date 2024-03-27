<?php
/**
 * Singleton
 * 
 * A trait definition to implement singleton objects.
 *
 * @link       https://afterword.com.au
 * @since      1.0.0
 * @package    after-loader
 * @author     Andrew Hateley-Browne <andrew@afterword.com.au>
 */
namespace Afterword\Loader_Plugin;

trait Singleton {

	/**
	 * The singleton instance of the object.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		object		$instance   	The singleton object.
	 */
	private static $instance;

	/**
	 * Close the construct magic method.
	 *
	 * @since	1.0.0
	 * @access	private
	 */
	private function __construct() {}
	
	/**
	 * Close the clone and wakeup magic methods.
	 *
	 * @since	1.0.0
	 * @access	public
	 */
	final public function __clone() {}
	final public function __wakeup() {}

	/**
	 * Instantiate the singleton object if it does not exist, and return the instance.
	 *
	 * @since	1.0.0
	 * @access  public
	 * @return	static		$instance
	 */
	public static function instance() {

		if( !isset( self::$instance ) ) {

			self::$instance = new self();
		}

		return self::$instance;
	}
}