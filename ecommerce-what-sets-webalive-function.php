<?php
 function webalive_customize_register($wp_customize) {
    // Section for "What sets WebAlive apart from the rest?"
    $wp_customize->add_section('webalive_unique_section', array(
        'title' => __('What sets WebAlive apart from the rest?', 'webalive'),
        'description' => __('Customize the unique section'),
        'priority' => 30,
    ));

    // Title
    $wp_customize->add_setting('unique_section_title', array(
        'default' => 'What sets WebAlive apart from the rest?',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('unique_section_title_control', array(
        'label' => __('Section Title', 'webalive'),
        'section' => 'webalive_unique_section',
        'settings' => 'unique_section_title',
        'type' => 'text',
    ));

    // Description
    $wp_customize->add_setting('unique_section_description', array(
        'default' => 'Bringing a website design to life demands a diverse professional team. Trust us. With 19 years of experience and a consistent track record, we are well-versed in the field.',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('unique_section_description_control', array(
        'label' => __('Section Description', 'webalive'),
        'section' => 'webalive_unique_section',
        'settings' => 'unique_section_description',
        'type' => 'textarea',
    ));

    // Image
    $wp_customize->add_setting('unique_section_image', array(
        'default' => 'https://www.webalive.com.au/wp-content/uploads/2023/09/wswa.png',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'unique_section_image_control', array(
        'label' => __('Section Image', 'webalive'),
        'section' => 'webalive_unique_section',
        'settings' => 'unique_section_image',
    )));

    // Texts for Left and Right Sections
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("unique_section_text_$i", array(
            'default' => "Top local expert $i", // Example text, change as needed
            'transport' => 'refresh',
        ));
        $wp_customize->add_control("unique_section_text_{$i}_control", array(
            'label' => __("Text Block $i", 'webalive'),
            'section' => 'webalive_unique_section',
            'settings' => "unique_section_text_$i",
            'type' => 'text',
        ));
    }
}
add_action('customize_register', 'webalive_customize_register');
