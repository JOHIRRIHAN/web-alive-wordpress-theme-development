<?php
    function webalive__ecomers2_customize_register($wp_customize) {
        // Section for the Hero
        $wp_customize->add_section('ecommerce_hero_section', array(
            'title' => __('Ecommerce website with one simple goal', 'webalive'),
            'description' => __('Customize the Ecommerce Hero Section'),
            'priority' => 30,
        ));
    
        // Background Image
        $wp_customize->add_setting('hero_bg_image', array(
            'default' => 'https://www.webalive.com.au/wp-content/uploads/2023/09/Ecommerce-website-with-one-simple-goal.png',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image_control', array(
            'label' => __('Hero Background Image', 'webalive'),
            'section' => 'ecommerce_hero_section',
            'settings' => 'hero_bg_image',
        )));
    
        // Title
        $wp_customize->add_setting('hero_title', array(
            'default' => 'Ecommerce website with one simple goal',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control('hero_title_control', array(
            'label' => __('Hero Title', 'webalive'),
            'section' => 'ecommerce_hero_section',
            'settings' => 'hero_title',
            'type' => 'text',
        ));
    
        // Content
        $wp_customize->add_setting('hero_content', array(
            'default' => 'Conversion. You want your ecommerce website to sell, and we are ready to let you take the wheel. Whether it’s your first website or you are aiming to transform your existing site, count on us at every step of the way.',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control('hero_content_control', array(
            'label' => __('Hero Content', 'webalive'),
            'section' => 'ecommerce_hero_section',
            'settings' => 'hero_content',
            'type' => 'textarea',
        ));
    
        // Button Text
        $wp_customize->add_setting('hero_button_text', array(
            'default' => 'Get A Quote',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control('hero_button_text_control', array(
            'label' => __('Button Text', 'webalive'),
            'section' => 'ecommerce_hero_section',
            'settings' => 'hero_button_text',
            'type' => 'text',
        ));
    
        // Button URL
        $wp_customize->add_setting('hero_button_url', array(
            'default' => 'http://localhost/web_alive/contact-us/',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control('hero_button_url_control', array(
            'label' => __('Button URL', 'webalive'),
            'section' => 'ecommerce_hero_section',
            'settings' => 'hero_button_url',
            'type' => 'url',
        ));
    }
    
    add_action('customize_register', 'webalive_customize_register');
    