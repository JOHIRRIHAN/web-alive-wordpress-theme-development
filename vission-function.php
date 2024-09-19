<?php
function create_vision_mission_post_types() {
    // Register Vision Post Type
    register_post_type('vision',
        array(
            'labels' => array(
                'name' => __('Vision'),
                'singular_name' => __('Vision'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-visibility',
            'rewrite' => array('slug' => 'vision'),
        )
    );

    // Register Mission Post Type
    register_post_type('mission',
        array(
            'labels' => array(
                'name' => __('Mission'),
                'singular_name' => __('Mission'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-flag',
            'rewrite' => array('slug' => 'mission'),
        )
    );
}
add_action('init', 'create_vision_mission_post_types');

function add_vision_mission_meta_boxes() {
    add_meta_box(
        'vision_details',
        'Vision Details',
        'render_vision_meta_box',
        'vision',
        'normal',
        'high'
    );

    add_meta_box(
        'mission_details',
        'Mission Details',
        'render_mission_meta_box',
        'mission',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_vision_mission_meta_boxes');

function render_vision_meta_box($post) {
    wp_nonce_field('save_vision_details', 'vision_nonce');

    $vision_image_url = get_post_meta($post->ID, '_vision_image_url', true);
    $vision_content = get_post_meta($post->ID, '_vision_content', true);
    ?>
    <p>
        <label for="vision_image_url">Image URL</label>
        <input type="text" id="vision_image_url" name="vision_image_url" value="<?php echo esc_url($vision_image_url); ?>" class="widefat"/>
    </p>
    <p>
        <label for="vision_content">Content</label>
        <textarea id="vision_content" name="vision_content" rows="4" class="widefat"><?php echo esc_textarea($vision_content); ?></textarea>
    </p>
    <?php
}

function render_mission_meta_box($post) {
    wp_nonce_field('save_mission_details', 'mission_nonce');

    $mission_image_url = get_post_meta($post->ID, '_mission_image_url', true);
    $mission_content = get_post_meta($post->ID, '_mission_content', true);
    ?>
    <p>
        <label for="mission_image_url">Image URL</label>
        <input type="text" id="mission_image_url" name="mission_image_url" value="<?php echo esc_url($mission_image_url); ?>" class="widefat"/>
    </p>
    <p>
        <label for="mission_content">Content</label>
        <textarea id="mission_content" name="mission_content" rows="4" class="widefat"><?php echo esc_textarea($mission_content); ?></textarea>
    </p>
    <?php
}

function save_vision_mission_details($post_id) {
    // Check if our nonce is set.
    if (!isset($_POST['vision_nonce']) || !wp_verify_nonce($_POST['vision_nonce'], 'save_vision_details')) {
        return;
    }
    // Check if this is an autosave.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check user permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save Vision Post Meta
    if (get_post_type($post_id) === 'vision') {
        if (isset($_POST['vision_image_url'])) {
            update_post_meta($post_id, '_vision_image_url', esc_url_raw($_POST['vision_image_url']));
        }
        if (isset($_POST['vision_content'])) {
            update_post_meta($post_id, '_vision_content', sanitize_textarea_field($_POST['vision_content']));
        }
    }

    // Save Mission Post Meta
    if (get_post_type($post_id) === 'mission') {
        if (!isset($_POST['mission_nonce']) || !wp_verify_nonce($_POST['mission_nonce'], 'save_mission_details')) {
            return;
        }
        if (isset($_POST['mission_image_url'])) {
            update_post_meta($post_id, '_mission_image_url', esc_url_raw($_POST['mission_image_url']));
        }
        if (isset($_POST['mission_content'])) {
            update_post_meta($post_id, '_mission_content', sanitize_textarea_field($_POST['mission_content']));
        }
    }
}
add_action('save_post', 'save_vision_mission_details');
