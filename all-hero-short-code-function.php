<?php
  // short code is here in all hero section 
  function webalive_hero_section_shortcode($atts) {
    // Define default attributes
    $atts = shortcode_atts(array(
        'title' => 'Online marketing strategies & campaigns to boost your business.',
        'button_text' => 'Get a free consultation',
        'button_url' => '#',
        'image_url' => 'https://www.webalive.com.au/wp-content/uploads/2019/09/pey-per-click-2.jpg'
    ), $atts, 'hero_section');

    // Generate the HTML output
    return '<section class="hero-section bg-black text-white p-12 flex items-center">
                <div class="w-1/2 p-5">
                    <h1 class="hero-title ">' . esc_html($atts['title']) . '</h1>
                    <a href="' . esc_url($atts['button_url']) . '" class="text-xl font-semibold mt-10 bg-black text-white border-2 border-white px-10 py-5 rounded">
                        ' . esc_html($atts['button_text']) . '
                    </a>
                </div>
                <div class="w-1/2">
                    <img src="' . esc_url($atts['image_url']) . '" alt="Hero Image" class="w-full h-auto">
                </div>
            </section>';
}
add_shortcode('hero_service_section', 'webalive_hero_section_shortcode');
