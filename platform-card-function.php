<?php
 function create_platform_card_post_type() {
    $labels = array(
        'name'               => _x('Platform Cards', 'post type general name'),
        'singular_name'      => _x('Platform Card', 'post type singular name'),
        'menu_name'          => _x('Platform Cards', 'admin menu'),
        'name_admin_bar'     => _x('Platform Card', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'platform card'),
        'add_new_item'       => __('Add New Platform Card'),
        'new_item'           => __('New Platform Card'),
        'edit_item'          => __('Edit Platform Card'),
        'view_item'          => __('View Platform Card'),
        'all_items'          => __('All Platform Cards'),
        'search_items'       => __('Search Platform Cards'),
        'not_found'          => __('No Platform Cards found.'),
        'not_found_in_trash' => __('No Platform Cards found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'platform_card'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('platform_card', $args);
}
add_action('init', 'create_platform_card_post_type');
function platform_card_meta_boxes() {
    add_meta_box(
        'platform_card_meta_box', // ID
        'Platform Card Details', // Title
        'platform_card_meta_box_callback', // Callback
        'platform_card', // Post Type
        'normal', // Context
        'high' // Priority
    );
}
add_action('add_meta_boxes', 'platform_card_meta_boxes');

function platform_card_meta_box_callback($post) {
    wp_nonce_field('save_platform_card_meta_box', 'platform_card_meta_box_nonce');

    $image = get_post_meta($post->ID, '_platform_card_image', true);
    $heading = get_post_meta($post->ID, '_platform_card_heading', true);
    $paragraph = get_post_meta($post->ID, '_platform_card_paragraph', true);
    ?>

    <p>
        <label for="platform_card_image">Image URL</label><br>
        <input type="text" id="platform_card_image" name="platform_card_image" value="<?php echo esc_attr($image); ?>" size="50" />
    </p>
    <p>
        <label for="platform_card_heading">Heading</label><br>
        <input type="text" id="platform_card_heading" name="platform_card_heading" value="<?php echo esc_attr($heading); ?>" size="50" />
    </p>
    <p>
        <label for="platform_card_paragraph">Paragraph</label><br>
        <textarea id="platform_card_paragraph" name="platform_card_paragraph" rows="4" cols="50"><?php echo esc_attr($paragraph); ?></textarea>
    </p>
    <?php
}

function save_platform_card_meta_box($post_id) {
    if (!isset($_POST['platform_card_meta_box_nonce']) || !wp_verify_nonce($_POST['platform_card_meta_box_nonce'], 'save_platform_card_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['platform_card_image'])) {
        update_post_meta($post_id, '_platform_card_image', sanitize_text_field($_POST['platform_card_image']));
    }

    if (isset($_POST['platform_card_heading'])) {
        update_post_meta($post_id, '_platform_card_heading', sanitize_text_field($_POST['platform_card_heading']));
    }

    if (isset($_POST['platform_card_paragraph'])) {
        update_post_meta($post_id, '_platform_card_paragraph', sanitize_textarea_field($_POST['platform_card_paragraph']));
    }
}
add_action('save_post', 'save_platform_card_meta_box');
