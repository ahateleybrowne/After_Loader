<?php
/**
 * Plugin
 * 
 * An abstract class definition to add Plugin functionality.
 *
 * @link       https://afterword.com.au
 * @since      1.0.0
 * @package    after-loader
 * @author     Andrew Hateley-Browne <andrew@afterword.com.au>
 */
namespace Afterword;

// Exit if accessed directly. 
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Plugin {

    /**
     * @access  protected
     * @var     string      $name	        Plugin name.
     * @var     string      $slug	        Plugin slug.
     * @var     string      $version	    Plugin version.
     * @var     string      $base_path	    Plugin base directory path.
     * @var     string      $base_url	    Plugin base directory url.
	 * @var		object      $loader	        The loader object.
     */
    protected $name, $slug, $version, $base_path, $base_url, $loader;

    /**
     * Constructs plugin, and defines plugin properties from header of passed file.
     *
     * @since   1.0.0
     * @access	public
	 * @param	string      $path           Full path to plugin base file.
     */
    public function __construct( string $path ) {
        
        // Gets Plugin Data from passed base file.
        if( ! function_exists( 'get_plugin_data' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

        $plugin_data = get_plugin_data( $path );

        // Sets plugin properties.
        $this->name 	    = $plugin_data[ 'Name' ];
        $this->slug 	    = $plugin_data[ 'TextDomain' ]; 
        $this->version      = $plugin_data[ 'Version' ];

        // Sets plugin base path and base URL with trailing-slash.
        $this->base_path    = plugin_dir_path( $path );
        $this->base_url     = plugin_dir_url( $path );

        // Adds loader for registering hooks with WordPress.
        $this->loader       = new Loader;
    }

    /**
     * Returns plugin name.
     *
     * @since   1.0.0
     * @access	protected
     */
    public function name() {
        return $this->name;
    }

    /**
     * Returns plugin slug.
     *
     * @since   1.0.0
     * @access	protected
     */
    public function slug() {
        return $this->slug;
    }

    /**
     * Returns plugin version.
     *
     * @since   1.0.0
     * @access	protected
     */
    public function version() {
        return $this->version;
    }

    /**
     * Returns plugin base path with trailing-slash.
     *
     * @since   1.0.0
     * @access	protected
     */
    public function base_path() {
        return $this->base_path;
    }

    /**
     * Returns plugin base URL with trailing-slash.
     *
     * @since   1.0.0
     * @access	protected
     */
    public function base_url() {
        return $this->base_url;
    }

    /**
     * Returns Loader.
     *
     * @since   1.0.0
     * @access	protected
     */
    public function loader() {
        return $this->loader;
    }

    /**
	 * Runs the plugin.
	 * 
	 * Hooks the loader to register all of its hooks with WordPress 
	 * once plugins have loaded.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function run_plugin() {

		// Hook Loader to register all of its hooks once all plugins have loaded.
		add_action( 'plugins_loaded', function() {
			$this->loader()->run();
		}, 10 );
	}
}