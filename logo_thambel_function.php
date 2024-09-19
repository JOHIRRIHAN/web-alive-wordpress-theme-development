<?php
function web_alive_logo_customize_register($wp_customize) {
    // Section for Logo Thumbnails
    $wp_customize->add_section('logo_thumbnails', array(
        'title'    => __('Logo Thumbnails', 'web_alive'),
        'priority' => 40,
    ));

    // Define and add settings and controls for each logo thumbnail
    $logos = array(
        'echo'      => __('Echo', 'web_alive'),
        'nsw-logo'  => __('NSW Logo', 'web_alive'),
        'remit'     => __('Remit', 'web_alive'),
        'rgs-logo'  => __('RGS Logo', 'web_alive'),
        'rp-data'   => __('RP Data', 'web_alive'),
    );

    foreach ($logos as $slug => $label) {
        // Add the setting
        $wp_customize->add_setting("logo_thumbnail_{$slug}", array(
            'default'           => get_template_directory_uri() . "/images/{$slug}.webp",
            'sanitize_callback' => 'esc_url_raw',
        ));

        // Add the control
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "logo_thumbnail_{$slug}", array(
            'label'    => $label,
            'section'  => 'logo_thumbnails',
            'settings' => "logo_thumbnail_{$slug}",
        )));
    }
}
add_action('customize_register', 'web_alive_logo_customize_register');
?>
