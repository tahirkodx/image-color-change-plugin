<?php

// Add this to your main plugin file
function custom_image_color_changer_enqueue_scripts()
{
    // Enqueue Select2 library
    wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.0/js/select2.min.js', ['jquery'], '4.1.0-beta.0', true);
    wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.0/css/select2.min.css', [], '4.1.0-beta.0');

    // Enqueue DataTables library
    wp_enqueue_script('datatables', 'https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js', ['jquery'], '1.10.24', true);
    wp_enqueue_style('datatables', 'https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css', [], '1.10.24');

    wp_enqueue_style('custom-color-changer-front-styles', plugin_dir_url(__FILE__).'../assets/css/custom-color-changer.css');
}
add_action('admin_enqueue_scripts', 'custom_image_color_changer_enqueue_scripts');

// Enqueue custom JavaScript file
function custom_color_change_enqueue_scripts()
{
    if (is_product()) {
        wp_enqueue_script('custom-color-change-script', plugin_dir_url(__FILE__).'../assets/js/custom-color-changer.js', ['jquery'], '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'custom_color_change_enqueue_scripts');
