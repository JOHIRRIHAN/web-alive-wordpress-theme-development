<?php
function create_values_post_type() {
    register_post_type('values',
        array(
            'labels' => array(
                'name' => __('Values'),
                'singular_name' => __('Value'),
                'add_new_item' => __('Add New Value'),
                'edit_item' => __('Edit Value'),
                'new_item' => __('New Value'),
                'view_item' => __('View Value'),
                'search_items' => __('Search Values'),
                'not_found' => __('No Values found'),
                'not_found_in_trash' => __('No Values found in Trash')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-heart',
            'rewrite' => array('slug' => 'values'),
        )
    );
}
add_action('init', 'create_values_post_type');
function add_values_meta_boxes() {
    add_meta_box(
        'value_details',
        'Value Details',
        'render_values_meta_box',
        'values',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_values_meta_boxes');

function render_values_meta_box($post) {
    wp_nonce_field('save_values_details', 'values_nonce');

    $value_number = get_post_meta($post->ID, '_value_number', true);
    $value_icon_url = get_post_meta($post->ID, '_value_icon_url', true);
    $value_title = get_post_meta($post->ID, '_value_title', true); // New field
    $value_description = get_post_meta($post->ID, '_value_description', true); // New field
    ?>
    <p>
        <label for="value_number">Number</label>
        <input type="number" id="value_number" name="value_number" value="<?php echo esc_attr($value_number); ?>" class="widefat" />
    </p>
    <p>
        <label for="value_icon_url">Icon Image URL</label>
        <input type="text" id="value_icon_url" name="value_icon_url" value="<?php echo esc_url($value_icon_url); ?>" class="widefat" />
    </p>
    <p>
        <label for="value_title">Title</label>
        <input type="text" id="value_title" name="value_title" value="<?php echo esc_attr($value_title); ?>" class="widefat" />
    </p>
    <p>
        <label for="value_description">Description</label>
        <textarea id="value_description" name="value_description" rows="4" class="widefat"><?php echo esc_textarea($value_description); ?></textarea>
    </p>
    <?php
}


function save_values_details($post_id) {
    // Check nonce for security
    if (!isset($_POST['values_nonce']) || !wp_verify_nonce($_POST['values_nonce'], 'save_values_details')) {
        return;
    }

    // Prevent autosave from overwriting data
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (isset($_POST['post_type']) && 'values' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save fields
    if (isset($_POST['value_number'])) {
        update_post_meta($post_id, '_value_number', sanitize_text_field($_POST['value_number']));
    }
    if (isset($_POST['value_icon_url'])) {
        update_post_meta($post_id, '_value_icon_url', esc_url_raw($_POST['value_icon_url']));
    }
    if (isset($_POST['value_title'])) {
        update_post_meta($post_id, '_value_title', sanitize_text_field($_POST['value_title']));
    }
    if (isset($_POST['value_description'])) {
        update_post_meta($post_id, '_value_description', sanitize_textarea_field($_POST['value_description']));
    }
}
add_action('save_post', 'save_values_details');

