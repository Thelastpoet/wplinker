<?php

namespace WPLinker;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Automatically create internal links in WordPress posts based on predefined terms.
 *
 * @param string $content The post content.
 * @return string Modified post content with internal links.
 */
function auto_internal_links( $content ) {

    // Get the index of terms (this function will be defined in post-indexer.php).
    $terms_index = get_terms_index();

    // Loop through each term and replace it in the content with a link, if applicable.
    foreach ( $terms_index as $term => $post_id ) {

        // Create the URL to the post
        $url = get_permalink( $post_id );

        // Replace the term in the content with a link to the post.
        // Note: This replaces only the first occurrence of the term.
        $content = preg_replace( '/\b' . preg_quote( $term, '/' ) . '\b/', "<a href='{$url}'>{$term}</a>", $content, 1 );
    }

    return $content;
}
