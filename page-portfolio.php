<?php
/*
Template Name: portfolio
*/
get_header();

?>
      
<!-- hero section  -->
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               

                <div class="entry-content">
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

    <!-- Our Project -->
    <section class="our-project  border w-full min-h-screen">

        <div class="">
        <div class="flex  my-10">
              <!-- Filter Links -->
            <a class="filter-link mx-5 text-xl active:font-bold" href="#" data-filter="all">All</a>
            <a class="filter-link mx-5 text-xl active:font-bold" href="#" data-filter="development">Development</a>
            <a class="filter-link mx-5 text-xl active:font-bold" href="#" data-filter="ecommerce">Ecommerce</a>
            <a class="filter-link mx-5 text-xl active:font-bold" href="#" data-filter="web-design">Web Design</a>
            <a class="filter-link mx-5 text-xl active:font-bold" href="#" data-filter="web-development">Web Development</a>
        </div>
        </div>
        <div class="">
        <?php
$args = array(
    'post_type' => 'recent_project',
    'posts_per_page' => 4,
);
$projects_query = new WP_Query($args);

if ($projects_query->have_posts()) :
    ?>
    <div class="px-20 w-full min-h-screen">
        <?php
        while ($projects_query->have_posts()) : $projects_query->the_post();
            $project_category = get_post_meta(get_the_ID(), '_project_category', true);
            $project_title = get_post_meta(get_the_ID(), '_project_title', true);
            $project_description = get_post_meta(get_the_ID(), '_project_description', true);
            $project_technology = get_post_meta(get_the_ID(), '_project_technology', true);
            $project_industry = get_post_meta(get_the_ID(), '_project_industry', true);
            $project_button_text = get_post_meta(get_the_ID(), '_project_button_text', true);
            $project_image_id = get_post_meta(get_the_ID(), '_project_image_id', true);
            $project_image_url = $project_image_id ? wp_get_attachment_url($project_image_id) : '';

            // Get the current post index (starts from 0)
            $is_even = ($projects_query->current_post % 2 === 0);
            ?>
            <div class="bg-white  rounded-lg w-full my-10 h-full gap-10 flex <?php echo $is_even ? '' : 'lg:flex-row-reverse'; ?>">
                <!-- Image Section -->
                <div class="group relative overflow-hidden w-full lg:w-1/2">
                    <figure class="transition-transform duration-500 ease-in-out transform group-hover:scale-110">
                        <?php if ($project_image_url) : ?>
                            <img src="<?php echo esc_url($project_image_url); ?>" alt="<?php echo esc_attr($project_title); ?>" class="w-full h-auto" />
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/default-placeholder.png" alt="Default Image" class="w-full h-auto" />
                        <?php endif; ?>
                    </figure>
                </div>
                
                <!-- Text Section -->
                <div class="p-5 w-full lg:w-1/2">
                    <div class="flex items-center">
                        <h3 class="text-xl font-semibold text-gray-800 flex"><?php echo esc_html($project_category); ?></h3>
                        <hr class=" w-72 border-black">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 my-10"><?php echo esc_html($project_title); ?></h2>

                    <p class="text-gray-700 mt-4 w-96"><?php echo esc_html($project_description); ?></p>
                    <hr class="border-black my-5">
                    <div class="flex gap-4 my-10">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Technology</h4>
                            <p class="text-gray-700"><?php echo esc_html($project_technology); ?></p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">Industry</h4>
                            <p class="text-gray-700"><?php echo esc_html($project_industry); ?></p>
                        </div>
                    </div>
                    <hr class="border-black my-5">
                    <a href="<?php the_permalink(); ?>" class="block text-lg font-bold text-black border-b-2 border-black py-2 px-4 mt-6 rounded">
                        <?php echo esc_html($project_button_text); ?>
                    </a>
                </div>
            </div>
            <?php
        endwhile;
        ?>
    </div>
    <?php
    wp_reset_postdata();
else :
    ?>
    <p class="text-center text-gray-500">No projects found</p>
    <?php
endif;
?>


        </div>
    
    </section>





<?php get_footer(); ?>

