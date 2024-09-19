<?php

function create_blog_post_type() {
    register_post_type('blog_post',
        array(
            'labels' => array(
                'name' => __('Blog Posts'),
                'singular_name' => __('Blog Post'),
            ),
            'public' => true,  // Ensure it's public
            'has_archive' => true,  // Enable archive
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-admin-post',
            'rewrite' => array('slug' => 'blog-post'),
        )
    );
}
add_action('init', 'create_blog_post_type');

function add_blog_post_meta_boxes() {
    add_meta_box(
        'blog_post_details',
        'Blog Post Details',
        'render_blog_post_meta_box',
        'blog_post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_blog_post_meta_boxes');

function render_blog_post_meta_box($post) {
    wp_nonce_field('save_blog_post_details', 'blog_post_nonce');

    $image_url = get_post_meta($post->ID, '_blog_post_image_url', true);
    $heading = get_post_meta($post->ID, '_blog_post_heading', true);
    $paragraph = get_post_meta($post->ID, '_blog_post_paragraph', true);
    $title = get_post_meta($post->ID, '_blog_post_title', true);
    ?>

    <p>
        <label for="blog_post_image_url">Image URL</label>
        <input type="text" id="blog_post_image_url" name="blog_post_image_url" value="<?php echo esc_url($image_url); ?>" class="widefat"/>
    </p>
    <p>
        <label for="blog_post_heading">Heading</label>
        <input type="text" id="blog_post_heading" name="blog_post_heading" value="<?php echo esc_attr($heading); ?>" class="widefat"/>
    </p>
    <p>
        <label for="blog_post_paragraph">Paragraph</label>
        <textarea id="blog_post_paragraph" name="blog_post_paragraph" rows="4" class="widefat"><?php echo esc_textarea($paragraph); ?></textarea>
    </p>
    <p>
        <label for="blog_post_title">Title</label>
        <input type="text" id="blog_post_title" name="blog_post_title" value="<?php echo esc_attr($title); ?>" class="widefat"/>
    </p>
    <?php
}

function save_blog_post_details($post_id) {
    if (!isset($_POST['blog_post_nonce']) || !wp_verify_nonce($_POST['blog_post_nonce'], 'save_blog_post_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['blog_post_image_url'])) {
        update_post_meta($post_id, '_blog_post_image_url', esc_url_raw($_POST['blog_post_image_url']));
    }
    if (isset($_POST['blog_post_heading'])) {
        update_post_meta($post_id, '_blog_post_heading', sanitize_text_field($_POST['blog_post_heading']));
    }
    if (isset($_POST['blog_post_paragraph'])) {
        update_post_meta($post_id, '_blog_post_paragraph', sanitize_textarea_field($_POST['blog_post_paragraph']));
    }
    if (isset($_POST['blog_post_title'])) {
        update_post_meta($post_id, '_blog_post_title', sanitize_text_field($_POST['blog_post_title']));
    }
}
add_action('save_post', 'save_blog_post_details');
