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
    $args = array('post_type' => 'website_design', 'posts_per_page' => 4);
    $website_design_query = new WP_Query($args);
    
    if ($website_design_query->have_posts()) :
        echo '<div class="flex flex-col w-full max-w-6xl mx-auto">'; // Wrapper for the cards
    
        while ($website_design_query->have_posts()) : $website_design_query->the_post();
            $image = get_post_meta(get_the_ID(), '_website_design_image', true);
            $heading = get_post_meta(get_the_ID(), '_website_design_heading', true);
            $paragraph = get_post_meta(get_the_ID(), '_website_design_paragraph', true);
            $button_url = get_post_meta(get_the_ID(), '_website_design_button_url', true);
    
            // Set background color based on card number
            $bg_color = ($website_design_query->current_post % 2 === 1) ? 'bg-black' : 'bg-base-200';
            $text_color = ($website_design_query->current_post % 2 === 1) ? 'text-white' : 'text-black';
    
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

    <section class="my-10">
        <div class="text-center my-10 px-20">
            <h3 class="text-5xl font-bold my-10">WooCommerce development services: Empower your online store</h3>
            <p class="font-bold">If you want to establish a successful ecommerce business, WebAlive offers comprehensive WooCommerce development services. With our WordPress and ecommerce solutions expertise, we can create a fully functional and visually stunning online store that maximises your sales potential.</p>
        </div>
        <?php
            $args = array(
                'post_type' => 'woocommerce_service',
                'posts_per_page' => -1,
            );
            $services = new WP_Query($args);
            ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mx-10">
                <?php if ($services->have_posts()) : while ($services->have_posts()) : $services->the_post(); 
                    $icon_class = get_post_meta(get_the_ID(), '_woocommerce_icon_class', true);
                    $service_title = get_post_meta(get_the_ID(), '_woocommerce_service_title', true);
                    $service_description = get_post_meta(get_the_ID(), '_woocommerce_service_description', true);
                ?>
                <div class="bg-black text-white p-5">
                    <i class="<?php echo esc_attr($icon_class); ?> text-5xl bg-[#f47521] my-10"></i>
                    <h3 class="text-3xl font-bold "><?php echo esc_html($service_title); ?></h3>
                    <p class="my-5"><?php echo esc_html($service_description); ?></p>
                </div>
                <?php endwhile; else: ?>
                    <p>No services found</p>
                <?php endif; wp_reset_postdata(); ?>
            </div>

    </section>


    <?php get_footer(); ?>