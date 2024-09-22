<?php
/*
Template Name: wordpress-development
*/
get_header();
?>
    <!-- Hero Section -->
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                

                    <div class="entry-content ">
                        <?php
                        the_content();
                        ?>
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->
                <?php

            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

    <section class="brand-logos py-20 flex justify-between space-x-8 bg-gray-100">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_1', 'https://www.example.com/default-logo1.png')); ?>" alt="Brand 1" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_2', 'https://www.example.com/default-logo2.png')); ?>" alt="Brand 2" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_3', 'https://www.example.com/default-logo3.png')); ?>" alt="Brand 3" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_4', 'https://www.example.com/default-logo4.png')); ?>" alt="Brand 4" class="h-12">
            <img src="<?php echo esc_url(get_theme_mod('brand_logo_5', 'https://www.example.com/default-logo5.png')); ?>" alt="Brand 5" class="h-12">
    </section>

    <?php
$args = array('post_type' => 'mobile_app', 'posts_per_page' => 10);
$mobile_app_query = new WP_Query($args);

if ($mobile_app_query->have_posts()) :
    echo '<div class="flex flex-col w-full max-w-6xl mx-auto">'; // Wrapper for the cards

    while ($mobile_app_query->have_posts()) : $mobile_app_query->the_post();
        $image = get_post_meta(get_the_ID(), '_mobile_app_image', true);
        $heading = get_post_meta(get_the_ID(), '_mobile_app_heading', true);
        $paragraph = get_post_meta(get_the_ID(), '_mobile_app_paragraph', true);
        $button_url = get_post_meta(get_the_ID(), '_mobile_app_button_url', true);
        
        // Set background color based on card number
        $bg_color = ($mobile_app_query->current_post === 1 || $mobile_app_query->current_post === 3) ? 'bg-black' : 'bg-base-200';
        $text_color = ($mobile_app_query->current_post === 1 || $mobile_app_query->current_post === 3) ? 'text-white' : 'text-black';

        ?>
        <div class="<?php echo esc_attr($bg_color); ?> min-h-screen flex items-center justify-center mb-10">
            <div class="flex flex-col lg:flex-row w-full">
                <!-- Image Section (50%) -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end p-5">
                    <img src="<?php echo esc_url($image); ?>" class="max-w-full" />
                </div>

                <!-- Text Section (50%) -->
                <div class="w-full lg:w-1/2 flex flex-col justify-center p-5 <?php echo esc_attr($text_color); ?>">
                    <h1 class="text-3xl font-bold"><?php echo esc_html($heading); ?></h1>
                    <p class="py-6">
                        <?php echo esc_html($paragraph); ?>
                    </p>
                    <button class="text-2xl font-semibold"><a href="http://localhost/web_alive/contact-us/">Get In Touch <i class='bx bx-right-arrow-alt text-[#f47521]'></i></a></button>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();

    echo '</div>'; // Close wrapper
endif;
?>



    <?php get_footer(); ?>