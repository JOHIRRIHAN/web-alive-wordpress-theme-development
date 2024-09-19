<?php
/*
Template Name: wordpress-development
*/
get_header();
?>
  
    <main>
        <section class="hero-section bg-black text-white p-12 flex items-center">
            <div class="w-1/2 p-5">
                <h1 class="hero-title">
                    <?php echo get_theme_mod('second_hero_title', 'Tailored Solutions for Your Business'); ?>
                </h1>
                <a href="<?php echo esc_url(get_theme_mod('second_hero_button_url', '#')); ?>" class="text-xl font-semibold mt-6 bg-black text-white border-2 border-white px-10 py-5 rounded">
                    <?php echo get_theme_mod('second_hero_button_text', 'Learn More'); ?> →
                </a>
            </div>
            <div class="w-1/2">
                <img src="<?php echo esc_url(get_theme_mod('second_hero_image', 'https://example.com/default-hero.jpg')); ?>" alt="Second Hero Image" class="w-full h-auto">
            </div>
        </section>

        <section class="brand-logos py-20 flex justify-between space-x-8 bg-gray-100">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_1', 'https://www.example.com/default-logo1.png')); ?>" alt="Brand 1" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_2', 'https://www.example.com/default-logo2.png')); ?>" alt="Brand 2" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_3', 'https://www.example.com/default-logo3.png')); ?>" alt="Brand 3" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_4', 'https://www.example.com/default-logo4.png')); ?>" alt="Brand 4" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_5', 'https://www.example.com/default-logo5.png')); ?>" alt="Brand 5" class="h-12">
        </section>


        <section>
        <?php
$service_query = new WP_Query(array('post_type' => 'web_design_service'));

if ($service_query->have_posts()) :
    $counter = 0; // Initialize a counter to track post number

    while ($service_query->have_posts()) : $service_query->the_post();
        $service_title = get_post_meta(get_the_ID(), '_service_title', true);
        $service_paragraph = get_post_meta(get_the_ID(), '_service_paragraph', true);
        $service_button_text = get_post_meta(get_the_ID(), '_service_button_text', true);
        $service_button_url = get_post_meta(get_the_ID(), '_service_button_url', true);
        $service_image = get_post_meta(get_the_ID(), '_service_image', true);

        // Increment counter
        $counter++;

        // Check if the counter is even or odd
        $is_even = $counter % 2 === 0;

        // Check if it's the second post to apply a black background
        $bg_class = ($counter === 2) ? 'bg-black text-white' : 'bg-base-200';
        ?>

        <div class="hero <?php echo $bg_class; ?> min-h-screen">
            <div class="hero-content flex flex-col lg:flex-row<?php echo $is_even ? '' : '-reverse'; ?> items-center lg:items-start">
                
                <!-- Image Section (50%) -->
                <div class="w-full lg:w-1/2">
                    <img src="<?php echo esc_url($service_image); ?>" class="w-full h-auto rounded-lg shadow-2xl" alt="Service Image" />
                </div>

                <!-- Text/Article Section (50%) -->
                <div class="w-full lg:w-1/2 px-8 lg:px-12">
                    <h1 class="text-4xl font-bold"><?php echo esc_html($service_title); ?></h1>
                    <p class="py-6"><?php echo esc_html($service_paragraph); ?></p>
                    <a href="<?php echo esc_url($service_button_url); ?>" class="text-xl font-semibold items-center">
                        <?php echo esc_html($service_button_text); ?> <i class='bx bx-right-arrow-alt text-orange-500 text-2xl'></i>
                    </a>
                </div>

            </div>
        </div>

        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>

        </section>



    </main>

 <?php get_footer(); ?>