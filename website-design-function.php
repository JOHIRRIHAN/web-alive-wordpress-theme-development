<?php
function create_website_design_post_type() {
    register_post_type('website_design',
        array(
            'labels'      => array(
                'name'          => __('Wordpress Website Designs'),
                'singular_name' => __('Website Design'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor', 'thumbnail'),
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'create_website_design_post_type');

function add_website_design_meta_boxes() {
    add_meta_box(
        'website_design_meta',
        'Website Design Details',
        'render_website_design_meta_box',
        'website_design',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_website_design_meta_boxes');

function render_website_design_meta_box($post) {
    $image = get_post_meta($post->ID, '_website_design_image', true);
    $heading = get_post_meta($post->ID, '_website_design_heading', true);
    $paragraph = get_post_meta($post->ID, '_website_design_paragraph', true);
    $button_url = get_post_meta($post->ID, '_website_design_button_url', true);
    ?>
    <div>
        <label for="website_design_image">Image URL:</label>
        <input type="text" id="website_design_image" name="website_design_image" value="<?php echo esc_attr($image); ?>" style="width:100%;" />
        
        <label for="website_design_heading">Heading:</label>
        <input type="text" id="website_design_heading" name="website_design_heading" value="<?php echo esc_attr($heading); ?>" style="width:100%;" />

        <label for="website_design_paragraph">Paragraph:</label>
        <textarea id="website_design_paragraph" name="website_design_paragraph" rows="4" style="width:100%;"><?php echo esc_textarea($paragraph); ?></textarea>
        
        <label for="website_design_button_url">Button URL:</label>
        <input type="text" id="website_design_button_url" name="website_design_button_url" value="<?php echo esc_attr($button_url); ?>" style="width:100%;" />
    </div>
    <?php
}

function save_website_design_meta_box($post_id) {
    if (array_key_exists('website_design_image', $_POST)) {
        update_post_meta($post_id, '_website_design_image', sanitize_text_field($_POST['website_design_image']));
    }
    if (array_key_exists('website_design_heading', $_POST)) {
        update_post_meta($post_id, '_website_design_heading', sanitize_text_field($_POST['website_design_heading']));
    }
    if (array_key_exists('website_design_paragraph', $_POST)) {
        update_post_meta($post_id, '_website_design_paragraph', sanitize_textarea_field($_POST['website_design_paragraph']));
    }
    if (array_key_exists('website_design_button_url', $_POST)) {
        update_post_meta($post_id, '_website_design_button_url', sanitize_text_field($_POST['website_design_button_url']));
    }
}
add_action('save_post', 'save_website_design_meta_box');
