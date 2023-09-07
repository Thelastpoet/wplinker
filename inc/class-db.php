<?php

// Class to handle database operations

namespace WPLinker;

class WPLinkerDb {

    // Table name
    private $table_name;

    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'wplinker_data';
    }

    /**
     * Create the custom table during plugin activation.
     */
    public function create_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->table_name} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            post_id mediumint(9) NOT NULL,
            term varchar(255) NOT NULL,
            link varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    /**
     * Remove the custom table during plugin deactivation.
     */
    public function drop_table() {
        global $wpdb;
        $sql = "DROP TABLE IF EXISTS {$this->table_name};";
        $wpdb->query($sql);
    }

    /**
     * Insert new data into the custom table.
     */
    public function insert_data($post_id, $term, $link) {
        global $wpdb;
        $wpdb->insert(
            $this->table_name,
            [
                'post_id' => $post_id,
                'term'    => $term,
                'link'    => $link,
            ]
        );
    }

    /**
     * Get all data for display in the WordPress admin.
     */
    public function get_all_data() {
        global $wpdb;
        $sql = "SELECT * FROM {$this->table_name};";
        return $wpdb->get_results($sql);
    }
}
