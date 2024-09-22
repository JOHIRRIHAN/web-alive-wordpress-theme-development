<?php
function dynamic_logo_section_shortcode($atts) {
    // Set default values for the images
    $atts = shortcode_atts(
        array(
            'img1' => '',
            'img2' => '',
            'img3' => '',
            'img4' => '',
            'img5' => '',
        ),
        $atts,
        'dynamic_logo_section'
    );

    // Start output buffering
    ob_start();
    ?>
    <section class="flex items-center justify-between mx-10 py-20">
        <img src="<?php echo esc_url($atts['img1']); ?>" alt="logo img">
        <img src="<?php echo esc_url($atts['img2']); ?>" alt="logo img">
        <img src="<?php echo esc_url($atts['img3']); ?>" alt="logo img">
        <img src="<?php echo esc_url($atts['img4']); ?>" alt="logo img">
        <img src="<?php echo esc_url($atts['img5']); ?>" alt="logo img">
    </section>
    <?php
    // Return the output
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('dynamic_logo_section', 'dynamic_logo_section_shortcode');
