<?php
// Add this to your main plugin file
function custom_color_changer_page()
{
    ?>
<div class="wrap">
    <h1>Image Color Changer Settings</h1>
    <form method="post" action="?page=custom-color-changer-settings&action=add-new">
        <?php
            // Fetch WooCommerce product categories
            $categories = get_terms('product_cat', ['hide_empty' => false]);
    if ($categories) {
        ?>
        <label for="category_ids">Select Product Categories:</label>
        <select name="category_ids[]" id="category_ids" multiple class="select2">
            <?php
            $selectedCategoryIds = explode(',', $entry->category_ids);

        foreach ($categories as $category) {
            $termId = $category->term_id;

            // Check if the category term ID is not in the selected category IDs
            if (!in_array($termId, $selectedCategoryIds)) {
                // Check if the category is a top-level category (has no parent)
                if ($category->parent == 0) {
                    ?>
            <option value="<?php echo esc_attr($termId); ?>">
                <?php echo esc_html($category->name); ?>
            </option>
            <?php
                }
            }
        }
        ?>
        </select>
        <br>

        <?php } ?>

        <label for="hue_rotate_values">Select Hue-Rotate Values:</label>
        <select name="hue_rotate_values[]" id="hue_rotate_values" multiple>
            <?php for ($i = 0; $i <= 360; $i += 10) { ?>
            <option value="<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></option>
            <?php } ?>
        </select>
        <br>

        <?php submit_button('Save Settings', 'primary', 'submit'); ?>
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