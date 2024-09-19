<?php
// Register Custom Post Type for Services
function create_services_post_type() {
    register_post_type('service',
        array(
            'labels' => array(
                'name' => __('Services'),
                'singular_name' => __('Service'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-admin-tools',
            'rewrite' => array('slug' => 'services'),
        )
    );
}
add_action('init', 'create_services_post_type');

// Add Custom Meta Boxes
function add_custom_meta_boxes() {
    add_meta_box(
        'service_details',
        'Service Details',
        'render_service_details_meta_box',
        'service',
        'normal',
        'high'
    );
    add_meta_box(
        'service_image',
        'Service Image',
        'render_service_image_meta_box',
        'service',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');

// Render Meta Box Content
function render_service_details_meta_box($post) {
    wp_nonce_field('save_service_details', 'service_details_nonce');

    $button_text = get_post_meta($post->ID, '_service_button_text', true);
    $button_url = get_post_meta($post->ID, '_service_button_url', true);
    ?>

    <p>
        <label for="service_button_text">Button Text</label>
        <input type="text" id="service_button_text" name="service_button_text" value="<?php echo esc_attr($button_text); ?>" />
    </p>
    <p>
        <label for="service_button_url">Button URL</label>
        <input type="text" id="service_button_url" name="service_button_url" value="<?php echo esc_url($button_url); ?>" />
    </p>

    <?php
}

function render_service_image_meta_box($post) {
    wp_nonce_field('save_service_image', 'service_image_nonce');

    $image_id = get_post_meta($post->ID, '_service_image_id', true);
    $image_url = $image_id ? wp_get_attachment_image_src($image_id, 'thumbnail')[0] : '';

    ?>

    <p>
        <label for="service_image">Service Image</label>
        <input type="hidden" id="service_image_id" name="service_image_id" value="<?php echo esc_attr($image_id); ?>" />
        <img id="service_image_preview" src="<?php echo esc_url($image_url); ?>" style="max-width:100%;" />
        <button type="button" class="button" id="upload_image_button">Upload Image</button>
        <button type="button" class="button" id="remove_image_button">Remove Image</button>
    </p>

    <script>
        jQuery(document).ready(function($) {
            var frame;
            $('#upload_image_button').on('click', function(e) {
                e.preventDefault();
                if (frame) {
                    frame.open();
                    return;
                }
                frame = wp.media({
                    title: 'Select or Upload an Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('#service_image_id').val(attachment.id);
                    $('#service_image_preview').attr('src', attachment.url).show();
                });
                frame.open();
            });
            $('#remove_image_button').on('click', function(e) {
                e.preventDefault();
                $('#service_image_id').val('');
                $('#service_image_preview').attr('src', '').hide();
            });
        });
    </script>

    <?php
}

// Save Custom Meta Box Data
function save_service_details($post_id) {
    if (!isset($_POST['service_details_nonce']) || !wp_verify_nonce($_POST['service_details_nonce'], 'save_service_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['service_button_text'])) {
        update_post_meta($post_id, '_service_button_text', sanitize_text_field($_POST['service_button_text']));
    }

    if (isset($_POST['service_button_url'])) {
        update_post_meta($post_id, '_service_button_url', esc_url_raw($_POST['service_button_url']));
    }
}
add_action('save_post', 'save_service_details');

function save_service_image($post_id) {
    if (!isset($_POST['service_image_nonce']) || !wp_verify_nonce($_POST['service_image_nonce'], 'save_service_image')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['service_image_id'])) {
        update_post_meta($post_id, '_service_image_id', intval($_POST['service_image_id']));
    }
}
add_action('save_post', 'save_service_image');
?>
