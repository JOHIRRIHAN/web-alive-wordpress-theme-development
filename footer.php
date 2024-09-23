     <!-- contact  -->
     <div class="text-white bg-black w-full">
        <h3 class="text-xl lg:text-3xl font-semibold py-20 text-center">Got a project that you would like to discuss? <a href="http://localhost/web_alive/contact-us/" class="border-b-2 hover:text-orange-400">Contact Us<i class='bx bx-right-arrow-alt'></i></a></h3>
      </div>
      <hr>

    <footer class="text-white px-8 md:py-20 bg-black">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <div class="mb-8 md:mb-0">
            <img src="<?php echo esc_url(get_theme_mod('footer_logo', get_template_directory_uri() . '/images/webalive-logo.webp')); ?>" alt="webalive-logo">
            <p class="text-center mt-8"><?php echo wp_kses_post(get_theme_mod('footer_copyright', '&copy; Copyright © 2024 WebAlive')); ?></p>
        </div>
        <div class="mb-8 md:mb-0">
            <h3 class="text-lg font-bold mb-4">Service</h3>
            <?php
            $services = explode(',', get_theme_mod('footer_services', 'Web Development, Ecommerce Web Site Design, Web Site Design, Mobile App Development, Online Marketing, Wordpress Development, Sopify we design'));
            foreach ($services as $service) {
                echo '<p class="mb-2 hover:text-yellow-600 cursor-pointer">' . esc_html(trim($service)) . '</p>';
            }
            ?>
        </div>
        <div class="mb-8 md:mb-0">
            <h3 class="text-lg font-bold mb-4">Solution</h3>
            <ul>
                <?php
                $solutions = explode(',', get_theme_mod('footer_solutions', 'Medical Website, Live Chart software, NetSuite Integration, Trade Services Website, Sporting Club Website, Transport Services Website, Professional Services Website'));
                foreach ($solutions as $solution) {
                    echo '<li><a href="#" class="hover:text-yellow-600">' . esc_html(trim($solution)) . '</a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="mb-8 md:mb-0">
            <h3 class="text-lg font-bold mb-4">Melbourne</h3>
            <ul>
                <?php
                $melbourne = explode('|', get_theme_mod('footer_melbourne', 'Suite 502, 9 Yarra St South Yarra, VIC 3141, Australia | (03) 8669 0640'));
                foreach ($melbourne as $location) {
                    echo '<li><a href="#" class="hover:text-yellow-600">' . esc_html(trim($location)) . '</a></li>';
                }
                ?>
            </ul>
        </div>
        <div>
            <h3 class="text-lg font-bold mb-4">Sydney</h3>
            <ul class="mb-4">
                <?php
                $sydney = explode('|', get_theme_mod('footer_sydney', 'Suite 11, 1401 Botany Road Botany, NSW 2019, Australia | (02) 8004 3410'));
                foreach ($sydney as $location) {
                    echo '<li><a href="#" class="hover:text-yellow-600">' . esc_html(trim($location)) . '</a></li>';
                }
                ?>
            </ul>
            <div class="mt-4 icons">
                <a href="<?php echo esc_url(get_theme_mod('footer_facebook', '#')); ?>" class="mr-2"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="<?php echo esc_url(get_theme_mod('footer_instagram', '#')); ?>" class="mr-2"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="mailto:<?php echo esc_url(get_theme_mod('footer_email', '#')); ?>"><i class="far fa-envelope fa-2x"></i></a>
                <a href="<?php echo esc_url(get_theme_mod('footer_youtube', '#')); ?>" class="mr-2"><i class="bx bxl-youtube"></i></a>
                <a href="<?php echo esc_url(get_theme_mod('footer_linkedin', '#')); ?>" class="mr-2"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!--Grid-->
        <div class="md:pt-16 flex justify-between md:items-center flex-col gap-8 lg:flex-row">
            <ul class="text-base text-start flex-wrap md:flex items-center justify-center gap-14 lg:gap-5 xl:gap-10 transition-all duration-500">
                <li><a href="javascript:;" class="text-white hover:text-gray-400">Blog</a></li>
                <li class="sm:my-0 my-2"><a href="javascript:;" class="text-white hover:text-gray-400">Terms and Conditions</a></li>
                <li><a href="javascript:;" class="text-white hover:text-gray-400">Privacy Policy</a></li>
                <li class="sm:my-0 my-2"><a href="javascript:;" class="text-white hover:text-gray-400">Support</a></li>
                <li><a href="javascript:;" class="text-white hover:text-gray-400">Contact Us</a></li>
            </ul>
            <div class="flex space-x-4 sm:justify-center text-3xl md:text-5xl">
                <a href="<?php echo esc_url(get_theme_mod('footer_facebook', '#')); ?>"><i class='bx bxl-facebook-square'></i></a>
                <a href="<?php echo esc_url(get_theme_mod('footer_instagram', '#')); ?>"><i class='bx bxl-instagram-alt'></i></a>
                <a href="<?php echo esc_url(get_theme_mod('footer_youtube', '#')); ?>"><i class='bx bx-x'></i></a>
                <a href="<?php echo esc_url(get_theme_mod('footer_youtube', '#')); ?>"><i class='bx bxl-youtube'></i></a>
                <a href="<?php echo esc_url(get_theme_mod('footer_linkedin', '#')); ?>"><i class='bx bxl-linkedin'></i></a>
            </div>
        </div>
    </div>
    </footer>

    
    
    <?php wp_footer(); ?>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/main.js"></script>
    <script>
        document.getElementById('filterToggle').addEventListener('click', function() {
        const filterLinks = document.getElementById('filterLinks');
        filterLinks.classList.toggle('hidden'); // Toggles the 'hidden' class
        });
    </script>
</body>
</html>

<?php if (is_active_sidebar('footer-widget-area')) : ?>
    <div id="footer-widgets" class="footer-widget-area">
        <?php dynamic_sidebar('footer-widget-area'); ?>
    </div>
<?php endif; ?>
