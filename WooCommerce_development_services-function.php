<?php
function woocommerce_services_post_type() {
    $labels = array(
        'name'               => 'WooCommerce Services',
        'singular_name'      => 'WooCommerce Service',
        'menu_name'          => 'WooCommerce Services',
        'name_admin_bar'     => 'WooCommerce Service',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Service',
        'new_item'           => 'New Service',
        'edit_item'          => 'Edit Service',
        'view_item'          => 'View Service',
        'all_items'          => 'All Services',
        'search_items'       => 'Search Services',
        'not_found'          => 'No services found',
        'not_found_in_trash' => 'No services found in Trash',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'woocommerce-services'),
        'supports'           => array('title', 'editor'),
        'show_in_rest'       => true,
    );
    
    register_post_type('woocommerce_service', $args);
}
add_action('init', 'woocommerce_services_post_type');
function woocommerce_services_meta_boxes() {
    add_meta_box(
        'woocommerce_service_meta',
        'WooCommerce Service Details',
        'woocommerce_services_meta_callback',
        'woocommerce_service'
    );
}
add_action('add_meta_boxes', 'woocommerce_services_meta_boxes');

function woocommerce_services_meta_callback($post) {
    $icon_class = get_post_meta($post->ID, '_woocommerce_icon_class', true);
    $service_title = get_post_meta($post->ID, '_woocommerce_service_title', true);
    $service_description = get_post_meta($post->ID, '_woocommerce_service_description', true);
    ?>

    <p>
        <label for="woocommerce_icon_class">Icon Class:</label>
        <input type="text" name="woocommerce_icon_class" id="woocommerce_icon_class" value="<?php echo esc_attr($icon_class); ?>" class="widefat">
    </p>
    <p>
        <label for="woocommerce_service_title">Service Title:</label>
        <input type="text" name="woocommerce_service_title" id="woocommerce_service_title" value="<?php echo esc_attr($service_title); ?>" class="widefat">
    </p>
    <p>
        <label for="woocommerce_service_description">Service Description:</label>
        <textarea name="woocommerce_service_description" id="woocommerce_service_description" class="widefat"><?php echo esc_textarea($service_description); ?></textarea>
    </p>

    <?php
}

function save_woocommerce_services_meta($post_id) {
    if (array_key_exists('woocommerce_icon_class', $_POST)) {
        update_post_meta($post_id, '_woocommerce_icon_class', sanitize_text_field($_POST['woocommerce_icon_class']));
    }
    if (array_key_exists('woocommerce_service_title', $_POST)) {
        update_post_meta($post_id, '_woocommerce_service_title', sanitize_text_field($_POST['woocommerce_service_title']));
    }
    if (array_key_exists('woocommerce_service_description', $_POST)) {
        update_post_meta($post_id, '_woocommerce_service_description', sanitize_textarea_field($_POST['woocommerce_service_description']));
    }
}
add_action('save_post', 'save_woocommerce_services_meta');
function load_boxicons() {
    wp_enqueue_style( 'boxicons', 'https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css', array(), '2.1.1' );
}
add_action( 'wp_enqueue_scripts', 'load_boxicons' );
