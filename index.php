<?php get_header(); ?>

<main class="container mx-auto py-4">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
    ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php the_content(); ?></div>
    <?php
        }
    } else {
        echo '<p>No posts found.</p>';
    }
    ?>
</main>

<footer class="container mx-auto py-4">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
</footer>

<?php wp_footer(); ?>
</body>

</html>