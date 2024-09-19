<?php
function create_contact_us_cpt() {
    $labels = array(
        'name' => __('Contact Us'),
        'singular_name' => __('Contact Us')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'contact-us'),
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-email',
    );

    register_post_type('contact_us', $args);
}
add_action('init', 'create_contact_us_cpt');
function contact_us_custom_fields() {
    add_meta_box(
        'contact_us_meta_box',
        'Contact Us Information',
        'render_contact_us_fields',
        'contact_us',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'contact_us_custom_fields');

function render_contact_us_fields($post) {
    // Retrieve current meta data
    $phone = get_post_meta($post->ID, '_contact_phone', true);
    $email = get_post_meta($post->ID, '_contact_email', true);
    $melbourne_address = get_post_meta($post->ID, '_melbourne_address', true);
    $sydney_address = get_post_meta($post->ID, '_sydney_address', true);

    // Form for meta box
    ?>
    <label for="contact_phone">Phone Number:</label>
    <input type="text" name="contact_phone" value="<?php echo esc_attr($phone); ?>" class="widefat" />

    <label for="contact_email">Email Address:</label>
    <input type="email" name="contact_email" value="<?php echo esc_attr($email); ?>" class="widefat" />

    <label for="melbourne_address">Melbourne Address:</label>
    <textarea name="melbourne_address" class="widefat"><?php echo esc_textarea($melbourne_address); ?></textarea>

    <label for="sydney_address">Sydney Address:</label>
    <textarea name="sydney_address" class="widefat"><?php echo esc_textarea($sydney_address); ?></textarea>
    <?php
}

// Save custom field data
function save_contact_us_fields($post_id) {
    if (array_key_exists('contact_phone', $_POST)) {
        update_post_meta($post_id, '_contact_phone', sanitize_text_field($_POST['contact_phone']));
    }
    if (array_key_exists('contact_email', $_POST)) {
        update_post_meta($post_id, '_contact_email', sanitize_email($_POST['contact_email']));
    }
    if (array_key_exists('melbourne_address', $_POST)) {
        update_post_meta($post_id, '_melbourne_address', sanitize_textarea_field($_POST['melbourne_address']));
    }
    if (array_key_exists('sydney_address', $_POST)) {
        update_post_meta($post_id, '_sydney_address', sanitize_textarea_field($_POST['sydney_address']));
    }
}
add_action('save_post', 'save_contact_us_fields');
function add_contact_us_meta_boxes() {
    add_meta_box('contact_us_labels', 'Contact Form Labels', 'contact_us_labels_callback', 'contact_us', 'normal', 'high');
}

function contact_us_labels_callback($post) {
    // Nonce field for security
    wp_nonce_field(basename(__FILE__), 'contact_us_nonce');

    // Get existing values
    $first_name_label = get_post_meta($post->ID, '_first_name_label', true);
    $last_name_label = get_post_meta($post->ID, '_last_name_label', true);
    $phone_label = get_post_meta($post->ID, '_phone_label', true);
    $email_label = get_post_meta($post->ID, '_email_label', true);
    $company_label = get_post_meta($post->ID, '_company_label', true);
    $message_label = get_post_meta($post->ID, '_message_label', true);
    $submit_button_text = get_post_meta($post->ID, '_submit_button_text', true);
    ?>

    <p>
        <label for="first_name_label">First Name Label:</label>
        <input type="text" id="first_name_label" name="first_name_label" value="<?php echo esc_attr($first_name_label); ?>" />
    </p>
    <p>
        <label for="last_name_label">Last Name Label:</label>
        <input type="text" id="last_name_label" name="last_name_label" value="<?php echo esc_attr($last_name_label); ?>" />
    </p>
    <p>
        <label for="phone_label">Phone Label:</label>
        <input type="text" id="phone_label" name="phone_label" value="<?php echo esc_attr($phone_label); ?>" />
    </p>
    <p>
        <label for="email_label">Email Label:</label>
        <input type="text" id="email_label" name="email_label" value="<?php echo esc_attr($email_label); ?>" />
    </p>
    <p>
        <label for="company_label">Company Name:</label>
        <input type="text" id="company_label" name="company_label" value="<?php echo esc_attr($company_label); ?>" />
    </p>
    <p>
        <label for="message_label">Message:</label>
        <input type="text" id="message_label" name="message_label" value="<?php echo esc_attr($message_label); ?>" />
    </p>
    <p>
        <label for="submit_button_text">Submit Button Text:</label>
        <input type="text" id="submit_button_text" name="submit_button_text" value="<?php echo esc_attr($submit_button_text); ?>" />
    </p>
    <?php
}

function save_contact_us_meta($post_id) {
    // Verify nonce and save fields
    if (!isset($_POST['contact_us_nonce']) || !wp_verify_nonce($_POST['contact_us_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // Save fields
    $fields = array(
        'first_name_label' => '_first_name_label',
        'last_name_label' => '_last_name_label',
        'phone_label' => '_phone_label',
        'email_label' => '_email_label',
        'company_label' => '_company_label',
        'message_label' => '_message_label',
        'submit_button_text' => '_submit_button_text'
    );

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
        }
    }
}

add_action('add_meta_boxes', function() {
    add_meta_box('contact_us_meta_box', 'Contact Us Fields', 'contact_us_labels_callback', 'contact_us', 'normal', 'high');
});
add_action('save_post', 'save_contact_us_meta');
