<?php

namespace WPLinker;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WPLinkerIndexer {

    const OPTION_NAME = 'wplinker_terms_index';

    /**
     * Create an initial index of posts and terms when the plugin is activated.
     */
    public function create_initial_post_index() {
        $index = [];

        $args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1
        ];

        $query = new \WP_Query($args);

        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                $terms = $this->extract_terms_from_content(get_the_content());

                foreach ($terms as $term) {
                    $index[$term] = get_the_ID();
                }
            }
            wp_reset_postdata();
        }

        update_option(self::OPTION_NAME, $index);
    }

    /**
     * Update the index of posts and terms whenever a post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     * @param \WP_Post $post The post object.
     */
    public function update_post_index($post_id, $post) {
        if (wp_is_post_revision($post_id) || 'publish' !== $post->post_status) {
            return;
        }

        $index = get_option(self::OPTION_NAME, []);

        $terms = $this->extract_terms_from_content($post->post_content);

        foreach ($terms as $term) {
            $index[$term] = $post_id;
        }

        update_option(self::OPTION_NAME, $index);
    }

    /**
     * Retrieve the current index of terms to post IDs.
     *
     * @return array The index of terms to post IDs.
     */
    public function get_terms_index() {
        return get_option(self::OPTION_NAME, []);
    }

    /**
     * Extract terms from the post content. For now, we'll just extract words
     * longer than 5 characters as an example.
     *
     * @param string $content The post content.
     * @return array Extracted terms.
     */
    private function extract_terms_from_content($content) {
        preg_match_all('/\b\w{5,}\b/', $content, $matches);

        return $matches[0];
    }
}
