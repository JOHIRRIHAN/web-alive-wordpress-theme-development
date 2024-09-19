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
<!-- Online success made simple. That has been our slogan and vision since 2003 -->
<section class="w-full min-h-screen">
    <div class="container ">
        <?php
        $args = array(
            'post_type' => 'about_us',
            'posts_per_page' => 1,
        );
        $about_us_query = new WP_Query($args);

        if ($about_us_query->have_posts()) :
            while ($about_us_query->have_posts()) : $about_us_query->the_post();
                $section_title = get_post_meta(get_the_ID(), '_section_title', true);
                $paragraph_one = get_post_meta(get_the_ID(), '_paragraph_one', true);
                $paragraph_two = get_post_meta(get_the_ID(), '_paragraph_two', true);
                $paragraph_three = get_post_meta(get_the_ID(), '_paragraph_three', true);
                $image_url = get_post_meta(get_the_ID(), '_image_url', true);
                ?>

                <h3 class="text-5xl p-5 font-bold -tracking-tighter leading-tight">
                    <?php echo esc_html($section_title); ?>
                </h3>

                <p class="text-xl mt-20 text-container"><?php echo wp_kses_post($paragraph_one); ?></p>
                <p class="my-8 text-xl text-container"><?php echo wp_kses_post($paragraph_two); ?></p>
                <p class="text-xl text-container"><?php echo wp_kses_post($paragraph_three); ?></p>

                <div class="mt-20">
                    <?php if ($image_url) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="About Us Cover">
                    <?php endif; ?>
                </div>

            <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No content found</p>';
        endif;
        ?>
    </div>
</section>
<!-- mission vission -->
<section>
    <div class="my-20">
        <?php
        // Query for Vision posts
        $args = array(
            'post_type' => 'vision',
            'posts_per_page' => 1,
        );
        $vision_query = new WP_Query($args);

        if ($vision_query->have_posts()) :
            while ($vision_query->have_posts()) : $vision_query->the_post();
                $vision_image_url = get_post_meta(get_the_ID(), '_vision_image_url', true);
                $vision_content = get_post_meta(get_the_ID(), '_vision_content', true);
                ?>

                <div class="hero bg-base-200 min-h-full">
                    <div class="hero-content flex-col lg:flex-row">
                        <?php if ($vision_image_url) : ?>
                            <img src="<?php echo esc_url($vision_image_url); ?>" class="max-w-sm" />
                        <?php endif; ?>
                        <div class="border-style">
                            <h1 class="text-5xl font-bold">Vision</h1>
                            <p class="py-6"><?php echo wp_kses_post($vision_content); ?></p>
                        </div>
                    </div>
                </div>

            <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No Vision content found</p>';
        endif;
        ?>

<?php
// Query for Vision posts
$args = array(
    'post_type' => 'vision',
    'posts_per_page' => 1,
);
$vision_query = new WP_Query($args);

if ($vision_query->have_posts()) :
    while ($vision_query->have_posts()) : $vision_query->the_post();
        $vision_image_url = get_post_meta(get_the_ID(), '_vision_image_url', true);
        $vision_content = get_post_meta(get_the_ID(), '_vision_content', true);
        ?>

        <div class="hero bg-base-200 min-h-full">
            <div class="hero-content flex-col lg:flex-row">
                <?php if ($vision_image_url) : ?>
                    <img src="<?php echo esc_url($vision_image_url); ?>" class="max-w-sm" alt="Vision Image" />
                <?php else : ?>
                    <p>No image available.</p>
                <?php endif; ?>
                <div>
                    <h1 class="text-5xl font-bold">Vision</h1>
                    <p class="py-6"><?php echo wp_kses_post($vision_content); ?></p>
                </div>
            </div>
        </div>

        <?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No Vision content found</p>';
endif;
?>

<?php
// Query for Mission posts
$args = array(
    'post_type' => 'mission',
    'posts_per_page' => 1,
);
$mission_query = new WP_Query($args);

if ($mission_query->have_posts()) :
    while ($mission_query->have_posts()) : $mission_query->the_post();
        $mission_image_url = get_post_meta(get_the_ID(), '_mission_image_url', true);
        $mission_content = get_post_meta(get_the_ID(), '_mission_content', true);
        ?>

        <div class="hero bg-base-200 min-h-full">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <?php if ($mission_image_url) : ?>
                    <img src="<?php echo esc_url($mission_image_url); ?>" class="max-w-sm" alt="Mission Image" />
                <?php else : ?>
                    <p>No image available.</p>
                <?php endif; ?>
                <div>
                    <h1 class="text-5xl font-bold">Mission</h1>
                    <p class="py-6"><?php echo wp_kses_post($mission_content); ?></p>
                </div>
            </div>
        </div>

        <?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No Mission content found</p>';
endif;
?>
    </div>

    <div class="flex items-center justify-between exprience-card">
        <div>
            <h3 class="text-5xl font-bold text-center">15+</h3>
            <p class="text-xl mt-8 text-center">Years of Experience</p>
        </div>
        <div>
            <h3 class="text-5xl font-bold text-center">1000+</h3>
            <p class="text-xl mt-8 text-center">Successful Projects</p>
        </div>
        <div>
            <h3 class="text-5xl font-bold text-center">100%</h3>
            <p class="text-xl mt-8 text-center">On Time Delivery</p>
        </div>
    </div>
</section>

<section class="w-full h-screen bg-black text-white">
    <h3 class="value-title">Our Values</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 px-10">
        <?php
        $args = array(
            'post_type' => 'values',
            'posts_per_page' => -1,
            'order' => 'ASC',
        );
        $values_query = new WP_Query($args);
        if ($values_query->have_posts()) :
            while ($values_query->have_posts()) : $values_query->the_post();
                $value_number = get_post_meta(get_the_ID(), '_value_number', true);
                $value_icon_url = get_post_meta(get_the_ID(), '_value_icon_url', true);
                $value_title = get_post_meta(get_the_ID(), '_value_title', true); // New field
                $value_description = get_post_meta(get_the_ID(), '_value_description', true); // New field
                ?>
                <div class="w-96">
                    <div class="flex items-center">
                        <h6 class="font-bold"><?php echo esc_html($value_number); ?></h6>
                        <hr class="w-96">
                    </div>
                    <?php if ($value_icon_url) : ?>
                        <img src="<?php echo esc_url($value_icon_url); ?>" alt="<?php echo esc_attr($value_title); ?>" class="w-12 my-10">
                    <?php endif; ?>
                    <h3 class="text-4xl font-bold "><?php echo esc_html($value_title); ?></h3>
                    <p class="my-5"><?php echo wp_kses_post($value_description); ?></p>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No values found</p>';
        endif;
        ?>
    </div>
</section>

<section class="px-10 my-20">
    <h3 class="tools-title">Our Tools & Technologies</h3>
    <p class="text-xl my-10">Our multidisciplinary team and industry partners give you access to an extensive network of services, tools, and technologies.</p>

    <div class="pt-20 grid grid-cols-3 gap-10">
        <?php
        $args = array(
            'post_type' => 'tools',
            'posts_per_page' => -1,
            'order' => 'ASC',
        );
        $tools_query = new WP_Query($args);
        if ($tools_query->have_posts()) :
            while ($tools_query->have_posts()) : $tools_query->the_post();
                $tool_image_url = get_post_meta(get_the_ID(), '_tool_image_url', true);
                ?>
                <?php if ($tool_image_url) : ?>
                    <img src="<?php echo esc_url($tool_image_url); ?>" alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No tools found</p>';
        endif;
        ?>
    </div>
</section>


<?php get_footer(); ?>