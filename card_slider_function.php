<?php
// Register Custom Post Type: Testimonial
function create_testimonial_cpt() {
    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Testimonials', 'text_domain' ),
        'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
        'archives'              => __( 'Testimonial Archives', 'text_domain' ),
        'attributes'            => __( 'Testimonial Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Testimonial:', 'text_domain' ),
        'all_items'             => __( 'All Testimonials', 'text_domain' ),
        'add_new_item'          => __( 'Add New Testimonial', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Testimonial', 'text_domain' ),
        'edit_item'             => __( 'Edit Testimonial', 'text_domain' ),
        'update_item'           => __( 'Update Testimonial', 'text_domain' ),
        'view_item'             => __( 'View Testimonial', 'text_domain' ),
        'view_items'            => __( 'View Testimonials', 'text_domain' ),
        'search_items'          => __( 'Search Testimonial', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into testimonial', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'text_domain' ),
        'items_list'            => __( 'Testimonials list', 'text_domain' ),
        'items_list_navigation' => __( 'Testimonials list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter testimonials list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'text_domain' ),
        'description'           => __( 'Custom post type for testimonials', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
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
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'create_testimonial_cpt', 0 );
// Add meta boxes for Testimonial post type
function add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        'Testimonial Details',
        'render_testimonial_meta_box',
        'testimonial',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_testimonial_meta_boxes' );

function render_testimonial_meta_box( $post ) {
    // Retrieve current values
    $heading = get_post_meta( $post->ID, '_testimonial_heading', true );
    $name = get_post_meta( $post->ID, '_testimonial_name', true );
    $designation = get_post_meta( $post->ID, '_testimonial_designation', true );
    
    // Nonce field for security
    wp_nonce_field( 'save_testimonial_meta_box', 'testimonial_meta_box_nonce' );
    
    // Output fields
   
    echo '<p><label for="testimonial_name">Name:</label>';
    echo '<input type="text" id="testimonial_name" name="testimonial_name" value="' . esc_attr( $name ) . '" size="30" /></p>';
    
    echo '<p><label for="testimonial_designation">Designation:</label>';
    echo '<input type="text" id="testimonial_designation" name="testimonial_designation" value="' . esc_attr( $designation ) . '" size="30" /></p>';
}

function save_testimonial_meta_box( $post_id ) {
    // Verify nonce
    if ( ! isset( $_POST['testimonial_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['testimonial_meta_box_nonce'], 'save_testimonial_meta_box' ) ) {
        return;
    }
    
    // Check if user has permission to save data
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Save or update fields
    if ( isset( $_POST['testimonial_heading'] ) ) {
        update_post_meta( $post_id, '_testimonial_heading', sanitize_text_field( $_POST['testimonial_heading'] ) );
    }
    if ( isset( $_POST['testimonial_name'] ) ) {
        update_post_meta( $post_id, '_testimonial_name', sanitize_text_field( $_POST['testimonial_name'] ) );
    }
    if ( isset( $_POST['testimonial_designation'] ) ) {
        update_post_meta( $post_id, '_testimonial_designation', sanitize_text_field( $_POST['testimonial_designation'] ) );
    }
}
add_action( 'save_post', 'save_testimonial_meta_box' );
