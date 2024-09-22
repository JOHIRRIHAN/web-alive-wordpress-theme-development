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

    <?php
       $args = array('post_type' => 'shopify_web_design', 'posts_per_page' => 10);
       $shopify_query = new WP_Query($args);
       
       if ($shopify_query->have_posts()) :
           echo '<div class="flex flex-col w-full max-w-6xl mx-auto">'; // Wrapper for the cards
       
           while ($shopify_query->have_posts()) : $shopify_query->the_post();
               $image = get_post_meta(get_the_ID(), '_shopify_web_design_image', true);
               $heading = get_post_meta(get_the_ID(), '_shopify_web_design_heading', true);
               $paragraph = get_post_meta(get_the_ID(), '_shopify_web_design_paragraph', true);
               $button_url = get_post_meta(get_the_ID(), '_shopify_web_design_button_url', true);
       
               // Get the current card position (index starts at 0)
               $index = $shopify_query->current_post + 1;
       
               // Set background and text color based on card position (2nd, 4th, 6th are black)
               $bg_color = ($index == 2 || $index == 4 || $index == 6) ? 'bg-black' : 'bg-white';
               $text_color = ($index == 2 || $index == 4 || $index == 6) ? 'text-white' : 'text-black';
               ?>
               
               <div class="<?php echo esc_attr($bg_color); ?> min-h-screen flex items-center justify-center mb-10">
                   <div class="flex flex-col lg:flex-row w-full">
                       <!-- Image Section (60%) -->
                       <div class="w-full lg:w-3/5 flex justify-center lg:justify-end p-5">
                           <img src="<?php echo esc_url($image); ?>" class="max-w-full" />
                       </div>
       
                       <!-- Text Section (40%) -->
                       <div class="w-full lg:w-2/5 flex flex-col justify-center p-5 <?php echo esc_attr($text_color); ?>">
                           <h1 class="text-3xl font-bold"><?php echo esc_html($heading); ?></h1>
                           <p class="py-6">
                               <?php echo esc_html($paragraph); ?>
                           </p>
                           <a href="<?php echo esc_url($button_url); ?>" class="text-2xl font-semibold">
                               Get In Touch <i class='bx bx-right-arrow-alt text-[#f47521]'></i>
                           </a>
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