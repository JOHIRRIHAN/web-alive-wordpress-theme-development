<?php
function create_recent_project_post_type() {
    register_post_type('recent_project',
        array(
            'labels' => array(
                'name' => __('Recent Projects'),
                'singular_name' => __('Recent Project'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-portfolio',
            'rewrite' => array('slug' => 'projects'),
        )
    );
}
add_action('init', 'create_recent_project_post_type');

function add_recent_project_meta_boxes() {
    add_meta_box(
        'project_details',
        'Project Details',
        'render_recent_project_meta_box',
        'recent_project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_recent_project_meta_boxes');

// Enqueue the media uploader scripts in the admin area
function enqueue_admin_scripts() {
    wp_enqueue_media(); // Enqueue media uploader scripts
}
add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');

// Render Meta Box Content
function render_recent_project_meta_box($post) {
    wp_nonce_field('save_project_details', 'project_details_nonce');

    // Retrieve existing values
    $project_category = get_post_meta($post->ID, '_project_category', true);
    $project_title = get_post_meta($post->ID, '_project_title', true);
    $project_description = get_post_meta($post->ID, '_project_description', true);
    $project_technology = get_post_meta($post->ID, '_project_technology', true);
    $project_industry = get_post_meta($post->ID, '_project_industry', true);
    $project_button_text = get_post_meta($post->ID, '_project_button_text', true);
    $project_image_id = get_post_meta($post->ID, '_project_image_id', true); // Retrieve the image ID

    $project_image_url = $project_image_id ? wp_get_attachment_url($project_image_id) : ''; // Get the image URL if available
    ?>

    <!-- Existing Fields Here -->
    <p>
        <label for="project_category">Category</label>
        <input type="text" id="project_category" name="project_category" value="<?php echo esc_attr($project_category); ?>" class="widefat"/>
    </p>
    <p>
        <label for="project_title">Title</label>
        <input type="text" id="project_title" name="project_title" value="<?php echo esc_attr($project_title); ?>" class="widefat"/>
    </p>
    <p>
        <label for="project_description">Description</label>
        <textarea id="project_description" name="project_description" rows="4" class="widefat"><?php echo esc_textarea($project_description); ?></textarea>
    </p>
    <p>
        <label for="project_technology">Technology</label>
        <input type="text" id="project_technology" name="project_technology" value="<?php echo esc_attr($project_technology); ?>" class="widefat"/>
    </p>
    <p>
        <label for="project_industry">Industry</label>
        <input type="text" id="project_industry" name="project_industry" value="<?php echo esc_attr($project_industry); ?>" class="widefat"/>
    </p>
    <p>
        <label for="project_button_text">Button Text</label>
        <input type="text" id="project_button_text" name="project_button_text" value="<?php echo esc_attr($project_button_text); ?>" class="widefat"/>
    </p>

    <!-- Add Image Upload Field -->
    <p>
        <label for="project_image">Project Image</label><br>
        <input type="hidden" id="project_image_id" name="project_image_id" value="<?php echo esc_attr($project_image_id); ?>" />
        <input type="button" id="upload_image_button" class="button" value="Upload Image" />
        <img id="project_image_preview" src="<?php echo esc_url($project_image_url); ?>" style="max-width: 100%; margin-top: 10px; <?php echo $project_image_url ? '' : 'display:none;'; ?>" />
    </p>

    <script>
    jQuery(document).ready(function($){
        $('#upload_image_button').click(function(e) {
            e.preventDefault();

            var image_frame;
            if (image_frame) {
                image_frame.open();
                return;
            }

            image_frame = wp.media({
                title: 'Select Image',
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            image_frame.on('select', function() {
                var selection = image_frame.state().get('selection').first().toJSON();
                $('#project_image_id').val(selection.id);
                $('#project_image_preview').attr('src', selection.url).show();
            });

            image_frame.open();
        });
    });
    </script>
    <?php
}

// Save Meta Box Content
function save_recent_project_details($post_id) {
    if (!isset($_POST['project_details_nonce']) || !wp_verify_nonce($_POST['project_details_nonce'], 'save_project_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save Existing Fields
    if (isset($_POST['project_category'])) {
        update_post_meta($post_id, '_project_category', sanitize_text_field($_POST['project_category']));
    }
    if (isset($_POST['project_title'])) {
        update_post_meta($post_id, '_project_title', sanitize_text_field($_POST['project_title']));
    }
    if (isset($_POST['project_description'])) {
        update_post_meta($post_id, '_project_description', sanitize_textarea_field($_POST['project_description']));
    }
    if (isset($_POST['project_technology'])) {
        update_post_meta($post_id, '_project_technology', sanitize_text_field($_POST['project_technology']));
    }
    if (isset($_POST['project_industry'])) {
        update_post_meta($post_id, '_project_industry', sanitize_text_field($_POST['project_industry']));
    }
    if (isset($_POST['project_button_text'])) {
        update_post_meta($post_id, '_project_button_text', sanitize_text_field($_POST['project_button_text']));
    }

    // Save the image ID
    if (isset($_POST['project_image_id'])) {
        update_post_meta($post_id, '_project_image_id', sanitize_text_field($_POST['project_image_id']));
    }
}
add_action('save_post', 'save_recent_project_details');
?>
