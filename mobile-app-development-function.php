<?php
function create_mobile_app_post_type() {
    register_post_type('mobile_app',
        array(
            'labels' => array(
                'name' => __('Mobile Apps'),
                'singular_name' => __('Mobile App'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'menu_icon' => 'dashicons-smartphone', // Change the icon as needed
            'rewrite' => array('slug' => 'mobile-apps'),
        )
    );
}
add_action('init', 'create_mobile_app_post_type');
function add_mobile_app_meta_boxes() {
    add_meta_box(
        'mobile_app_details',
        'Mobile App Details',
        'render_mobile_app_meta_box',
        'mobile_app',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_mobile_app_meta_boxes');

function render_mobile_app_meta_box($post) {
    // Retrieve existing values from the database
    $image = get_post_meta($post->ID, '_mobile_app_image', true);
    $heading = get_post_meta($post->ID, '_mobile_app_heading', true);
    $paragraph = get_post_meta($post->ID, '_mobile_app_paragraph', true);
    $button_url = get_post_meta($post->ID, '_mobile_app_button_url', true);

    // HTML for input fields
    ?>
    <label for="mobile_app_image">Image URL:</label>
    <input type="text" name="mobile_app_image" id="mobile_app_image" value="<?php echo esc_attr($image); ?>" style="width: 100%;" />
    
    <label for="mobile_app_heading">Heading:</label>
    <input type="text" name="mobile_app_heading" id="mobile_app_heading" value="<?php echo esc_attr($heading); ?>" style="width: 100%;" />
    
    <label for="mobile_app_paragraph">Paragraph:</label>
    <textarea name="mobile_app_paragraph" id="mobile_app_paragraph" rows="4" style="width: 100%;"><?php echo esc_textarea($paragraph); ?></textarea>
    
    <label for="mobile_app_button_url">Button URL:</label>
    <input type="text" name="mobile_app_button_url" id="mobile_app_button_url" value="<?php echo esc_attr($button_url); ?>" style="width: 100%;" />
    <?php
}

function save_mobile_app_meta($post_id) {
    if (array_key_exists('mobile_app_image', $_POST)) {
        update_post_meta($post_id, '_mobile_app_image', sanitize_text_field($_POST['mobile_app_image']));
    }
    if (array_key_exists('mobile_app_heading', $_POST)) {
        update_post_meta($post_id, '_mobile_app_heading', sanitize_text_field($_POST['mobile_app_heading']));
    }
    if (array_key_exists('mobile_app_paragraph', $_POST)) {
        update_post_meta($post_id, '_mobile_app_paragraph', sanitize_textarea_field($_POST['mobile_app_paragraph']));
    }
    if (array_key_exists('mobile_app_button_url', $_POST)) {
        update_post_meta($post_id, '_mobile_app_button_url', sanitize_text_field($_POST['mobile_app_button_url']));
    }
}
add_action('save_post', 'save_mobile_app_meta');
