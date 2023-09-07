<?php

namespace WPLinker;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Sanitize a given string to be used in HTML.
 *
 * @param string $input The input string.
 * @return string The sanitized string.
 */
function sanitize_html( $input ) {
    return esc_html( $input );
}

/**
 * Validate if a given term exists in our index.
 *
 * @param string $term The term to check.
 * @return bool True if exists, false otherwise.
 */
function term_exists_in_index( $term ) {
    $index = get_terms_index();
    return isset( $index[ $term ] );
}

/**
 * Get an option from the plugin's settings.
 *
 * @param string $key The key for the option.
 * @param mixed $default The default value if the option does not exist.
 * @return mixed The option value.
 */
function get_wplinker_option( $key, $default = null ) {
    $options = get_option( 'wplinker_options', [] );
    return isset( $options[ $key ] ) ? $options[ $key ] : $default;
}

/**
 * Update an option in the plugin's settings.
 *
 * @param string $key The key for the option.
 * @param mixed $value The value to set.
 * @return bool True on success, false on failure.
 */
function update_wplinker_option( $key, $value ) {
    $options = get_option( 'wplinker_options', [] );
    $options[ $key ] = $value;
    return update_option( 'wplinker_options', $options );
}

