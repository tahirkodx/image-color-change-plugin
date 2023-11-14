<?php
function custom_color_changer_entries_page()
{
    ?>

<div class="wrap">
    <h1 id="title-color-changer-table">Color Changer Entries</h1>
    <a href="?page=custom-color-changer-add-new" class="page-title-action">Add New</a>
    <br><br>
    <table id="colorChangerTable" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Categories</th>
                <th scope="col">Hue-Rotate Values</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                        global $wpdb;
    $entries = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}custom_color_changer");
    foreach ($entries as $entry) {
        echo '<tr>';
        echo '<td>'.esc_html($entry->id).'</td>';
        echo '<td class="category-label">';
        $categoryIds = explode(',', $entry->category_ids);
        foreach ($categoryIds as $categoryId) {
            $category = get_term($categoryId, 'product_cat');
            if ($category && !is_wp_error($category)) {
                echo '<span class="label-value" >'.esc_html($category->name).'</span>';
            }
        }
        echo '</td>';
        echo '<td>';
        $hueRotateValues = explode(',', $entry->hue_rotate_values);
        foreach ($hueRotateValues as $value) {
            echo '<span id="color-circle" style="background: hsl('.$value.', 100%, 50%);" title="'.$value.'">';
            echo '<span id="circle-value">'.$value.'</span>';
            echo '</span>';
        }
        echo '</td>';
        echo '<td>';
        echo '<a href="?page=custom-color-changer-edit&action=edit-data&id='.esc_attr($entry->id).'">Edit</a> | ';
        echo '<a href="?page=custom-color-changer-settings&action=delete&id='.esc_attr($entry->id).'" onclick="return confirm(\'Are you sure you want to delete this entry?\')">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    ?>
        </tbody>
    </table>
</div>

<script>
jQuery(document).ready(function($) {
    // Initialize DataTables for the table with search and sorting
    $('#colorChangerTable').DataTable({
        searching: true, // Enable search
        ordering: true, // Enable sorting
        order: [
            [0, 'asc']
        ], // Sort by the first column in ascending order by default
    });
});
</script>
<?php
}