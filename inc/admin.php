<?php

namespace WPLinker;

class WPLinkerAdmin {

    public function init() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'WPLinker',
            'WPLinker',
            'manage_options',
            'wplinker',
            [$this, 'display_admin_page']
        );
    }

    public function display_admin_page() {
        require_once WPLINKER_PLUGIN_DIR . 'inc/class-wplinker-list-table.php';
        $list_table = new WPLinkerListTable();
        $list_table->prepare_items();
        echo '<div class="wrap">';
        echo '<h2>WPLinker Posts</h2>';
        $list_table->display();
        echo '</div>';
    }
}
