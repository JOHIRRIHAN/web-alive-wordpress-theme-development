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

    <section>
    <div class="">
    <?php
$args = array('post_type' => 'webapp', 'posts_per_page' => 4);
$webapp_query = new WP_Query($args);

if ($webapp_query->have_posts()) :
    echo '<div class="flex flex-col w-full max-w-6xl mx-auto">'; // Wrapper for the cards

    while ($webapp_query->have_posts()) : $webapp_query->the_post();
        $image = get_post_meta(get_the_ID(), '_webapp_image', true);
        $heading = get_post_meta(get_the_ID(), '_webapp_heading', true);
        $paragraph = get_post_meta(get_the_ID(), '_webapp_paragraph', true);
        $button_url = get_post_meta(get_the_ID(), '_webapp_button_url', true);
        
        // Set background color based on card number
        $bg_color = ($webapp_query->current_post === 1 || $webapp_query->current_post === 3) ? 'bg-black' : 'bg-base-200';
        $text_color = ($webapp_query->current_post === 1 || $webapp_query->current_post === 3) ? 'text-white' : 'text-black';

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
                    <button class="text-2xl font-semibold"><a href="<?php echo esc_url($button_url); ?>">Get In Touch <i class='bx bx-right-arrow-alt text-[#f47521]'></i></a></button>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();

    echo '</div>'; // Close wrapper
endif;
?>


    </div>

    </section>


    <?php get_footer(); ?>