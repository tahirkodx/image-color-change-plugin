<?php

function get_old_category_ids()
{
    global $wpdb;
    $table_name = $wpdb->prefix.'custom_color_changer';
    $old_category_ids = $wpdb->get_col("SELECT category_ids FROM $table_name");

    return $old_category_ids;
}
