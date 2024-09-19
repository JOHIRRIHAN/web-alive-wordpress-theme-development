<?php
/* Template Name: contact us */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php the_title(); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .submit-button{
            font-size: 34px;
            background: black;
            color: white;
            padding: 8px 30px;
        }
    </style>
</head>
<body class=" font-sans">
    <header class="">
        <div class="container mx-auto py-10 px-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-orange-500"><img src="https://www.webalive.com.au/wp-content/uploads/2019/08/company-logo-color.png" alt="logo"></h1>
            <a href="<?php echo home_url(); ?>" class="text-2xl font-semibold hover:text-gray-800">← Back to home page</a>
        </div>
    </header>
    <main class="container mx-auto py-8 px-6">
    <?php
    $args = array('post_type' => 'contact_us', 'posts_per_page' => 1);
    $contact_query = new WP_Query($args);

    if ($contact_query->have_posts()) :
        while ($contact_query->have_posts()) : $contact_query->the_post();
            // Get dynamic contact details
            $phone = get_post_meta(get_the_ID(), '_contact_phone', true);
            $email = get_post_meta(get_the_ID(), '_contact_email', true);
            $melbourne_address = get_post_meta(get_the_ID(), '_melbourne_address', true);
            $sydney_address = get_post_meta(get_the_ID(), '_sydney_address', true);

            // Get dynamic form labels
            $first_name_label = get_post_meta(get_the_ID(), '_first_name_label', true);
            $last_name_label = get_post_meta(get_the_ID(), '_last_name_label', true);
            $phone_label = get_post_meta(get_the_ID(), '_phone_label', true);
            $email_label = get_post_meta(get_the_ID(), '_email_label', true);
            $company_name_label = get_post_meta(get_the_ID(), '_company_label', true);
            $message_label = get_post_meta(get_the_ID(), '_message_label', true);
            $submit_button_text = get_post_meta(get_the_ID(), '_submit_button_text', true);
            ?>

            <div class="flex flex-col md:flex-row gap-8">
                <div class="w-full md:w-2/5">
                    <h2 class="text-7xl font-bold mb-4"><?php the_title(); ?></h2>
                    <p class="text-gray-900 text-xl font-semibold my-10"><?php the_content(); ?></p>
                    <form action="#" method="post" class="space-y-4">
                        <div>
                            <label for="first-name" class="block text-gray-700 font-medium mb-2"><?php echo esc_html($first_name_label); ?>*</label>
                            <input type="text" id="first-name" name="first-name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="last-name" class="block text-gray-700 font-medium mb-2"><?php echo esc_html($last_name_label); ?>*</label>
                            <input type="text" id="last-name" name="last-name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="phone" class="block text-gray-700 font-medium mb-2"><?php echo esc_html($phone_label); ?>*</label>
                            <input type="tel" id="phone" name="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2"><?php echo esc_html($email_label); ?>*</label>
                            <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="company-name" class="block text-gray-700 font-medium mb-2"><?php echo esc_html($company_name_label); ?>*</label>
                            <input type="text" id="company-name" name="company-name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 font-medium mb-2"><?php echo esc_html($message_label); ?>*</label>
                            <textarea id="message" name="message" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-none" rows="5"></textarea>
                        </div>
                        <button type="submit" class="submit-button"><?php echo esc_html($submit_button_text); ?> →</button>
                    </form>
                </div>
                <div class="w-full md:w-1/2 p-10 bg-white">
                    <div class="flex flex-col">
                        <div class="flex gap-20">
                            <div class="mb-8">
                                <h3 class="text-4xl font-bold mb-2">Call Us</h3>
                                <p class="text-gray-600 text-xl"><?php echo esc_html($phone); ?></p>
                            </div>
                            <div class="mb-8">
                                <h3 class="text-4xl font-bold mb-2">E-mail Us</h3>
                                <p class="text-gray-600 text-xl"><?php echo esc_html($email); ?></p>
                            </div>
                        </div>
                        <div class="mb-8">
                            <h3 class="text-4xl font-bold mb-2">Melbourne</h3>
                            <p class="text-gray-600 text-xl my-5"><?php echo nl2br(esc_html($melbourne_address)); ?></p>
                            <a href="#" class="text-black hover:underline hover:text-orange-600">Get direction</a>
                        </div>
                        <div>
                            <h3 class="text-4xl font-bold mb-2">Sydney</h3>
                            <p class="text-gray-600 text-xl my-5"><?php echo nl2br(esc_html($sydney_address)); ?></p>
                            <a href="#" class="text-black hover:underline hover:text-orange-600">Get direction</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile;
    endif;
    wp_reset_postdata();
    ?>
</main>

<?php get_footer(); ?>
</body>
</html>
