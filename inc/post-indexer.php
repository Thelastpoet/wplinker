<?php

namespace WPLinker;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Create an initial index of posts and terms when the plugin is activated.
 */
function create_initial_post_index() {
    // Code to generate an initial index of terms to post IDs.
}

/**
 * Update the index of posts and terms whenever a post is saved.
 *
 * @param int $post_id The ID of the post being saved.
 * @param \WP_Post $post The post object.
 */
function update_post_index( $post_id, $post ) {

    // Verify post is not a revision and that the post is published
    if ( wp_is_post_revision( $post_id ) || 'publish' !== $post->post_status ) {
        return;
    }

    // Update the index of terms to post IDs.
}

/**
 * Retrieve the current index of terms to post IDs.
 *
 * @return array The index of terms to post IDs.
 */
function get_terms_index() {

    // Retrieve or generate an index of terms to post IDs.
    // You could store this in a WordPress option, for example.
}
