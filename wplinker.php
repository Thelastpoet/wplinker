<?php
/**
 * Plugin Name: wpLinker
 * Plugin URI: https://nabaleka.com
 * Description: A plugin to automatically create internal links in WordPress posts based on predefined terms.
 * Version: 1.0.0
 * Tested up to: 6.3
 * Requires PHP: 8.1
 * Requires at least: 5.6
 * Author: Ammanulah Emmanuel
 * Author URI: https://nabaleka.com
 * License: GPL-2.0+
 * Text Domain: wplinker
 * Domain Path: /languages
*/

namespace WPLinker;


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define constants
define( 'WPLINKER_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define( 'WPLINKER_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define( 'WPLINKER_PLUGIN_FILE', __FILE__ );

