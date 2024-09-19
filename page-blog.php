<?php
/*
Template Name: about
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
    <h3>search</h3>
    <h3>catagory</h3>


    <div>
        <?php
            $args = array(
                'post_type' => 'blog_hero',
                'posts_per_page' => 1,
            );
            $blog_hero_query = new WP_Query($args);

            if ($blog_hero_query->have_posts()) :
                while ($blog_hero_query->have_posts()) : $blog_hero_query->the_post();
                    $image_url = get_post_meta(get_the_ID(), '_blog_hero_image_url', true);
                    $heading = get_post_meta(get_the_ID(), '_blog_hero_heading', true);
                    $paragraph = get_post_meta(get_the_ID(), '_blog_hero_paragraph', true);
                    $title = get_post_meta(get_the_ID(), '_blog_hero_title', true);
                    ?>

                    <div class="hero bg-base-200 min-h-screen">
                        <div class="hero-content flex flex-col lg:flex-row lg:items-center">
                            <?php if ($image_url) : ?>
                                <img src="<?php echo esc_url($image_url); ?>" class="w-full lg:w-1/2 object-cover" alt="Blog Hero Image"/>
                            <?php endif; ?>
                            <div class="w-full lg:w-1/2 lg:px-10 mt-6 lg:mt-0">
                                <?php if ($heading) : ?>
                                    <div class="flex items-center">
                                    <a class="text-xl font-semibold hover:text-orange-500 my-10"><?php echo esc_html($heading); ?></a>
                                    <hr class="border-t-2 border-black my-2 w-96 ">
                                    </div>
                                <?php endif; ?>
                                <?php if ($title) : ?>
                                    <a class="text-5xl font-bold block hover:text-orange-500 cursor-pointer my-4"><?php echo esc_html($title); ?></a>
                                <?php endif; ?>
                                <?php if ($paragraph) : ?>
                                    <p class="py-6"><?php echo wp_kses_post($paragraph); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No Blog Hero content found</p>';
            endif;
            ?>


    </div>
    
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 px-20">
        <?php
            $args = array(
                'post_type' => 'blog_post',  // The slug of your custom post type
                'posts_per_page' => 10,      // Adjust as needed
            );
            $blog_post_query = new WP_Query($args);

            if ($blog_post_query->have_posts()) :
                while ($blog_post_query->have_posts()) : $blog_post_query->the_post(); 
                    $image_url = get_post_meta(get_the_ID(), '_blog_post_image_url', true);
                    $heading = get_post_meta(get_the_ID(), '_blog_post_heading', true);
                    $paragraph = get_post_meta(get_the_ID(), '_blog_post_paragraph', true);
                    $title = get_post_meta(get_the_ID(), '_blog_post_title', true);
                    ?>
                        <div class="w-full md:w-1/3">
                            <div class="bg-blue-500 rounded-md shadow-md overflow-hidden group">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($heading); ?>" class="w-full transform group-hover:scale-105 transition-transform duration-300 ease-in-out">
                            </div>
                            <div class="my-5">
                                <h3 class=""><?php echo esc_html($title); ?></h3>
                                <p class="text-gray-600 text-2xl font-bold my-5"><?php echo esc_html($heading); ?></p>
                                <p class="text-gray-500"><?php echo esc_html($paragraph); ?></p>
                            </div>
                        </div>
                    
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo 'No posts found';
            endif;
        ?>
    </div>


</section>



<?php get_footer(); ?>