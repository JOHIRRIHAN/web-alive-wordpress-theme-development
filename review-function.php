<?php

// Register Custom Post Type
function create_review_post_type() {
    $labels = array(
        'name'                  => _x('Reviews', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Review', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Reviews', 'text_domain'),
        'name_admin_bar'        => __('Review', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'add_new_item'          => __('Add New Review', 'text_domain'),
        'new_item'              => __('New Review', 'text_domain'),
        'edit_item'             => __('Edit Review', 'text_domain'),
        'view_item'             => __('View Review', 'text_domain'),
        'all_items'             => __('All Reviews', 'text_domain'),
        'search_items'          => __('Search Reviews', 'text_domain'),
        'not_found'             => __('No reviews found.', 'text_domain'),
        'not_found_in_trash'    => __('No reviews found in Trash.', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Review', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('review', $args);
}
add_action('init', 'create_review_post_type');

// Add Meta Boxes
function add_review_meta_boxes() {
    add_meta_box('review_meta_box', 'Review Details', 'render_review_meta_box', 'review', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_review_meta_boxes');

function render_review_meta_box($post) {
    $rating = get_post_meta($post->ID, 'rating', true);
    $reviewer = get_post_meta($post->ID, 'reviewer', true);
    $review_text = get_post_meta($post->ID, 'review_text', true);
    ?>
    <label for="review_rating">Star Rating:</label>
    <input type="number" id="review_rating" name="review_rating" value="<?php echo esc_attr($rating); ?>" min="1" max="5" /><br>

    <label for="review_reviewer">Reviewer Name:</label>
    <input type="text" id="review_reviewer" name="review_reviewer" value="<?php echo esc_attr($reviewer); ?>" /><br>

    <label for="review_text">Review Text:</label>
    <textarea id="review_text" name="review_text" rows="4"><?php echo esc_textarea($review_text); ?></textarea><br>
    <?php
}

// Save Meta Box Data
function save_review_meta_boxes($post_id) {
    if (array_key_exists('review_rating', $_POST)) {
        update_post_meta($post_id, 'rating', $_POST['review_rating']);
    }
    if (array_key_exists('review_reviewer', $_POST)) {
        update_post_meta($post_id, 'reviewer', $_POST['review_reviewer']);
    }
    if (array_key_exists('review_text', $_POST)) {
        update_post_meta($post_id, 'review_text', $_POST['review_text']);
    }
}
add_action('save_post', 'save_review_meta_boxes');

// Enqueue Font Awesome for Stars (if not already enqueued)
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
