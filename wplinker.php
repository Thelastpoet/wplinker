<?php
/**
 * Plugin Name: wpLinker
 * Plugin URI: https://nabaleka.com
 * Description: A plugin to automatically create internal links in WordPress posts based on predefined terms.
 * Version: 1.0.0
 * Author: Ammanulah Emmanuel
 * Author URI: https://nabaleka.com
 * License: GPL-2.0+
 * Text Domain: wplinker
 * Domain Path: /languages
*/

namespace WPLinker;

use WPLinker\auto_internal_links;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Constants
define( 'WPLINKER_PLUGIN_DIR', plugin_dir_path( __FILE__  ));
define( 'WPLINKER_PLUGIN_URL', plugin_dir_url( __FILE__  ));
define( 'WPLINKER_PLUGIN_FILE', __FILE__ );


require_once WPLINKER_PLUGIN_DIR . 'inc/functions.php';
require_once WPLINKER_PLUGIN_DIR . 'inc/helpers.php';
require_once WPLINKER_PLUGIN_DIR . 'inc/post-indexer.php';

// Add auto_internal_links function to the 'the_content' filter.
add_filter( 'the_content', 'WPLinker\auto_internal_links' );

// Add update_post_index function to the 'save_post' action.
add_action( 'save_post', 'WPLinker\update_post_index', 10, 2 );

/**
 * Activation hook to create the initial post index.
 */
register_activation_hook( __FILE__, 'WPLinker\create_initial_post_index' );

/**
 * Deactivation hook to clean up any necessary data.
 */
register_deactivation_hook( __FILE__, 'WPLinker\clean_up_on_deactivation' );
