<?php
/**
 * Woo Review Manager
 *
 * @package           PluginPackage
 * @author            Khalid Ahmed
 * @copyright         2021 Khalid Ahmed
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Review Manager
 * Plugin URI:        https://github.com/Khalidwebmail/review-manager.git
 * Description:       User can review respect of criteria for woocmmerce product
 * Version:           1.0.0
 * Author:            Khalid Ahmed
 * Text Domain:       review-manager
 * License:           GPL v2 or later
 */

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Include autoload file
 */
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Class WpWooReviewManager
 */
final class WpWooReviewManager {
	/**
	 * WpWooReviewManager constructor.
	 */
	private function __construct() {
		$this->wp_rm_define_constants();
		register_activation_hook( __FILE__, [ $this, 'wp_rm_activate' ] );
		add_action( 'plugins_loaded', [ $this, 'wp_rm_init_plugin' ] );
	}

	/**
	 * Plugin version
	 */
	public const version = '1.0.0';

	/**
	 * Initialize singleton instance
	 *
	 * @return \WpWooReviewManager
	 */
	public static function wp_rm_init() {
		static $instance  = false;

		if(! $instance) {
			$instance = new self();
		}
		return $instance;
	}

	/**
	 * Define required plugins constants
	 *
	 * @return void
	 */
	public function wp_rm_define_constants() {
		define( 'RM_VERSION', self::version );
		define( 'RM_FILE', __FILE__ );
		define( 'RM_PATH', __DIR__ );
		define( 'RM_URL', plugins_url('', RM_FILE ) );
		define( 'RM_ASSETS', RM_URL . '/assets' );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */

	public function wp_rm_init_plugin() {
		//Class obj
	}

	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function wp_rm_activate() {
		$installed = get_option( 'wp_rm_installed' );
		if( ! $installed ) {
			update_option( 'wp_rm_installed', time() );
		}
		update_option( 'wp_rm_installed', RM_VERSION );
	}
}

/**
 * Initialize the main plugin
 *
 * @return \WpWooReviewManager
 */
function wp_rm_start_plugin() {
	return WpWooReviewManager::wp_rm_init();
}

/**
 * Kick of plugin
 */
wp_rm_start_plugin();