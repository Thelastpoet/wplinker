<?php

namespace WPLinker;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * A helper function to safely get an array value by key.
 *
 * @param array $array The input array.
 * @param string|int $key The array key.
 * @param mixed $default The default value to return if the key is not set.
 * @return mixed The value from the array, or the default.
 */
function array_get( $array, $key, $default = null ) {
    return isset( $array[ $key ] ) ? $array[ $key ] : $default;
}

/**
 * Another helper function that could sanitize terms before they are used for internal linking.
 *
 * @param string $term The term to be sanitized.
 * @return string The sanitized term.
 */
function sanitize_term( $term ) {
    return sanitize_text_field( $term );
}
