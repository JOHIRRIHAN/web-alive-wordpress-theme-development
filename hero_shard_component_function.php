<?php
function recent_work2_shortcode($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(
        array(
            'heading'    => '',
            'sub-heading'    => '',
            'paragraph'  => '',
        ),
        $atts,
        'recent_work2'
    );

    // Output the HTML for the shortcode
    ob_start();
    ?>
    <div class="py-20 sm:px-3 lg:px-8 z-10 h-full bg-black md:text-left">
        <div class="text-white md:w-[70%] pt-20">
            <h3 class="sm:text-4xl md:text-4xl lg:text-6xl font-bold md:leading-tight my-8 lg:my-0 lg:mb-6">
                <?php echo esc_html($atts['heading']); ?>
                <strong class="border-b-2 border-orange-500"><?php echo esc_html($atts['sub-heading']); ?></strong>
            </h3>
            <p class="md:text-lg my-8 lg:my-0 lg:mb-4">
                <?php echo esc_html($atts['paragraph']); ?>
            </p>
           
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('recent_work2', 'recent_work2_shortcode');

