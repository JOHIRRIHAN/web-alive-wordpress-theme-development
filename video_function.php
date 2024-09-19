<?php

function my_customizer_video_settings($wp_customize) {
    // Add Hero Video Section
    $wp_customize->add_section('hero_video_section', array(
        'title'    => __('Hero Video Section', 'yourtheme'),
        'priority' => 40,
    ));

    // Add Video URL Setting
    $wp_customize->add_setting('hero_video_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_video_url', array(
        'label'   => __('Video URL', 'yourtheme'),
        'section' => 'hero_video_section',
        'type'    => 'text',
        'description' => __('Enter the URL of the video if not uploading.', 'yourtheme'),
    ));

    // Add Video Upload Setting
    $wp_customize->add_setting('hero_video_upload', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'hero_video_upload', array(
        'label'    => __('Upload Video', 'yourtheme'),
        'section'  => 'hero_video_section',
        'settings' => 'hero_video_upload',
    )));

    // Add Text Setting
    $wp_customize->add_setting('hero_video_text', array(
        'default'           => 'We love our customers and they love our work. Over the years, we’ve received overwhelming support, love, and inspiration from our clients.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_video_text', array(
        'label'   => __('Video Section Text', 'yourtheme'),
        'section' => 'hero_video_section',
        'type'    => 'textarea',
    ));

    // Add Additional Text Setting
    $wp_customize->add_setting('hero_video_additional_text', array(
        'default'           => 'Check out what our customers have to say.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_video_additional_text', array(
        'label'   => __('Additional Text', 'yourtheme'),
        'section' => 'hero_video_section',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'my_customizer_video_settings');
