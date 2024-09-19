<?php
 function customize_second_hero_section($wp_customize) {
    // Create a new section for the second hero
    $wp_customize->add_section('second_hero_section', array(
        'title' => __('Second Hero Section', 'theme_textdomain'),
        'description' => __('Modify the second hero section content', 'theme_textdomain'),
        'priority' => 30,
    ));

    // Second Hero Title
    $wp_customize->add_setting('second_hero_title', array(
        'default' => 'Tailored Solutions for Your Business',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('second_hero_title_control', array(
        'label' => __('Second Hero Title', 'theme_textdomain'),
        'section' => 'second_hero_section',
        'type' => 'text',
    ));

    // Second Hero Content Text
    $wp_customize->add_setting('second_hero_content', array(
        'default' => 'We provide tailored solutions to meet the unique needs of your business.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('second_hero_content_control', array(
        'label' => __('Second Hero Content', 'theme_textdomain'),
        'section' => 'second_hero_section',
        'type' => 'textarea',
    ));

    // Second Hero Image
    $wp_customize->add_setting('second_hero_image', array(
        'default' => 'https://example.com/default-hero.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'second_hero_image_control', array(
        'label' => __('Second Hero Image', 'theme_textdomain'),
        'section' => 'second_hero_section',
        'settings' => 'second_hero_image',
    )));

    // Second Hero Button Text
    $wp_customize->add_setting('second_hero_button_text', array(
        'default' => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('second_hero_button_text_control', array(
        'label' => __('Second Hero Button Text', 'theme_textdomain'),
        'section' => 'second_hero_section',
        'type' => 'text',
    ));

    // Second Hero Button URL
    $wp_customize->add_setting('second_hero_button_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('second_hero_button_url_control', array(
        'label' => __('Second Hero Button URL', 'theme_textdomain'),
        'section' => 'second_hero_section',
        'type' => 'url',
    ));
}

add_action('customize_register', 'customize_second_hero_section');

add_theme_support('customize-selective-refresh-widgets');
