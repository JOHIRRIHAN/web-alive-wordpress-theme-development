<!DOCTYPE html>
<html lang="<?php language_attributes( ); ?>" class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>./images/favicon.webp" type="image/x-icon">
    <link href="./src/output.css" rel="stylesheet">
    <!-- Boxicons for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <style>
        .btn-text-style {
            font-size: 20px;
            font-weight: 700;
            background: #f47521;
            padding: 10px 25px;
            color: #ffffff; /* Ensure text is visible on the background */
            border: none; /* Remove default border if needed */
            text-align: center; /* Center text */
            cursor: pointer; /* Change cursor to pointer */
            transition: background 0.3s ease; /* Smooth transition for background change */
        }

        .btn-text-style:hover {
            background: white;
            color: #f47521; /* Optional: change text color on hover */
        }

    </style>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php
    $hero_args = array(
        'post_type' => 'hero_section',
        'posts_per_page' => 1,
    );
    
    $hero_query = new WP_Query($hero_args);
    
    if ($hero_query->have_posts()) :
        while ($hero_query->have_posts()) : $hero_query->the_post();
            $hero_video_url = get_post_meta(get_the_ID(), 'hero_video_url', true);
            $hero_video_upload = get_post_meta(get_the_ID(), 'hero_video_upload', true);
            $hero_title = get_post_meta(get_the_ID(), 'hero_title', true);
            $hero_subtitle = get_post_meta(get_the_ID(), 'hero_subtitle', true);
            $hero_button_text = get_post_meta(get_the_ID(), 'hero_button_text', true);
            $hero_button_url = get_post_meta(get_the_ID(), 'hero_button_url', true);
    ?>
    <!-- Header Section -->
    <div class="relative w-full h-screen overflow-hidden">
        <!-- Background Video -->
        <video class="absolute inset-0 object-cover w-full h-full -z-10" autoplay muted loop>
            <source src="<?php echo esc_url($hero_video_upload ?: $hero_video_url); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Black Overlay -->
        <div class="absolute inset-0 bg-black opacity-70 -z-10"></div>

        <!-- Navbar -->
        <div id="navbar" class="navbar text-white bg-opacity-70 transition-all duration-300 ease-in-out">
                    <!-- Mobile Menu Toggle -->
                    <div class="navbar-start">
                        <div class="dropdown">
                            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                                </svg>
                            </div>
                            <?php
                                // Display the mobile menu
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class'     => 'menu menu-md dropdown-content z-50 rounded-box mt-3 w-72 md:w-[500px] bg-black text-white p-2 shadow',
                                    'container'      => false,
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker'         => new Tailwind_Nav_Walker(), // Use the custom walker here

                                ));
                            ?>
                        </div>
                        <a class="btn btn-ghost w-52 md:w-72 h-20 lg:w-60 xl:w-72">
                    <img src="<?php echo esc_url(get_theme_mod('custom_logo')); ?>" alt="company-logo-color">
                        </a>

                    </div>

                    <!-- Desktop Menu -->
                    <div class="navbar-center hidden lg:flex pt-5">
                        <?php
                            // Display the desktop menu
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class'     => 'menu menu-horizontal px-1 text-xl font-semibold gap-x-6',
                                'container'      => false,
                                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'walker'         => new Tailwind_Nav_Walker(), // Use the custom walker here

                            ));
                        ?>
                        
                        <a class="btn-text-style" href="<?php echo esc_url(get_theme_mod('button_url', '#')); ?>" class="flex items-center">
                    <?php echo esc_html(get_theme_mod('button_text', 'Contact US')); ?>
                    <!-- Right Arrow Icon (Font Awesome) -->
                    <i class="fas fa-arrow-right ml-2"></i>

                </a>


                    </div>
                </div>
        <!-- End of Navbar -->
    
        <!-- Hero Section -->
        <div class=" px-4 sm:px-3 lg:px-8 z-10 h-full md:text-left">
            <div class="text-white md:w-[50%]">
                <p class="md:text-lg my-8 lg:my-0 lg:mb-4"><?php echo esc_html($hero_subtitle); ?></p>
                <h3 class="sm:text-4xl md:text-4xl lg:text-6xl font-bold md:leading-tight my-8 lg:my-0 lg:mb-6"><?php echo esc_html($hero_title); ?></h3>
                <a href="<?php echo esc_url($hero_button_url); ?>">
                    <button class="text-white border-2 border-white px-4 md:px-6 py-3 flex items-center justify-center text-lg lg:mt-10 font-semibold hover:bg-white hover:text-black ">
                    <?php echo esc_html($hero_button_text); ?> <i class='bx bx-right-arrow-alt text-2xl pl-4'></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>

    <!-- Logo Thumbnails -->
    <section class="mx-5 md:mx-20 my-10">
        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <img src="<?php echo esc_url(get_theme_mod('logo_thumbnail_echo', get_template_directory_uri() . '/images/echo.webp')); ?>" alt="echo" class="w-32 h-auto">
            <img src="<?php echo esc_url(get_theme_mod('logo_thumbnail_nsw-logo', get_template_directory_uri() . '/images/nsw-logo.webp')); ?>" alt="nsw-logo" class="w-32 h-auto">
            <img src="<?php echo esc_url(get_theme_mod('logo_thumbnail_remit', get_template_directory_uri() . '/images/remit.webp')); ?>" alt="remit" class="w-32 h-auto">
            <img src="<?php echo esc_url(get_theme_mod('logo_thumbnail_rgs-logo', get_template_directory_uri() . '/images/rgs-logo.webp')); ?>" alt="rgs-logo" class="w-32 h-auto">
            <img src="<?php echo esc_url(get_theme_mod('logo_thumbnail_rp-data', get_template_directory_uri() . '/images/rp-data.webp')); ?>" alt="rp-data" class="w-32 h-auto">
        </div>
    </section>

    <hr class="mx-5 md:mx-20 border">

    <!-- Our Services -->
    <section class="h-full mx-5 md:mx-10">
        <h3 class="text-5xl my-10 md:my-20 font-semibold">Our Services</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-10">
        <?php
        // Query for custom post type 'service'
        $args = array(
            'post_type' => 'service',
            'posts_per_page' => 3,
        );
        $services_query = new WP_Query($args);

        // Check if there are any posts
        if ($services_query->have_posts()) :
            while ($services_query->have_posts()) : $services_query->the_post();
                // Get custom fields
                $button_text = get_post_meta(get_the_ID(), '_service_button_text', true);
                $button_url = get_post_meta(get_the_ID(), '_service_button_url', true);
                $image_id = get_post_meta(get_the_ID(), '_service_image_id', true);
                $image_url = $image_id ? wp_get_attachment_image_src($image_id, 'full')[0] : get_template_directory_uri() . '/images/default-placeholder.png';
                ?>
                <div class="">
                    <img class="w-16 h-auto" src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
                    <h3 class="text-4xl font-semibold my-4"><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                    <?php if ($button_text && $button_url) : ?>
                        <a href="<?php echo esc_url($button_url); ?>">
                            <button class="font-bold border-b border-black my-5"><?php echo esc_html($button_text); ?></button>
                        </a>
                    <?php endif; ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No services found</p>';
        endif;
        ?>
    </div>

    </section>


    <hr class="mx-10 my-10 border border-gray-600">
    <!-- Featured Project -->
    <section class="h-full mx-5 md:mx-10">
        <h3 class="text-3xl md:text-5xl my-10 md:my-20 font-semibold">Featured Projects</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <?php
            // Query for custom post type 'project'
            $args = array(
                'post_type' => 'project',
                'posts_per_page' => 4, // Adjust the number of posts as needed
            );
            $projects_query = new WP_Query($args);

            // Check if there are any posts
            if ($projects_query->have_posts()) :
                while ($projects_query->have_posts()) : $projects_query->the_post();
                    $project_heading = get_post_meta(get_the_ID(), '_project_heading', true);
                    $project_paragraph = get_post_meta(get_the_ID(), '_project_paragraph', true);
                    $project_image_url = get_post_meta(get_the_ID(), '_project_image_url', true);

                    ?>
                    <div class="group">
                        <figure class="w-full overflow-hidden">
                            <?php if ($project_image_url) : ?>
                                <img
                                    src="<?php echo esc_url($project_image_url); ?>"
                                    alt="<?php the_title_attribute(); ?>"
                                    class="w-full h-auto transition-transform duration-500 ease-in-out transform group-hover:scale-110"
                                />
                            <?php else : ?>
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/images/default-placeholder.png"
                                    alt="Default Image"
                                    class="w-full h-auto transition-transform duration-500 ease-in-out transform group-hover:scale-110"
                                />
                            <?php endif; ?>
                        </figure>
                        <div class="mt-4">
                            <h2 class="text-lg"><?php echo esc_html($project_heading); ?></h2>
                            <h2 class="text-3xl font-bold"><?php the_title(); ?></h2>
                            <p><?php echo esc_html($project_paragraph); ?></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No projects found</p>';
            endif;
            ?>
        </div>

        <div class="md:my-20 flex justify-center">
            <button class="btn btn-outline px-20">Default</button>
        </div>
    </section>


    <!-- video section  -->
    <section class="bg-black my-5">
    <div class="hero text-white lg:px-10 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="relative w-full lg:w-1/2 rounded-lg shadow-2xl">
                <!-- Video Element -->
                <?php
                $video_url = get_theme_mod('hero_video_url');
                $video_upload = get_theme_mod('hero_video_upload');

                if ($video_upload) {
                    $video_src = $video_upload;
                } else {
                    $video_src = $video_url;
                }
                ?>
                <video id="hero-video" class="w-full rounded-lg cursor-pointer" controls>
                    <source src="<?php echo esc_url($video_src); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="w-full lg:w-1/2 text-xl md:text-3xl lg:pr-10">
                <p class="md:py-6">
                    <?php echo wp_kses_post(get_theme_mod('hero_video_text')); ?>
                </p>
                <hr class="my-5">
                <p class="md:py-6">
                    <?php echo wp_kses_post(get_theme_mod('hero_video_additional_text')); ?>
                </p>
            </div>
        </div>
    </div>
</section>


    <!-- Australia’s leading website design and development company section -->
    <section>
        <div class="hero min-h-screen md:px-10">
            <div class="hero-content flex-col lg:flex-row gap-x-5">
                <div class="lg:w-1/2">
                    <h3 class="text-2xl md:text-5xl font-bold leading-tight my-5">
                        <?php 
                        $hero_title = get_theme_mod('hero_title', 'Australia’s leading <span class="border-b border-orange-500">website</span> design and <span class="border-b border-orange-500">development</span> company'); 
                        echo wp_kses_post($hero_title); 
                        ?>
                    </h3>
                    <img
                        src="<?php echo esc_url(get_theme_mod('hero_image', get_template_directory_uri() . '/images/counterback.jpg')); ?>"
                        class="w-full lg:w-[35rem] lg:h-[35rem] rounded-lg shadow-2xl" />
                </div>
                <div class="lg:w-1/2">
                    <p class="text-base md:text-xl">
                    <?php 

                    $hero_description = get_theme_mod('hero_description', 'WebAlive is a full-service web design and development company in Australia with our head-office situated in Melbourne. We are a team of experienced website designers, developers and digital strategists. Through our bespoke result-driven solutions we deliver measurable outcomes that empower our clients. Since 2003, we have worked with thousands of clients and established ourselves as one of the most trusted online solution providers for businesses in Australia.'); 
                    echo wp_kses_post($hero_description); ?>
                    </p>
                    <hr class="border border-black my-5">
                    <p class="text-4xl font-bold">
                    <?php 
                        $hero_Titles = get_theme_mod('hero_Titles', 'An experienced and trusted digital agency.'); 
                        echo wp_kses_post($hero_Titles); 
                        ?>
                
                    </p>
                    <hr class="border border-black my-5">
                    <p class="py-6 text-base md:text-xl">
                        
                        <?php 

                    $hero_descriptions = get_theme_mod('hero_descriptions', 'Our ability to build on any platform willingness to adapt to the client’s needs make us the ideal web solutions provider. Working with WebAlive means you can be as hands-on as you wish! While we do have our own growth in mind, our main focus is always to add value to our customers by refining their ideas and realising their goals through our decade-long expertise and experience.'); 
                    echo wp_kses_post($hero_descriptions); ?>
                    </p>
                    <a href="<?php echo esc_url(get_theme_mod('hero_button_link', '#')); ?>" class="btn btn-primary">Learn more</a>
                </div>
            </div>
        </div>
    </section>


    <!-- card slider section  -->
    <div class="gallery border-y-2 rounded-3xl mx-auto my-20 bg-white max-w-full p-5 md:p-0  md:max-w-5xl">
        <div class="top flex p-2 border-b select-none">
            <div class="heading text-gray-800 w-full pl-3 font-semibold"><?php echo esc_html(get_option('testimonial_heading', 'Our Testimonials')); ?></div>
            <div class="buttons ml-auto flex text-gray-600 mr-1">
                <!-- Previous Button -->
                <svg id="prevBtn" class="w-7 border-2 rounded-l-lg p-1 cursor-pointer border-r-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <!-- Next Button -->
                <svg id="nextBtn" class="w-7 border-2 rounded-r-lg p-1 cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </div>
        </div>
            <img src="<?php echo get_template_directory_uri(); ?>./images/quote-testi.svg" alt="quote-testi" class="w-14">
        <div class="content-area w-full h-auto md:h-96 overflow-hidden">
            <div id="slider" class="platform shadow-xl h-full flex transition-transform duration-500">
            <?php
            $args = array(
                'post_type' => 'testimonial',
                'posts_per_page' => -1,
            );
            $testimonials = new WP_Query( $args );
            if ( $testimonials->have_posts() ) :
                while ( $testimonials->have_posts() ) : $testimonials->the_post();
                    $heading = get_post_meta( get_the_ID(), '_testimonial_heading', true );
                    $name = get_post_meta( get_the_ID(), '_testimonial_name', true );
                    $designation = get_post_meta( get_the_ID(), '_testimonial_designation', true );
                    ?>
                        <!-- Testimonial Frame -->
                        <div class="each-frame flex-none w-full h-full">
                            <div class="main flex flex-col w-full p-4 md:p-8">
                                <div class="sub w-full my-auto">
                                    <div class="long-text leading-relaxed text-sm md:text-3xl font-normal"><?php the_content(); ?></div>
                                    <div class="mt-10">
                                        <h3 class="text-lg md:text-2xl font-bold"><?php echo esc_html( $name ); ?></h3>
                                        <p><?php echo esc_html( $designation ); ?></p>
                                        <hr class="w-20 border border-black md:mt-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                        <!-- No testimonials found -->
                        <p>No testimonials available at the moment.</p>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div> 


    
        <!-- Check our latest insights -->
   
    <section class="mx-5 md:mx-10">
            <h3 class="text-2xl md:text-5xl font-bold my-10">Check our latest <span class="border-b-2 border-orange-400">insights</span></h3>

            <div class="grid grid-cols-1 lg:grid-cols-2 my-20 gap-2 md:gap-10">
                    <?php
            $args = array(
                'post_type' => 'insight',
                'posts_per_page' => 4,
            );
            $insight_query = new WP_Query($args);

            if ($insight_query->have_posts()) :
                while ($insight_query->have_posts()) : $insight_query->the_post();
                    $image_id = get_post_meta(get_the_ID(), '_insight_image_id', true);
                    $image_url = wp_get_attachment_image_url($image_id, 'full');
                    $heading = get_post_meta(get_the_ID(), '_insight_heading', true);
                    $button_text = get_post_meta(get_the_ID(), '_insight_button_text', true);
                    $button_url = get_post_meta(get_the_ID(), '_insight_button_url', true);
                    ?>
                    <div class="card md:card-side">
                        <figure class="w-full md:w-[50%]">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($heading); ?>" class=""/>
                        </figure>
                        <div class="card-body">
                        <h2 class="card-title text-lg md:text-2xl hover:text-orange-400 cursor-pointer">
                            <a href="<?php the_permalink(); ?>"><?php echo esc_html($heading); ?></a>
                        </h2>
                        <a href="<?php echo esc_url($button_url); ?>">
                            <button class="border-b border-black hover:text-orange-400 cursor-pointer"><?php echo esc_html($button_text); ?></button>
                        </a>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            else :
                echo '<p>No insights found</p>';
            endif;
            ?>
            </div>

            <div>
                <a href="#" class="flex items-center justify-center my-20">
                    <button class="btn bg-white border-2 border-black text-lg hover:bg-black hover:text-white hover:border-none">
                        View more insight <i class='bx bx-right-arrow-alt'></i>
                    </button>
                </a>
            </div> 
    </section>


      
      <!-- footer  -->
    <?php get_footer();?>
