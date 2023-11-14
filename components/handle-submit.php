<?php

function handle_custom_color_changer_actions()
{
    if (isset($_GET['page']) && $_GET['page'] === 'custom-color-changer-settings') {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];

            if ($action === 'add-new') {
                // Handle "Add New" action
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                    // Form is submitted, save the new record
                    save_custom_color_changer_record();

                    // Redirect to the main settings page after saving
                    wp_redirect(admin_url('admin.php?page=custom-color-changer-settings'));
                    exit;
                } else {
                    // Display the "Add New" page
                    wp_redirect(admin_url('admin.php?page=custom-color-changer-add-new'));  // Replace with your actual file name
                    exit;
                }

                // Display the "Add New" page
                // include 'add-new-page.php';  // Replace with your actual file name
                exit;
            }
            // elseif ($action === 'edit') {
            //     // Handle "Edit" action
            //     // Redirect to the edit page or add your logic here
            //     wp_redirect(admin_url('admin.php?page=custom-color-changer-settings&action=edit&id='.$_GET['id']));
            //     exit;
            // }
            elseif ($action === 'delete') {
                // Handle "Delete" action
                // Add your delete logic here
                global $wpdb;
                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                if ($id > 0) {
                    $wpdb->delete($wpdb->prefix.'custom_color_changer', ['id' => $id]);
                }
                wp_redirect(admin_url('admin.php?page=custom-color-changer-settings'));
                exit;
            }
        }
    }
}

add_action('admin_init', 'handle_custom_color_changer_actions');

function save_custom_color_changer_record()
{
    global $wpdb;

    $category_ids = isset($_POST['category_ids']) ? implode(',', array_map('intval', $_POST['category_ids'])) : '';
    $hue_rotate_values = isset($_POST['hue_rotate_values']) ? implode(',', array_map('intval', $_POST['hue_rotate_values'])) : '';

    $data = [
        'category_ids' => $category_ids,
        'hue_rotate_values' => $hue_rotate_values,
    ];

    $wpdb->insert($wpdb->prefix.'custom_color_changer', $data);
}