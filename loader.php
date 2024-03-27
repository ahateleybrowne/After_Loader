<?php
/**
 * Loader
 * 
 * A class definition to load object actions and filters with WordPress hooks.
 *
 * @link       https://afterword.com.au
 * @since      1.0.0
 * @package    after-loader
 * @author     Andrew Hateley-Browne <andrew@afterword.com.au>
 */
namespace Afterword\Loader_Plugin;

class Loader {
	
	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the theme loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the theme loads.
	 */
	protected $filters;

	/**
	 * Constructs the object.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
    public function __construct() {

		$this->actions = array();
		$this->filters = array();
	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    array                $callback         A reference to the instance and the method, or the global function.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    array                $callback         A reference to the instance and the method, or the global function.
	 * @param    int                  $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $callback, $priority, $accepted_args );	
	}

	/**
	 * Register the actions and hooks into a single collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $hooks            The collection of hooks that is being registered ( that is, actions or filters ).
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    array                $callback         A reference to the instance and the method, or the global function.
	 * @param    int                  $priority         The priority at which the function should be fired.
	 * @param    int                  $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $callback, $priority, $accepted_args ) {

		$hooks[] = [
			'hook'          => $hook,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		];

		return $hooks;
	}

	/**
	 * Register the filters and actions with WordPress.
	 * 
	 * If the callback is unassociated with a class definition 
	 * (it is defined in the 'global' domain), it adds the function 
	 * without registering a component.
	 * 
	 * @since    1.0.0
	 * @access   public	 
	 */
	public function run() {
		
		foreach( $this->filters as $hook ) {
			add_filter( $hook['hook'], $hook['callback'], $hook['priority'], $hook['accepted_args'] );
		}

		foreach( $this->actions as $hook ) {
			add_action( $hook['hook'], $hook['callback'], $hook['priority'], $hook['accepted_args'] );
		}
	}
}
