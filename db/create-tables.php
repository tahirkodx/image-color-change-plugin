<?php

// Add activation and deactivation hooks if needed
register_activation_hook(__FILE__, 'custom_color_changer_activate');
// register_deactivation_hook(__FILE__, 'custom_color_changer_deactivate');

// Activation hook function (create database table if not exists)
function custom_color_changer_activate()
{
    global $wpdb;
    $table_name = $wpdb->prefix.'custom_color_changer';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        category_ids text NOT NULL,
        hue_rotate_values text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once ABSPATH.'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

// Deactivation hook function (delete database table if needed)
// function custom_color_changer_deactivate()
// {
//     // Uncomment the following lines if you want to delete the database table on deactivation
//     // global $wpdb;
//     // $table_name = $wpdb->prefix . 'custom_color_changer';
//     // $wpdb->query("DROP TABLE IF EXISTS $table_name");
// }
