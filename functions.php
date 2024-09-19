<?php
function mytheme_enqueue_styles() {
    wp_enqueue_style('tailwind-css', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');

function my_theme_enqueue_styles() {
    // Enqueue Tailwind CSS
    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/src/output.css', array(), null);

    // Enqueue the main theme stylesheet
    wp_enqueue_style('main-styles', get_stylesheet_uri(), array('tailwindcss'), null);

    // Enqueue scripts if needed
    // wp_enqueue_script('my-script', get_template_directory_uri() . '/js/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function web_alive_customize_register($wp_customize) {
    // Add your Customizer settings and controls here
}
function my_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'yourtheme'),
        'id'            => 'primary-sidebar',
        'description'   => __('Widgets in this area will be shown in the primary sidebar.', 'yourtheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'yourtheme'),
        'id'            => 'footer-widget-area',
        'description'   => __('Widgets in this area will be shown in the footer.', 'yourtheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'my_theme_widgets_init');




    require_once get_template_directory() . '/header_function.php';
    require_once get_template_directory() . '/logo_thambel_function.php';
    require_once get_template_directory() . '/service_function.php';
    require_once get_template_directory() . '/feature_function.php';
    require_once get_template_directory() . '/latest_insights_function.php';
    require_once get_template_directory() . '/footer_function.php';
    require_once get_template_directory() . '/card_slider_function.php';
    require_once get_template_directory() . '/australias_leading_function.php';
    require_once get_template_directory() . '/video_function.php';
    require_once get_template_directory() . '/btn_function.php';
    require_once get_template_directory() . '/hero_shard_component_function.php';
    require_once get_template_directory() . '/recent-work-function.php';
    require_once get_template_directory() . '/about-us-function.php';
    require_once get_template_directory() . '/vission-function.php';
    require_once get_template_directory() . '/value-function.php';
    require_once get_template_directory() . '/tools-function.php';
    require_once get_template_directory() . '/blog-hero-functons.php';
    require_once get_template_directory() . '/contact-function.php';
    require_once get_template_directory() . '/second-hero-function.php';
    require_once get_template_directory() . '/brandlogo-function.php';
    require_once get_template_directory() . '/web-service-function.php';
    require_once get_template_directory() . '/all-hero-short-code-function.php';


  
?>
