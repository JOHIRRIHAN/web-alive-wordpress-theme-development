<?php
function mytheme_customize_register($wp_customize) {
    // Add setting for button text
    $wp_customize->add_setting('button_text', array(
        'default'   => 'Contact US',
        'transport' => 'refresh',
    ));

    // Add control for button text
    $wp_customize->add_control('button_text', array(
        'label'    => __('Button Text', 'mytheme'),
        'section'  => 'title_tagline',
        'type'     => 'text',
    ));

    // Add setting for button URL
    $wp_customize->add_setting('button_url', array(
        'default'   => '#',
        'transport' => 'refresh',
    ));

    // Add control for button URL
    $wp_customize->add_control('button_url', array(
        'label'    => __('Button URL', 'mytheme'),
        'section'  => 'title_tagline',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'mytheme_customize_register');
