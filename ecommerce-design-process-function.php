<?php
// Register Custom Post Type for Ecommerce Design Process
function create_ecommerce_design_process_post_type() {
    register_post_type('ecommerce_process',
        array(
            'labels'      => array(
                'name'          => __('Ecommerce Design Process'),
                'singular_name' => __('Ecommerce Design Process Slide'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor', 'thumbnail'),
            'menu_icon'   => 'dashicons-clipboard',
        )
    );
}
add_action('init', 'create_ecommerce_design_process_post_type');

// Add Custom Meta Fields
function ecommerce_process_meta_box() {
    add_meta_box('ecommerce_process_meta', 'Slide Details', 'ecommerce_process_meta_callback', 'ecommerce_process');
}

function ecommerce_process_meta_callback($post) {
    // Retrieve existing values from the meta fields
    $number = get_post_meta($post->ID, '_ecommerce_process_number', true);
    $description = get_post_meta($post->ID, '_ecommerce_process_description', true);

    ?>
    <p>
        <label for="ecommerce_process_number">Step Number:</label>
        <input type="text" name="ecommerce_process_number" id="ecommerce_process_number" value="<?php echo esc_attr($number); ?>" />
    </p>
    <p>
        <label for="ecommerce_process_description">Description:</label>
        <textarea name="ecommerce_process_description" id="ecommerce_process_description" rows="4"><?php echo esc_textarea($description); ?></textarea>
    </p>
    <?php
}

// Save the Meta Box Data
function save_ecommerce_process_meta_box($post_id) {
    if (isset($_POST['ecommerce_process_number'])) {
        update_post_meta($post_id, '_ecommerce_process_number', sanitize_text_field($_POST['ecommerce_process_number']));
    }
    if (isset($_POST['ecommerce_process_description'])) {
        update_post_meta($post_id, '_ecommerce_process_description', sanitize_textarea_field($_POST['ecommerce_process_description']));
    }
}

add_action('add_meta_boxes', 'ecommerce_process_meta_box');
add_action('save_post', 'save_ecommerce_process_meta_box');
