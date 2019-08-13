<?php
/*
  Template Name: Static Page
 */
?>
<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('content', 'static');?>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>