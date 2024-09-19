<?php
function my_customizer_settings($wp_customize) {
    // Add Hero Section Settings
    $wp_customize->add_section('australias_leading', array(
        'title'    => __('australias_leading Section', 'yourtheme'),
        'priority' => 30,
    ));

    // Add Title Setting
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Australia’s leading <span class="border-b border-orange-500">website</span> design and <span class="border-b border-orange-500">development</span> company',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'yourtheme'),
        'section' => 'australias_leading',
        'type'    => 'textarea',
    ));

    // Add Description Setting
    $wp_customize->add_setting('hero_description', array(
        'default'           => 'WebAlive is a full-service web design and development company in Australia with our head-office situated in Melbourne. We are a team of experienced website designers, developers and digital strategists. Through our bespoke result-driven solutions we deliver measurable outcomes that empower our clients. Since 2003, we have worked with thousands of clients and established ourselves as one of the most trusted online solution providers for businesses in Australia.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_description', array(
        'label'   => __('Hero Description', 'yourtheme'),
        'section' => 'australias_leading',
        'type'    => 'textarea',
    ));
    // Add Descriptions Setting
    $wp_customize->add_setting('hero_descriptions', array(
        'default'           => 'Our ability to build on any platform willingness to adapt to the client’s needs make us the ideal web solutions provider. Working with WebAlive means you can be as hands-on as you wish! While we do have our own growth in mind, our main focus is always to add value to our customers by refining their ideas and realising their goals through our decade-long expertise and experience.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_descriptions', array(
        'label'   => __('Hero Descriptions', 'yourtheme'),
        'section' => 'australias_leading',
        'type'    => 'textarea',
    ));
    // Add hero_Titles Setting
    $wp_customize->add_setting('hero_Titles', array(
        'default'           => 'An experienced and trusted digital agency.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('hero_Titles', array(
        'label'   => __('Hero Titles', 'yourtheme'),
        'section' => 'australias_leading',
        'type'    => 'textarea',
    ));

    // Add Image Setting
    $wp_customize->add_setting('hero_image', array(
        'default'           => get_template_directory_uri() . '/images/counterback.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label'    => __('Hero Image', 'yourtheme'),
        'section'  => 'australias_leading',
        'settings' => 'hero_image',
    )));

    // Add Button Link Setting
    $wp_customize->add_setting('hero_button_link', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_button_link', array(
        'label'   => __('Button Link', 'yourtheme'),
        'section' => 'australias_leading',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'my_customizer_settings');
