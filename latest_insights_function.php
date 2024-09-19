<?php
function register_insight_post_type() {
    $labels = array(
        'name'               => _x('Insights', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Insight', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Insights', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Insight', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'insight', 'textdomain'),
        'add_new_item'       => __('Add New Insight', 'textdomain'),
        'new_item'           => __('New Insight', 'textdomain'),
        'edit_item'          => __('Edit Insight', 'textdomain'),
        'view_item'          => __('View Insight', 'textdomain'),
        'all_items'          => __('All Insights', 'textdomain'),
        'search_items'       => __('Search Insights', 'textdomain'),
        'parent_item_colon'  => __('Parent Insights:', 'textdomain'),
        'not_found'          => __('No insights found.', 'textdomain'),
        'not_found_in_trash' => __('No insights found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'insight'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('insight', $args);
}

add_action('init', 'register_insight_post_type');
function add_insight_meta_boxes() {
    add_meta_box(
        'insight_details',
        'Insight Details',
        'render_insight_details_meta_box',
        'insight', // Custom post type
        'normal',
        'high'
    );
}

function render_insight_details_meta_box($post) {
    wp_nonce_field('save_insight_details', 'insight_details_nonce');

    $image_id = get_post_meta($post->ID, '_insight_image_id', true);
    $image_url = wp_get_attachment_image_url($image_id, 'full');
    $heading = get_post_meta($post->ID, '_insight_heading', true);
    $button_text = get_post_meta($post->ID, '_insight_button_text', true);
    $button_url = get_post_meta($post->ID, '_insight_button_url', true);
    ?>
    
    <p>
        <label for="insight_image">Image</label>
        <input type="hidden" id="insight_image_id" name="insight_image_id" value="<?php echo esc_attr($image_id); ?>" />
        <div id="insight_image_container">
            <?php if ($image_url): ?>
                <img src="<?php echo esc_url($image_url); ?>" style="max-width:100%;height:auto;" />
            <?php endif; ?>
        </div>
        <button type="button" class="button" id="insight_image_button">Upload Image</button>
        <button type="button" class="button" id="insight_image_remove">Remove Image</button>
    </p>
    <p>
        <label for="insight_heading">Heading</label>
        <input type="text" id="insight_heading" name="insight_heading" value="<?php echo esc_attr($heading); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="insight_button_text">Button Text</label>
        <input type="text" id="insight_button_text" name="insight_button_text" value="<?php echo esc_attr($button_text); ?>" />
    </p>
    <p>
        <label for="insight_button_url">Button URL</label>
        <input type="text" id="insight_button_url" name="insight_button_url" value="<?php echo esc_url($button_url); ?>" />
    </p>

    <script>
        jQuery(document).ready(function($){
            var mediaUploader;

            $('#insight_image_button').click(function(e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media({
                    title: 'Select Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                }).on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#insight_image_id').val(attachment.id);
                    $('#insight_image_container').html('<img src="' + attachment.url + '" style="max-width:100%;height:auto;" />');
                }).open();
            });

            $('#insight_image_remove').click(function(e) {
                e.preventDefault();
                $('#insight_image_id').val('');
                $('#insight_image_container').html('');
            });
        });
    </script>
    <?php
}

function save_insight_details($post_id) {
    if (!isset($_POST['insight_details_nonce']) || !wp_verify_nonce($_POST['insight_details_nonce'], 'save_insight_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['insight_image_id'])) {
        update_post_meta($post_id, '_insight_image_id', intval($_POST['insight_image_id']));
    }

    if (isset($_POST['insight_heading'])) {
        update_post_meta($post_id, '_insight_heading', sanitize_text_field($_POST['insight_heading']));
    }

    if (isset($_POST['insight_button_text'])) {
        update_post_meta($post_id, '_insight_button_text', sanitize_text_field($_POST['insight_button_text']));
    }

    if (isset($_POST['insight_button_url'])) {
        update_post_meta($post_id, '_insight_button_url', esc_url_raw($_POST['insight_button_url']));
    }
}

add_action('add_meta_boxes', 'add_insight_meta_boxes');
add_action('save_post', 'save_insight_details');

?>
