
<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php var_dump( get_post_format());?>
        <?php get_template_part('content', get_post_format());?>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>