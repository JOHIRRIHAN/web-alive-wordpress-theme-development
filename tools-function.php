<?php
function create_tools_post_type() {
    register_post_type('tools',
        array(
            'labels' => array(
                'name' => __('Tools & Technologies'),
                'singular_name' => __('Tool'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'thumbnail'),
            'menu_icon' => 'dashicons-admin-tools',
            'rewrite' => array('slug' => 'tools'),
        )
    );
}
add_action('init', 'create_tools_post_type');
function add_tools_meta_boxes() {
    add_meta_box(
        'tool_details',
        'Tool Details',
        'render_tool_meta_box',
        'tools',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_tools_meta_boxes');

function render_tool_meta_box($post) {
    wp_nonce_field('save_tool_details', 'tool_nonce');

    $tool_image_url = get_post_meta($post->ID, '_tool_image_url', true);
    ?>
    <p>
        <label for="tool_image_url">Tool Image URL</label>
        <input type="text" id="tool_image_url" name="tool_image_url" value="<?php echo esc_url($tool_image_url); ?>" class="widefat"/>
    </p>
    <?php
}
function save_tool_details($post_id) {
    // Verify nonce
    if (!isset($_POST['tool_nonce']) || !wp_verify_nonce($_POST['tool_nonce'], 'save_tool_details')) {
        return;
    }

    // Prevent autosave from overwriting data
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (isset($_POST['post_type']) && 'tools' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    // Save fields
    if (isset($_POST['tool_image_url'])) {
        update_post_meta($post_id, '_tool_image_url', esc_url_raw($_POST['tool_image_url']));
    }
}
add_action('save_post', 'save_tool_details');
