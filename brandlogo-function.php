<?php
 function customize_brand_logos($wp_customize) {
    // Create a section for brand logos
    $wp_customize->add_section('brand_logos_section', array(
        'title' => __('Brand Logos', 'theme_textdomain'),
        'description' => __('Modify the brand logos', 'theme_textdomain'),
        'priority' => 30,
    ));

    // Add settings and controls for each logo
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("brand_logo_$i", array(
            'default' => "https://www.example.com/default-logo$i.png",
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "brand_logo_${i}_control", array(
            'label' => __("Brand Logo $i", 'theme_textdomain'),
            'section' => 'brand_logos_section',
            'settings' => "brand_logo_$i",
        )));
    }
}

add_action('customize_register', 'customize_brand_logos');
