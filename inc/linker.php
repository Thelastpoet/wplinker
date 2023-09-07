<?php

namespace WPLinker;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AutoLinker {

    private $terms_index;
    private $db_table;

    /**
     * Constructor to initialize the terms index.
     */
    public function __construct() {
        $this->terms_index = $this->get_terms_index();
        $this->db_table = new WPLinkerDb();
    }

    /**
     * Automatically create internal links in WordPress posts based on predefined terms.
     *
     * @param string $content The post content.
     * @return string Modified post content with internal links.
     */
    public function auto_internal_links( $content, $post_id = null ) {

        // Loop through each term and replace it in the content with a link, if applicable.
        foreach ( $this->terms_index as $term => $target_post_id ) {

            // Create the URL to the post
            $url = get_permalink( $target_post_id );

            // Replace the term in the content with a link to the post.
            // Note: This replaces only the first occurrence of the term.
            $content = preg_replace( '/\b' . preg_quote( $term, '/' ) . '\b/', "<a href='{$url}'>{$term}</a>", $content, 1 );

            // Update db
            if ( $post_id ) {
                $this->db_table->insert_data( $post_id, $term, $url);
            }
        }

        return $content;
    }

    /**
     * Get the index of terms. This function will be defined later.
     *
     * @return array Index of terms to post IDs.
     */
    private function get_terms_index() {
        // Placeholder: Actual implementation will go here.
        return [];
    }
}
