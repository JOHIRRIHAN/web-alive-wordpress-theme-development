<?php
/*
Template Name: wordpress-development
*/
get_header();
?>
<div
  class="w-full h-screen py-20"
  style="background-image: url('<?php echo esc_url(get_theme_mod('hero_bg_image', 'https://www.webalive.com.au/wp-content/uploads/2023/09/ecomerce-banner-up.png')); ?>');">
  <div class="absolute"></div>
  <div class="">
    <div class="md:max-w-md text-white px-10  md:width-fix">
      <h1 class=" text-4xl font-bold md:text-5xl leading-tight">
        <?php echo esc_html(get_theme_mod('hero_title', 'Get an ecommerce website that sells more and drives higher ROI')); ?>
      </h1>
      <button class="my-10">
      <a href="<?php echo esc_url(get_theme_mod('hero_button_url', '#')); ?>" class="border flex items-center hero-btn px-10 py-3 text-white rounded hover:bg-white hover:text-black font-bold">
        <?php echo esc_html(get_theme_mod('hero_button_text', 'View all Portfolio')); ?><i class='bx bx-right-arrow-alt text-3xl'></i>
      </a>
      </button>
    </div>
  </div>
</div>



<div class="flex flex-col lg:flex-row gap-5 bg-base-200 my-20 px-10">
    <!-- Google Customer Reviews Section -->
    <div class="flex-1 p-2 bg-white rounded-lg">
        <img src="https://www.webalive.com.au/wp-content/uploads/2023/09/google-logo-image.png" alt="Google Logo" class="mb-4">
        <h3 class="text-xl font-bold">Google Customer Reviews</h3>
        <div class="flex my-2">
            <span class="fa fa-star checked text-yellow-500"></span>
            <span class="fa fa-star checked text-yellow-500"></span>
            <span class="fa fa-star checked text-yellow-500"></span>
            <span class="fa fa-star checked text-yellow-500"></span>
            <span class="fa fa-star text-gray-300"></span>
        </div>
        <h3>4.7 Stars | 19 reviews</h3> 
    </div>

    <!-- Review Section -->
    <div class="flex-1">
        <?php
        $args = array(
            'post_type' => 'review',
            'posts_per_page' => 3
        );

        $review_query = new WP_Query($args);

        if ($review_query->have_posts()) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php while ($review_query->have_posts()) : $review_query->the_post(); ?>
                    <div class="p-4 bg-white rounded-lg ">
                        <div class="mb-2">
                            <div class="flex">
                                <?php
                                $rating = get_post_meta(get_the_ID(), 'rating', true);
                                for ($i = 1; $i <= 5; $i++) {
                                    echo $i <= $rating ? '<span class="fa fa-star checked text-yellow-500"></span>' : '<span class="fa fa-star text-gray-300"></span>';
                                }
                                ?>
                            </div>
                            <h3 class="font-bold text-lg"><?php the_title(); ?></h3>
                            <p class="pt-5"><?php echo esc_html(get_post_meta(get_the_ID(), 'review_text', true)); ?></p>
                            <p class="font-bold mt-2">- <?php echo esc_html(get_post_meta(get_the_ID(), 'reviewer', true)); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>



    <div class="hero-content flex-col lg:flex-row">
        <img src="<?php echo esc_url(get_theme_mod('hero_bg_image', 'https://www.webalive.com.au/wp-content/uploads/2023/09/Ecommerce-website-with-one-simple-goal.png')); ?>" class="max-w-sm rounded-lg" />
        <div>
            <h1 class="text-5xl font-bold"><?php echo esc_html(get_theme_mod('hero_title', 'Ecommerce website with one simple goal')); ?></h1>
            <p class="py-6"><?php echo esc_html(get_theme_mod('hero_content', 'Conversion. You want your ecommerce website to sell, and we are ready to let you take the wheel. Whether it’s your first website or you are aiming to transform your existing site, count on us at every step of the way.')); ?></p>
            <button class="border px-20 py-5 my-10 bg-[#f47521] text-white text-xl font-semibold">
                <a href="<?php echo esc_url(get_theme_mod('hero_button_url', 'http://localhost/web_alive/contact-us/')); ?>"> <?php echo esc_html(get_theme_mod('hero_button_text', 'Get A Quote')); ?></a>
            </button>
        </div>
    </div>
</div>

<section class="mx-10">
    <div>
        <h3 class="text-5xl font-bold text-center"><?php echo esc_html(get_theme_mod('unique_section_title', 'What sets WebAlive apart from the rest?')); ?></h3>
        <p class="text-center my-10 font-bold"><?php echo esc_html(get_theme_mod('unique_section_description', 'Bringing a website design to life demands a diverse professional team. Trust us. With 19 years of experience and a consistent track record, we are well-versed in the field.')); ?></p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3">
        <div>
            <div class="w-96">
                <h3 class="text-2xl font-bold"><?php echo esc_html(get_theme_mod('unique_section_text_1', 'Top local expert 1')); ?></h3>
                <p class="font-semibold pt-5"><?php echo esc_html(get_theme_mod('unique_section_text_2', 'Our Melbourne and Sydney web design experts possess an in-depth understanding of the Australian ecommerce landscape.')); ?></p>
            </div>
            <div class="w-96 mt-20">
                <h3 class="text-2xl font-bold"><?php echo esc_html(get_theme_mod('unique_section_text_3', 'Leading the ecommerce tech frontier 1')); ?></h3>
                <p class="font-semibold pt-5"><?php echo esc_html(get_theme_mod('unique_section_text_4', 'Our Melbourne and Sydney web design experts leverage their knowledge of regional customer behaviour.')); ?></p>
            </div>
        </div>

        <div>
            <img src="<?php echo esc_url(get_theme_mod('unique_section_image', 'https://www.webalive.com.au/wp-content/uploads/2023/09/wswa.png')); ?>" alt="logo" class="w-full">
        </div>

        <div>
            <div class="w-96">
                <h3 class="text-2xl font-bold"><?php echo esc_html(get_theme_mod('unique_section_text_1', 'Top local expert 2')); ?></h3>
                <p class="font-semibold pt-5"><?php echo esc_html(get_theme_mod('unique_section_text_2', 'Our Melbourne and Sydney web design experts possess an in-depth understanding of the Australian ecommerce landscape.')); ?></p>
            </div>
            <div class="w-96 mt-20">
                <h3 class="text-2xl font-bold"><?php echo esc_html(get_theme_mod('unique_section_text_3', 'Leading the ecommerce tech frontier 2')); ?></h3>
                <p class="font-semibold pt-5"><?php echo esc_html(get_theme_mod('unique_section_text_4', 'Our Melbourne and Sydney web design experts leverage their knowledge of regional customer behaviour.')); ?></p>
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

  
  
    <div class="flex items-center justify-center my-20">
    <img src="https://www.webalive.com.au/wp-content/uploads/2023/09/years-of-exp.png" alt="star logo">
  </div>
                    
  <section class="mx-10">
    <h3 class="text-5xl font-bold">Get all the advanced features that will drive
    your ecommerce store to new heights.</h3>


    <?php
      $args = array('post_type' => 'feature_box', 'posts_per_page' => -1);
      $feature_boxes = new WP_Query($args);

      if ($feature_boxes->have_posts()) :
          echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-10">'; // Start grid container
          while ($feature_boxes->have_posts()) : $feature_boxes->the_post();
              $image = get_post_meta(get_the_ID(), '_feature_box_image', true);
              $heading = get_post_meta(get_the_ID(), '_feature_box_heading', true);
              $paragraph = get_post_meta(get_the_ID(), '_feature_box_paragraph', true);
              ?>
              <div class="feature-box flex my-10 gap-10">
                  <img class="w-16 h-16" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($heading); ?>">
                  <div>
                      <h3 class="text-2xl font-bold"><?php echo esc_html($heading); ?></h3>
                      <p class="my-5"><?php echo esc_html($paragraph); ?></p>
                  </div>
              </div>
              <?php
          endwhile;
          echo '</div>'; // End grid container
          wp_reset_postdata();
      endif;
      ?>


  </section>

  <section class="bg-black text-white w-full">
    <h3 class="text-center text-5xl font-bold py-20">Our ecommerce web design process</h3>
    <div class="w-full relative my-20">
      <div class="swiper multiple-slide-carousel swiper-container relative mx-10">
        <div class="swiper-wrapper mb-16">

          <?php
          // Query the custom post type
          $args = array('post_type' => 'ecommerce_process', 'posts_per_page' => -1);
          $ecommerce_slides = new WP_Query($args);

          if ($ecommerce_slides->have_posts()) :
              while ($ecommerce_slides->have_posts()) : $ecommerce_slides->the_post();
                  $number = get_post_meta(get_the_ID(), '_ecommerce_process_number', true);
                  $description = get_post_meta(get_the_ID(), '_ecommerce_process_description', true);
                  ?>
                  <div class="swiper-slide bg-white text-black">
                    <div class="bg-indigo-50 rounded-2xl justify-center items-center">
                      <h3 class="text-2xl font-bold number-color"><?php echo esc_html($number); ?></h3>
                      <h3 class="text-2xl font-bold my-10"><?php the_title(); ?></h3>
                      <p><?php echo esc_html($description); ?></p>
                    </div>
                  </div>
                  <?php
              endwhile;
              wp_reset_postdata();
          endif;
          ?>

        </div>
    </div>
</section>

  

<!-- <div class="absolute flex justify-center items-center m-auto left-0 right-0 w-fit bottom-12">
  <!-- Previous Button -->
  <!-- <button id="slider-button-left" 
          class="swiper-button-prev group !p-2 flex justify-center items-center border border-solid border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-600 !-translate-x-16" 
          data-carousel-prev 
          aria-label="Previous Slide">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
  </button> -->

  <!-- Next Button -->
  <!-- <button id="slider-button-right" 
          class="swiper-button-next group !p-2 flex justify-center items-center border border-solid border-indigo-600 !w-12 !h-12 transition-all duration-500 rounded-full hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-600 !translate-x-16" 
          data-carousel-next 
          aria-label="Next Slide">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 group-hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </button>
</div> --> 

<section>
  <h3 class="text-center font-bold text-5xl">Platforms we work with</h3>
  <p class="text-center font-bold my-5">Our partnerships extend to the forefront of today’s top ecommerce platforms available in the current market landscape. <br>
  Choose the right one that works for you.</p>
  <div class="grid grid-cols-1 md:grid-cols-2 mx-10 gap-10">
    <?php
    $args = array('post_type' => 'platform_card', 'posts_per_page' => -1);
    $platform_cards = new WP_Query($args);

    if ($platform_cards->have_posts()) :
        $counter = 1; // Initialize a counter
        while ($platform_cards->have_posts()) : $platform_cards->the_post();
            $image = get_post_meta(get_the_ID(), '_platform_card_image', true);
            $heading = get_post_meta(get_the_ID(), '_platform_card_heading', true);
            $paragraph = get_post_meta(get_the_ID(), '_platform_card_paragraph', true);
            
            // Assign different background colors based on the card number
            $bg_color = '';
            if ($counter == 2) {
                $bg_color = '#1199C4'; // Background color for 2nd card
            } elseif ($counter == 3) {
                $bg_color = '#9B5C8F'; // Background color for 3rd card
            } elseif ($counter == 4) {
                $bg_color = '#34313F'; // Background color for 4th card
            } else {
                $bg_color = '#95BF47'; // Default background color
            }
    ?>
    <div class="cards flex flex-col items-center p-5" style="background-color: <?php echo esc_attr($bg_color); ?>;">
        <!-- Image Section -->
        <div class="image-content mb-5">
            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($heading); ?>" class="max-w-full h-auto my-5">
        </div>
        <!-- Text Section -->
        <div class="text-content">
            <h3 class="text-3xl font-bold my-10"><?php echo esc_html($heading); ?></h3>
            <p><?php echo esc_html($paragraph); ?></p>
        </div>
    </div>
    <?php
        $counter++; // Increment the counter for each card
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>

</section>




    <?php get_footer(); ?>