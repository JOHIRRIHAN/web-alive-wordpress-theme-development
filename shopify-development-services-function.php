<?php
function create_shopify_web_design_cpt() {
    $labels = array(
        'name' => 'Shopify Web Design',
        'singular_name' => 'Shopify Web Design',
        'menu_name' => 'Shopify Web Design',
        'name_admin_bar' => 'Shopify Web Design',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Shopify Web Design',
        'new_item' => 'New Shopify Web Design',
        'edit_item' => 'Edit Shopify Web Design',
        'view_item' => 'View Shopify Web Design',
        'all_items' => 'All Shopify Web Design',
        'search_items' => 'Search Shopify Web Design',
        'not_found' => 'No Shopify Web Designs found.',
        'not_found_in_trash' => 'No Shopify Web Designs found in Trash.'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-site-alt3',
        'show_in_rest' => true,
    );

    register_post_type('shopify_web_design', $args);
}
add_action('init', 'create_shopify_web_design_cpt');
function shopify_web_design_custom_meta() {
    add_meta_box('shopify_web_design_meta', 'Shopify Web Design Details', 'shopify_web_design_meta_callback', 'shopify_web_design', 'normal', 'high');
}
add_action('add_meta_boxes', 'shopify_web_design_custom_meta');

function shopify_web_design_meta_callback($post) {
    $image = get_post_meta($post->ID, '_shopify_web_design_image', true);
    $heading = get_post_meta($post->ID, '_shopify_web_design_heading', true);
    $paragraph = get_post_meta($post->ID, '_shopify_web_design_paragraph', true);
    $button_url = get_post_meta($post->ID, '_shopify_web_design_button_url', true);

    ?>
    <p>
        <label for="shopify_web_design_image">Image URL:</label><br>
        <input type="text" name="shopify_web_design_image" id="shopify_web_design_image" value="<?php echo esc_attr($image); ?>" class="widefat">
    </p>
    <p>
        <label for="shopify_web_design_heading">Heading:</label><br>
        <input type="text" name="shopify_web_design_heading" id="shopify_web_design_heading" value="<?php echo esc_attr($heading); ?>" class="widefat">
    </p>
    <p>
        <label for="shopify_web_design_paragraph">Paragraph:</label><br>
        <textarea name="shopify_web_design_paragraph" id="shopify_web_design_paragraph" rows="5" class="widefat"><?php echo esc_textarea($paragraph); ?></textarea>
    </p>
    <p>
        <label for="shopify_web_design_button_url">Button URL:</label><br>
        <input type="text" name="shopify_web_design_button_url" id="shopify_web_design_button_url" value="<?php echo esc_attr($button_url); ?>" class="widefat">
    </p>
    <?php
}

function save_shopify_web_design_meta($post_id) {
    if (isset($_POST['shopify_web_design_image'])) {
        update_post_meta($post_id, '_shopify_web_design_image', sanitize_text_field($_POST['shopify_web_design_image']));
    }
    if (isset($_POST['shopify_web_design_heading'])) {
        update_post_meta($post_id, '_shopify_web_design_heading', sanitize_text_field($_POST['shopify_web_design_heading']));
    }
    if (isset($_POST['shopify_web_design_paragraph'])) {
        update_post_meta($post_id, '_shopify_web_design_paragraph', sanitize_textarea_field($_POST['shopify_web_design_paragraph']));
    }
    if (isset($_POST['shopify_web_design_button_url'])) {
        update_post_meta($post_id, '_shopify_web_design_button_url', sanitize_text_field($_POST['shopify_web_design_button_url']));
    }
}
add_action('save_post', 'save_shopify_web_design_meta');
