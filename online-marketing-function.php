<?php
// Register Custom Post Type for Online Marketing
function create_online_marketing_post_type() {
    $labels = array(
        'name'               => 'Online Marketing',
        'singular_name'      => 'Online Marketing',
        'menu_name'          => 'Online Marketing',
        'name_admin_bar'     => 'Online Marketing',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Online Marketing',
        'new_item'           => 'New Online Marketing',
        'edit_item'          => 'Edit Online Marketing',
        'view_item'          => 'View Online Marketing',
        'all_items'          => 'All Online Marketing',
        'search_items'       => 'Search Online Marketing',
        'not_found'          => 'No Online Marketing found.',
        'not_found_in_trash' => 'No Online Marketing found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('online_marketing', $args);
}
add_action('init', 'create_online_marketing_post_type');

// Add Custom Meta Boxes for Online Marketing
function add_online_marketing_meta_boxes() {
    add_meta_box(
        'online_marketing_details',
        'Online Marketing Details',
        'render_online_marketing_meta_box',
        'online_marketing',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_online_marketing_meta_boxes');

// Render the Meta Box
function render_online_marketing_meta_box($post) {
    $image = get_post_meta($post->ID, '_online_marketing_image', true);
    $heading = get_post_meta($post->ID, '_online_marketing_heading', true);
    $paragraph = get_post_meta($post->ID, '_online_marketing_paragraph', true);
    $button_url = get_post_meta($post->ID, '_online_marketing_button_url', true);
    ?>
    <label for="online_marketing_image">Image URL:</label>
    <input type="text" id="online_marketing_image" name="online_marketing_image" value="<?php echo esc_attr($image); ?>" class="widefat" />
    
    <label for="online_marketing_heading">Heading:</label>
    <input type="text" id="online_marketing_heading" name="online_marketing_heading" value="<?php echo esc_attr($heading); ?>" class="widefat" />

    <label for="online_marketing_paragraph">Paragraph:</label>
    <textarea id="online_marketing_paragraph" name="online_marketing_paragraph" class="widefat"><?php echo esc_textarea($paragraph); ?></textarea>

    <label for="online_marketing_button_url">Button URL:</label>
    <input type="text" id="online_marketing_button_url" name="online_marketing_button_url" value="<?php echo esc_attr($button_url); ?>" class="widefat" />
    <?php
}

// Save Custom Meta Box Data
function save_online_marketing_meta_data($post_id) {
    if (array_key_exists('online_marketing_image', $_POST)) {
        update_post_meta($post_id, '_online_marketing_image', sanitize_text_field($_POST['online_marketing_image']));
    }
    if (array_key_exists('online_marketing_heading', $_POST)) {
        update_post_meta($post_id, '_online_marketing_heading', sanitize_text_field($_POST['online_marketing_heading']));
    }
    if (array_key_exists('online_marketing_paragraph', $_POST)) {
        update_post_meta($post_id, '_online_marketing_paragraph', sanitize_textarea_field($_POST['online_marketing_paragraph']));
    }
    if (array_key_exists('online_marketing_button_url', $_POST)) {
        update_post_meta($post_id, '_online_marketing_button_url', sanitize_text_field($_POST['online_marketing_button_url']));
    }
}
add_action('save_post', 'save_online_marketing_meta_data');
