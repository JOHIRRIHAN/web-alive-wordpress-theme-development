<?php
function create_about_us_post_type() {
    register_post_type('about_us',
        array(
            'labels' => array(
                'name' => __('About Us 1'),
                'singular_name' => __('About Us'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-info',
            'rewrite' => array('slug' => 'about-us'),
        )
    );
}
add_action('init', 'create_about_us_post_type');
function add_about_us_meta_boxes() {
    add_meta_box(
        'about_us_details',
        'About Us Details',
        'render_about_us_meta_box',
        'about_us',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_about_us_meta_boxes');

// Render Meta Box Content
function render_about_us_meta_box($post) {
    wp_nonce_field('save_about_us_details', 'about_us_nonce');

    // Retrieve existing values
    $section_title = get_post_meta($post->ID, '_section_title', true);
    $paragraph_one = get_post_meta($post->ID, '_paragraph_one', true);
    $paragraph_two = get_post_meta($post->ID, '_paragraph_two', true);
    $paragraph_three = get_post_meta($post->ID, '_paragraph_three', true);
    $image_url = get_post_meta($post->ID, '_image_url', true);

    ?>
    <p>
        <label for="section_title">Section Title</label>
        <input type="text" id="section_title" name="section_title" value="<?php echo esc_attr($section_title); ?>" class="widefat"/>
    </p>
    <p>
        <label for="paragraph_one">First Paragraph</label>
        <textarea id="paragraph_one" name="paragraph_one" rows="4" class="widefat"><?php echo esc_textarea($paragraph_one); ?></textarea>
    </p>
    <p>
        <label for="paragraph_two">Second Paragraph</label>
        <textarea id="paragraph_two" name="paragraph_two" rows="4" class="widefat"><?php echo esc_textarea($paragraph_two); ?></textarea>
    </p>
    <p>
        <label for="paragraph_three">Third Paragraph</label>
        <textarea id="paragraph_three" name="paragraph_three" rows="4" class="widefat"><?php echo esc_textarea($paragraph_three); ?></textarea>
    </p>
    <p>
        <label for="image_url">Image URL</label>
        <input type="text" id="image_url" name="image_url" value="<?php echo esc_url($image_url); ?>" class="widefat"/>
    </p>
    <?php
}

// Save Meta Box Content
function save_about_us_details($post_id) {
    if (!isset($_POST['about_us_nonce']) || !wp_verify_nonce($_POST['about_us_nonce'], 'save_about_us_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['section_title'])) {
        update_post_meta($post_id, '_section_title', sanitize_text_field($_POST['section_title']));
    }
    if (isset($_POST['paragraph_one'])) {
        update_post_meta($post_id, '_paragraph_one', sanitize_textarea_field($_POST['paragraph_one']));
    }
    if (isset($_POST['paragraph_two'])) {
        update_post_meta($post_id, '_paragraph_two', sanitize_textarea_field($_POST['paragraph_two']));
    }
    if (isset($_POST['paragraph_three'])) {
        update_post_meta($post_id, '_paragraph_three', sanitize_textarea_field($_POST['paragraph_three']));
    }
    if (isset($_POST['image_url'])) {
        update_post_meta($post_id, '_image_url', esc_url_raw($_POST['image_url']));
    }
}
add_action('save_post', 'save_about_us_details');
