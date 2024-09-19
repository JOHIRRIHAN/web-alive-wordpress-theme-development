<?php
function webalive_register_web_design_service() {
    $labels = array(
        'name' => 'Web Design Services',
        'singular_name' => 'Web Design Service',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Web Design Service',
        'edit_item' => 'Edit Web Design Service',
        'new_item' => 'New Web Design Service',
        'view_item' => 'View Web Design Service',
        'search_items' => 'Search Web Design Services',
        'not_found' => 'No Web Design Services found',
        'not_found_in_trash' => 'No Web Design Services found in Trash',
        'all_items' => 'All Web Design Services',
        'menu_name' => 'Web Design Services',
        'name_admin_bar' => 'Web Design Service'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'web-design-services'),
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-admin-customizer',
    );

    register_post_type('web_design_service', $args);
}
add_action('init', 'webalive_register_web_design_service');
function webalive_add_service_meta_boxes() {
    add_meta_box(
        'service_meta_box', // ID
        'Web Design Service Details', // Title
        'webalive_service_meta_box_callback', // Callback function
        'web_design_service', // Post type
        'normal', // Context
        'high' // Priority
    );
}
add_action('add_meta_boxes', 'webalive_add_service_meta_boxes');

function webalive_service_meta_box_callback($post) {
    wp_nonce_field('webalive_save_service_meta_box_data', 'webalive_service_meta_box_nonce');

    $service_title = get_post_meta($post->ID, '_service_title', true);
    $service_paragraph = get_post_meta($post->ID, '_service_paragraph', true);
    $service_button_text = get_post_meta($post->ID, '_service_button_text', true);
    $service_button_url = get_post_meta($post->ID, '_service_button_url', true);
    $service_image = get_post_meta($post->ID, '_service_image', true);
    ?>

    <p>
        <label for="service_title">Title:</label>
        <input type="text" id="service_title" name="service_title" value="<?php echo esc_attr($service_title); ?>" size="50" />
    </p>

    <p>
        <label for="service_paragraph">Paragraph:</label>
        <textarea id="service_paragraph" name="service_paragraph" rows="4" cols="50"><?php echo esc_textarea($service_paragraph); ?></textarea>
    </p>

    <p>
        <label for="service_button_text">Button Text:</label>
        <input type="text" id="service_button_text" name="service_button_text" value="<?php echo esc_attr($service_button_text); ?>" size="50" />
    </p>

    <p>
        <label for="service_button_url">Button URL:</label>
        <input type="text" id="service_button_url" name="service_button_url" value="<?php echo esc_url($service_button_url); ?>" size="50" />
    </p>

    <p>
        <label for="service_image">Image:</label>
        <input type="hidden" id="service_image" name="service_image" value="<?php echo esc_url($service_image); ?>" />
        <img id="service_image_preview" src="<?php echo esc_url($service_image); ?>" style="max-width: 100%; height: auto;" />
        <br>
        <input type="button" id="upload_image_button" class="button" value="Upload Image" />
        <input type="button" id="remove_image_button" class="button" value="Remove Image" />
    </p>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var mediaUploader;
        $('#upload_image_button').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media({
                title: 'Select Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#service_image').val(attachment.url);
                $('#service_image_preview').attr('src', attachment.url);
            });
            mediaUploader.open();
        });

        $('#remove_image_button').click(function(e) {
            e.preventDefault();
            $('#service_image').val('');
            $('#service_image_preview').attr('src', '');
        });
    });
    </script>

    <?php
}

function webalive_save_service_meta_box_data($post_id) {
    if (!isset($_POST['webalive_service_meta_box_nonce']) || !wp_verify_nonce($_POST['webalive_service_meta_box_nonce'], 'webalive_save_service_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (array_key_exists('service_title', $_POST)) {
        update_post_meta($post_id, '_service_title', sanitize_text_field($_POST['service_title']));
    }
    if (array_key_exists('service_paragraph', $_POST)) {
        update_post_meta($post_id, '_service_paragraph', sanitize_textarea_field($_POST['service_paragraph']));
    }
    if (array_key_exists('service_button_text', $_POST)) {
        update_post_meta($post_id, '_service_button_text', sanitize_text_field($_POST['service_button_text']));
    }
    if (array_key_exists('service_button_url', $_POST)) {
        update_post_meta($post_id, '_service_button_url', esc_url_raw($_POST['service_button_url']));
    }
    if (array_key_exists('service_image', $_POST)) {
        update_post_meta($post_id, '_service_image', esc_url_raw($_POST['service_image']));
    }
}
add_action('save_post', 'webalive_save_service_meta_box_data');
