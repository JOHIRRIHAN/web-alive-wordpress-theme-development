<?php
function create_blog_hero_post_type() {
    register_post_type('blog_hero',
        array(
            'labels' => array(
                'name' => __('Blog Heroes'),
                'singular_name' => __('Blog Hero'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-admin-post',
            'rewrite' => array('slug' => 'blog-hero'),
        )
    );
}
add_action('init', 'create_blog_hero_post_type');
function add_blog_hero_meta_boxes() {
    add_meta_box(
        'blog_hero_details',
        'Blog Hero Details',
        'render_blog_hero_meta_box',
        'blog_hero',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_blog_hero_meta_boxes');

function render_blog_hero_meta_box($post) {
    wp_nonce_field('save_blog_hero_details', 'blog_hero_nonce');

    $image_url = get_post_meta($post->ID, '_blog_hero_image_url', true);
    $heading = get_post_meta($post->ID, '_blog_hero_heading', true);
    $paragraph = get_post_meta($post->ID, '_blog_hero_paragraph', true);
    $title = get_post_meta($post->ID, '_blog_hero_title', true);
    ?>

    <p>
        <label for="blog_hero_image_url">Image URL</label>
        <input type="text" id="blog_hero_image_url" name="blog_hero_image_url" value="<?php echo esc_url($image_url); ?>" class="widefat"/>
    </p>
    <p>
        <label for="blog_hero_heading">Heading</label>
        <input type="text" id="blog_hero_heading" name="blog_hero_heading" value="<?php echo esc_attr($heading); ?>" class="widefat"/>
    </p>
    <p>
        <label for="blog_hero_paragraph">Paragraph</label>
        <textarea id="blog_hero_paragraph" name="blog_hero_paragraph" rows="4" class="widefat"><?php echo esc_textarea($paragraph); ?></textarea>
    </p>
    <p>
        <label for="blog_hero_title">Title</label>
        <input type="text" id="blog_hero_title" name="blog_hero_title" value="<?php echo esc_attr($title); ?>" class="widefat"/>
    </p>
    <?php
}

function save_blog_hero_details($post_id) {
    if (!isset($_POST['blog_hero_nonce']) || !wp_verify_nonce($_POST['blog_hero_nonce'], 'save_blog_hero_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['blog_hero_image_url'])) {
        update_post_meta($post_id, '_blog_hero_image_url', esc_url_raw($_POST['blog_hero_image_url']));
    }
    if (isset($_POST['blog_hero_heading'])) {
        update_post_meta($post_id, '_blog_hero_heading', sanitize_text_field($_POST['blog_hero_heading']));
    }
    if (isset($_POST['blog_hero_paragraph'])) {
        update_post_meta($post_id, '_blog_hero_paragraph', sanitize_textarea_field($_POST['blog_hero_paragraph']));
    }
    if (isset($_POST['blog_hero_title'])) {
        update_post_meta($post_id, '_blog_hero_title', sanitize_text_field($_POST['blog_hero_title']));
    }
}
add_action('save_post', 'save_blog_hero_details');
