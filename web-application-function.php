<?php
function custom_webapp_post_type() {
    $labels = array(
        'name' => 'Web Applications',
        'singular_name' => 'Web Application',
        'menu_name' => 'Web Applications',
        'name_admin_bar' => 'Web Application',
    );
  
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    );
  
    register_post_type('webapp', $args);
}
add_action('init', 'custom_webapp_post_type');
function add_webapp_meta_boxes() {
    add_meta_box(
        'webapp_meta_box', // Unique ID
        'Web Application Details', // Box title
        'webapp_meta_box_html', // Content callback
        'webapp' // Post type
    );
}
add_action('add_meta_boxes', 'add_webapp_meta_boxes');

function webapp_meta_box_html($post) {
    $image = get_post_meta($post->ID, '_webapp_image', true);
    $heading = get_post_meta($post->ID, '_webapp_heading', true);
    $paragraph = get_post_meta($post->ID, '_webapp_paragraph', true);
    $button_url = get_post_meta($post->ID, '_webapp_button_url', true);
    ?>
    <p>
        <label for="webapp_image">Image URL</label>
        <input type="text" name="webapp_image" id="webapp_image" value="<?php echo esc_attr($image); ?>" class="widefat" />
    </p>
    <p>
        <label for="webapp_heading">Heading</label>
        <input type="text" name="webapp_heading" id="webapp_heading" value="<?php echo esc_attr($heading); ?>" class="widefat" />
    </p>
    <p>
        <label for="webapp_paragraph">Paragraph</label>
        <textarea name="webapp_paragraph" id="webapp_paragraph" class="widefat"><?php echo esc_textarea($paragraph); ?></textarea>
    </p>
    <p>
        <label for="webapp_button_url">Button URL</label>
        <input type="text" name="webapp_button_url" id="webapp_button_url" value="<?php echo esc_attr($button_url); ?>" class="widefat" />
    </p>
    <?php
}

function save_webapp_meta_data($post_id) {
    if (array_key_exists('webapp_image', $_POST)) {
        update_post_meta($post_id, '_webapp_image', sanitize_text_field($_POST['webapp_image']));
    }
    if (array_key_exists('webapp_heading', $_POST)) {
        update_post_meta($post_id, '_webapp_heading', sanitize_text_field($_POST['webapp_heading']));
    }
    if (array_key_exists('webapp_paragraph', $_POST)) {
        update_post_meta($post_id, '_webapp_paragraph', sanitize_textarea_field($_POST['webapp_paragraph']));
    }
    if (array_key_exists('webapp_button_url', $_POST)) {
        update_post_meta($post_id, '_webapp_button_url', sanitize_text_field($_POST['webapp_button_url']));
    }
}
add_action('save_post', 'save_webapp_meta_data');
