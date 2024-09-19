<?php
function my_theme_customize_register($wp_customize) {
    // Footer Logo
    $wp_customize->add_setting('footer_logo', array(
        'default' => get_template_directory_uri() . '/images/webalive-logo.webp',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Footer Logo', 'my_theme'),
        'section' => 'title_tagline',
        'settings' => 'footer_logo',
    )));

    // Footer Copyright
    $wp_customize->add_setting('footer_copyright', array(
        'default' => '&copy; Copyright © 2024 WebAlive',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_copyright', array(
        'label' => __('Footer Copyright', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'text',
    ));

    // Footer Services
    $wp_customize->add_setting('footer_services', array(
        'default' => 'Web Development, Ecommerce Web Site Design, Web Site Design, Mobile App Development, Online Marketing, Wordpress Development, Sopify we design',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_services', array(
        'label' => __('Footer Services', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'textarea',
    ));

    // Footer Solutions
    $wp_customize->add_setting('footer_solutions', array(
        'default' => 'Medical Website, Live Chart software, NetSuite Integration, Trade Services Website, Sporting Club Website, Transport Services Website, Professional Services Website',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_solutions', array(
        'label' => __('Footer Solutions', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'textarea',
    ));

    // Footer Melbourne
    $wp_customize->add_setting('footer_melbourne', array(
        'default' => 'Suite 502, 9 Yarra St South Yarra, VIC 3141, Australia | (03) 8669 0640',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_melbourne', array(
        'label' => __('Footer Melbourne', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'textarea',
    ));

    // Footer Sydney
    $wp_customize->add_setting('footer_sydney', array(
        'default' => 'Suite 11, 1401 Botany Road Botany, NSW 2019, Australia | (02) 8004 3410',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('footer_sydney', array(
        'label' => __('Footer Sydney', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'textarea',
    ));

    // Footer Social Icons
    $wp_customize->add_setting('footer_facebook', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('footer_facebook', array(
        'label' => __('Facebook URL', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'url',
    ));

    $wp_customize->add_setting('footer_instagram', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('footer_instagram', array(
        'label' => __('Instagram URL', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'url',
    ));

    $wp_customize->add_setting('footer_youtube', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('footer_youtube', array(
        'label' => __('YouTube URL', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'url',
    ));

    $wp_customize->add_setting('footer_linkedin', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('footer_linkedin', array(
        'label' => __('LinkedIn URL', 'my_theme'),
        'section' => 'title_tagline',
        'type' => 'url',
    ));
}

add_action('customize_register', 'my_theme_customize_register');
