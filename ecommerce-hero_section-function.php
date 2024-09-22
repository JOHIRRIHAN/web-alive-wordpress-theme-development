<?php
    function webalive__ecommerce_customize_register($wp_customize) {
        // Section for the Hero
        $wp_customize->add_section('ecommerce-hero_section', array(
            'title' => __('Ecommerce Hero Section', 'webalive'),
            'description' => __('Customize the Ecommerce Hero Section', 'webalive'),
            'priority' => 30,
        ));
    
        // Background Image
        $wp_customize->add_setting('hero_bg_image', array(
            'default' => 'https://www.webalive.com.au/wp-content/uploads/2023/09/ecomerce-banner-up.png',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image_control', array(
            'label' => __('Hero Background Image', 'webalive'),
            'section' => 'ecommerce-hero_section', // Fixing the section ID here
            'settings' => 'hero_bg_image',
        )));
    
        // Title
        $wp_customize->add_setting('hero_title', array(
            'default' => 'Get an ecommerce website that sells more and drives higher ROI',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control('hero_title_control', array(
            'label' => __('Hero Title', 'webalive'),
            'section' => 'ecommerce-hero_section', // Fixing the section ID here
            'settings' => 'hero_title',
            'type' => 'text',
        ));
    
        // Button Text
        $wp_customize->add_setting('hero_button_text', array(
            'default' => 'View all Portfolio',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control('hero_button_text_control', array(
            'label' => __('Button Text', 'webalive'),
            'section' => 'ecommerce-hero_section', // Fixing the section ID here
            'settings' => 'hero_button_text',
            'type' => 'text',
        ));
    
        // Button URL
        $wp_customize->add_setting('hero_button_url', array(
            'default' => '#',
            'transport' => 'refresh',
        ));
    
        $wp_customize->add_control('hero_button_url_control', array(
            'label' => __('Button URL', 'webalive'),
            'section' => 'ecommerce-hero_section', // Fixing the section ID here
            'settings' => 'hero_button_url',
            'type' => 'url',
        ));
    }
    
    add_action('customize_register', 'webalive_customize_register');