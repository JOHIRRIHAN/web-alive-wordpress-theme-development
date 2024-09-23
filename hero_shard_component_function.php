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
    <div class="py-10 md:py-20 px-4 sm:px-3 lg:px-8 z-10 h-full bg-black text-center md:text-left">
    <div class="text-white w-full sm:w-[90%] md:w-[80%] lg:w-[70%] mx-auto pt-5 lg:pt-20">
        <h3 class="text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold leading-tight my-8 lg:my-0 lg:mb-6">
            <?php echo esc_html($atts['heading']); ?>
            <strong class="block sm:inline border-b-2 border-orange-500"><?php echo esc_html($atts['sub-heading']); ?></strong>
        </h3>
        <p class="text-base sm:text-lg md:text-lg lg:text-xl my-4 lg:my-0  lg:mb-4">
            <?php echo esc_html($atts['paragraph']); ?>
        </p>
    </div>
</div>

    <?php
    return ob_get_clean();
}
add_shortcode('recent_work2', 'recent_work2_shortcode');

