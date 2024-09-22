<?php
// Register custom post type
function register_feature_box_post_type() {
    $labels = array(
        'name'               => 'Feature Boxes',
        'singular_name'      => 'Feature Box',
        'menu_name'          => 'Get all the advanced features',
        'name_admin_bar'     => 'Feature Box',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true,
        'supports'           => array('title'),
        'menu_icon'          => 'dashicons-format-image',
    );
    
    register_post_type('feature_box', $args);
}
add_action('init', 'register_feature_box_post_type');
function feature_box_custom_meta_boxes() {
    add_meta_box('feature_box_details', 'Feature Box Details', 'render_feature_box_meta_box', 'feature_box', 'normal', 'high');
}
add_action('add_meta_boxes', 'feature_box_custom_meta_boxes');

function render_feature_box_meta_box($post) {
    $image = get_post_meta($post->ID, '_feature_box_image', true);
    $heading = get_post_meta($post->ID, '_feature_box_heading', true);
    $paragraph = get_post_meta($post->ID, '_feature_box_paragraph', true);
    ?>
    <p>
        <label for="feature_box_image">Image URL:</label><br>
        <input type="text" id="feature_box_image" name="feature_box_image" value="<?php echo esc_attr($image); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="feature_box_heading">Heading:</label><br>
        <input type="text" id="feature_box_heading" name="feature_box_heading" value="<?php echo esc_attr($heading); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="feature_box_paragraph">Paragraph:</label><br>
        <textarea id="feature_box_paragraph" name="feature_box_paragraph" style="width:100%;" rows="4"><?php echo esc_textarea($paragraph); ?></textarea>
    </p>
    <?php
}

// Save the Meta Box Data
function save_feature_box_meta($post_id) {
    if (array_key_exists('feature_box_image', $_POST)) {
        update_post_meta($post_id, '_feature_box_image', sanitize_text_field($_POST['feature_box_image']));
    }
    if (array_key_exists('feature_box_heading', $_POST)) {
        update_post_meta($post_id, '_feature_box_heading', sanitize_text_field($_POST['feature_box_heading']));
    }
    if (array_key_exists('feature_box_paragraph', $_POST)) {
        update_post_meta($post_id, '_feature_box_paragraph', sanitize_textarea_field($_POST['feature_box_paragraph']));
    }
}
add_action('save_post', 'save_feature_box_meta');
