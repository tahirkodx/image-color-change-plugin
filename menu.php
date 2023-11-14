<?php

function custom_color_changer_menu()
{
    add_menu_page(
        'Color Changer',
        'Color Changer',
        'manage_options',
        'custom-color-changer-settings',
        'custom_color_changer_entries_page'
    );
    add_submenu_page(
        'custom-color-changer-settings',
        'All Colors',
        'All Colors',
        'manage_options',
        'custom-color-changer-settings',
        'custom_color_changer_entries_page'
    );
    // Add submenu for entries
    add_submenu_page(
        'custom-color-changer-settings',
        'Color Changer Entries',
        'Add New',
        'manage_options',
        'custom-color-changer-add-new',
        'custom_color_changer_page'
    );
    add_submenu_page(
        'custom-color-changer-edit',
        'Color Changer Entries',
        'Edit',
        'manage_options',
        'custom-color-changer-edit',
        'custom_color_changer_edit_page'
    );
}
add_action('admin_menu', 'custom_color_changer_menu');
