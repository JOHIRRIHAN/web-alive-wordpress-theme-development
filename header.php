<!DOCTYPE html>
<html lang="<?php language_attributes( ); ?>" class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>./images/favicon.webp" type="image/x-icon">
    <link href="<?php echo get_template_directory_uri(); ?>./src/output.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>./style.css" rel="stylesheet">
    <!-- Boxicons for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- swiper css  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

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
        .hero-title{
            font-size: 60px;
            font-weight: 700;
            
        }
        .width-fix{
            width: 600px;
            letter-spacing: 3px;
        }
        .checked {
            color: orange;
        }
        /* CSS Code */
        .swiper-wrapper {
        width: 100%;
        height: max-content !important;
        padding-bottom: 64px !important;
        -webkit-transition-timing-function: linear !important;
        transition-timing-function: linear !important;
        position: relative;
        }

        .swiper-pagination-bullet {
        background: #4f46e5;
        }
        .swiper-slide{
            height: 400px;
            background-color: white;
            color: black;
            border-left: 5px solid #22b0af;
            padding: 10px;
        }
        .number-color{
            color: #22b0af;
        }
        .cards{
            background-color: #95BF47;
            color: white;
            padding: 20px;
            border-radius: 12px; 
            height: 400px;
        }
        .cards2{
            background-color: #1199C4;
            color: white;
            padding: 20px;
            border-radius: 12px; 
            height: 400px;
        }


    </style>
    

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
   
    <!-- Header Section -->
    <div class=" bg-black ">
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
    
       
    </div>
