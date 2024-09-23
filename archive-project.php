<?php
// Assuming you are within a loop to display projects
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <div class="project-item">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="project-image">
                        <?php the_post_thumbnail('medium'); // Adjust size as needed ?>
                    </div>
                <?php endif; ?>
                <h2 class="project-title"><?php the_title(); ?></h2>
            </a>
            <div class="project-excerpt">
                <?php the_excerpt(); ?>
            </div>
        </div>
    <?php endwhile;
else :
    echo '<p>No projects found.</p>';
endif;
?>
