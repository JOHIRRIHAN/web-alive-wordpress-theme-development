<?php
// Register Custom Post Type for Projects
function create_project_post_type() {
    register_post_type('project',
        array(
            'labels' => array(
                'name' => __('Featured Projects'),
                'singular_name' => __('Project'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-portfolio',
            'rewrite' => array('slug' => 'projects'),
        )
    );
}
add_action('init', 'create_project_post_type');
// Add Meta Boxes for Custom Fields
function add_project_meta_boxes() {
    add_meta_box(
        'project_details',
        'Project Details',
        'render_project_meta_box',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_boxes');

// Render Meta Box Content
function render_project_meta_box($post) {
    wp_nonce_field('save_project_details', 'project_details_nonce');

    // Retrieve existing values
    $project_heading = get_post_meta($post->ID, '_project_heading', true);
    $project_paragraph = get_post_meta($post->ID, '_project_paragraph', true);
    $project_image_url = get_post_meta($post->ID, '_project_image_url', true);
    ?>
    <p>
        <label for="project_heading">Project Heading</label>
        <input type="text" id="project_heading" name="project_heading" value="<?php echo esc_attr($project_heading); ?>" class="widefat"/>
    </p>
    <p>
        <label for="project_paragraph">Project Paragraph</label>
        <textarea id="project_paragraph" name="project_paragraph" rows="4" class="widefat"><?php echo esc_textarea($project_paragraph); ?></textarea>
    </p>
    <p>
        <label for="project_image_url">Project Image URL</label>
        <input type="text" id="project_image_url" name="project_image_url" value="<?php echo esc_attr($project_image_url); ?>" class="widefat"/>
    </p>
    <?php
}

// Save Meta Box Content
function save_project_details($post_id) {
    if (!isset($_POST['project_details_nonce']) || !wp_verify_nonce($_POST['project_details_nonce'], 'save_project_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['project_heading'])) {
        update_post_meta($post_id, '_project_heading', sanitize_text_field($_POST['project_heading']));
    }
    if (isset($_POST['project_paragraph'])) {
        update_post_meta($post_id, '_project_paragraph', sanitize_textarea_field($_POST['project_paragraph']));
    }
    if (isset($_POST['project_image_url'])) {
        update_post_meta($post_id, '_project_image_url', esc_url_raw($_POST['project_image_url']));
    }
}
add_action('save_post', 'save_project_details');

?>
