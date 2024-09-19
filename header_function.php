<?php
function theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'your-theme-textdomain'),
    ));
}
add_action('after_setup_theme', 'theme_setup');
class Tailwind_Nav_Walker extends Walker_Nav_Menu {
    // Start Level
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);

        // Add hidden and hover classes for showing on hover
        $classes = 'dropdown-menu hidden absolute bg-white text-black w-96 rounded-box p-2 shadow-lg group-hover:block top-full left-0';
        $output .= "\n$indent<ul class=\"$classes\">\n";
    }

    // Start Element
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item';

        // Check if the item has children to determine dropdown
        if ($args->walker->has_children) {
            $classes[] = 'group relative'; // Use group class for parent item
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= $indent . '<li' . $class_names . '>';

        $attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="px-2 py-1 hover:text-orange-400 flex items-center"';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID);
        
        // Add icon for items with children
        if ($args->walker->has_children) {
            $item_output .= '<i class="fas fa-chevron-down ml-2"></i>'; // Down arrow icon
        }

        $item_output .= $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
function theme_customize_register($wp_customize) {
    // Add Logo Setting
    $wp_customize->add_setting('custom_logo', array(
        'default' => get_template_directory_uri() . '/images/company-logo-color.webp',
        'transport' => 'refresh',
    ));

    // Add Logo Control
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_logo_control', array(
        'label' => __('Upload Logo', 'theme_textdomain'),
        'section' => 'title_tagline',
        'settings' => 'custom_logo',
    )));
}
add_action('customize_register', 'theme_customize_register');

?>

<?php
// Other theme setup code...

function enqueue_fontawesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_fontawesome');

// Other functions...
?>


<?php
function web_alive_register_hero_section() {
    $labels = array(
        'name' => __('Hero Sections', 'web_alive'),
        'singular_name' => __('Hero Section', 'web_alive'),
        'menu_name' => __('Hero Sections', 'web_alive'),
        'add_new_item' => __('Add New Hero Section', 'web_alive'),
        'edit_item' => __('Edit Hero Section', 'web_alive'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'hero-section'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-video',
    );

    register_post_type('hero_section', $args);
}
add_action('init', 'web_alive_register_hero_section');

function web_alive_hero_meta_boxes() {
    add_meta_box(
        'hero_section_meta_box',
        __('Hero Section Details', 'web_alive'),
        'web_alive_hero_section_meta_callback',
        'hero_section',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'web_alive_hero_meta_boxes');

function web_alive_hero_section_meta_callback($post) {
    wp_nonce_field(basename(__FILE__), 'web_alive_hero_nonce');
    $hero_stored_meta = get_post_meta($post->ID);

    // Video URL
    echo '<label for="hero_video_url">' . __('Video URL', 'web_alive') . '</label>';
    echo '<input type="url" name="hero_video_url" value="' . esc_attr($hero_stored_meta['hero_video_url'][0] ?? '') . '" size="50" />';
    
    // Video Upload
    echo '<label for="hero_video_upload">' . __('Upload Video', 'web_alive') . '</label>';
    echo '<input type="file" name="hero_video_upload" id="hero_video_upload" />';
    
    // Title, Subtitle, Button Text, and Button URL
    echo '<label for="hero_title">' . __('Hero Title', 'web_alive') . '</label>';
    echo '<input type="text" name="hero_title" value="' . esc_attr($hero_stored_meta['hero_title'][0] ?? '') . '" size="50" />';
    
    echo '<label for="hero_subtitle">' . __('Hero Subtitle', 'web_alive') . '</label>';
    echo '<input type="text" name="hero_subtitle" value="' . esc_attr($hero_stored_meta['hero_subtitle'][0] ?? '') . '" size="50" />';
    
    echo '<label for="hero_button_text">' . __('Button Text', 'web_alive') . '</label>';
    echo '<input type="text" name="hero_button_text" value="' . esc_attr($hero_stored_meta['hero_button_text'][0] ?? '') . '" size="50" />';
    
    echo '<label for="hero_button_url">' . __('Button URL', 'web_alive') . '</label>';
    echo '<input type="url" name="hero_button_url" value="' . esc_attr($hero_stored_meta['hero_button_url'][0] ?? '') . '" size="50" />';
}
function web_alive_save_hero_section_meta($post_id) {
    if (!isset($_POST['web_alive_hero_nonce']) || !wp_verify_nonce($_POST['web_alive_hero_nonce'], basename(__FILE__))) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['hero_video_url'])) {
        update_post_meta($post_id, 'hero_video_url', sanitize_text_field($_POST['hero_video_url']));
    }

    if (isset($_POST['hero_title'])) {
        update_post_meta($post_id, 'hero_title', sanitize_text_field($_POST['hero_title']));
    }

    if (isset($_POST['hero_subtitle'])) {
        update_post_meta($post_id, 'hero_subtitle', sanitize_text_field($_POST['hero_subtitle']));
    }

    if (isset($_POST['hero_button_text'])) {
        update_post_meta($post_id, 'hero_button_text', sanitize_text_field($_POST['hero_button_text']));
    }

    if (isset($_POST['hero_button_url'])) {
        update_post_meta($post_id, 'hero_button_url', esc_url_raw($_POST['hero_button_url']));
    }

    // Handle video upload (if any)
    if (!empty($_FILES['hero_video_upload']['name'])) {
        $uploaded_file = wp_upload_bits($_FILES['hero_video_upload']['name'], null, file_get_contents($_FILES['hero_video_upload']['tmp_name']));
        if (!$uploaded_file['error']) {
            update_post_meta($post_id, 'hero_video_upload', $uploaded_file['url']);
        }
    }
}
add_action('save_post', 'web_alive_save_hero_section_meta');
