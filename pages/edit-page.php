<?php
function custom_color_changer_edit_page()
{
    if (isset($_GET['page']) && $_GET['page'] === 'custom-color-changer-edit') {
        // Get the entry ID from the query parameter
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Get the entry data from the database
        global $wpdb;
        $entry = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}custom_color_changer WHERE id = {$id}");

        // Check if the entry exists
        if (!$entry) {
            wp_redirect(admin_url('admin.php?page=custom-color-changer-settings'));
        }
        if (isset($_GET['action'])) {
            global $wpdb;
            $action = $_GET['action'];
            if ($action === 'edit-data') {
                // Handle form submission
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                    // Sanitize and validate form data
                    $category_ids = isset($_POST['category_ids']) ? implode(',', array_map('intval', $_POST['category_ids'])) : '';
                    $hue_rotate_values = isset($_POST['hue_rotate_values']) ? implode(',', array_map('intval', $_POST['hue_rotate_values'])) : '';

                    // Update the entry in the database
                    $wpdb->update(
                        $wpdb->prefix.'custom_color_changer',
                        [
                            'category_ids' => $category_ids,
                            'hue_rotate_values' => $hue_rotate_values,
                        ],
                        ['id' => $id],
                        ['%s', '%s'],
                        ['%d']
                    );

                    // Redirect back to the main settings page after updating
                    wp_redirect(admin_url('admin.php?page=custom-color-changer-settings'));
                    exit;
                }
            }
        }
        ?>

<div class="wrap">
    <h1>Edit Color Changer Entry</h1>
    <form method="post" action="">
        <?php
            // Fetch WooCommerce product categories
            $categories = get_terms('product_cat', ['hide_empty' => false]);
        $selected_category_ids = explode(',', $entry->category_ids);
        ?>
        <label for="category_ids">Select Product Categories:</label>
        <select name="category_ids[]" id="category_ids" multiple class="select2">
            <?php foreach ($categories as $category) { ?>
            <option value="<?php echo esc_attr($category->term_id); ?>"
                <?php echo in_array($category->term_id, $selected_category_ids) ? 'selected' : ''; ?>>
                <?php echo esc_html($category->name); ?>
            </option>
            <?php } ?>
        </select>
        <br>

        <label for="hue_rotate_values">Select Hue-Rotate Values:</label>
        <select name="hue_rotate_values[]" id="hue_rotate_values" multiple>
            <?php for ($i = 0; $i <= 360; $i += 10) { ?>
            <option value="<?php echo esc_attr($i); ?>"
                <?php echo in_array($i, explode(',', $entry->hue_rotate_values)) ? 'selected' : ''; ?>>
                <?php echo esc_html($i); ?></option>
            <?php } ?>
        </select>
        <br>

        <?php submit_button('Update Entry', 'primary', 'submit'); ?>
    </form>
</div>

<script>
jQuery(document).ready(function($) {
    // Initialize Select2 for category selection
    $('#category_ids').select2();
});
</script>
<?php

    }
}