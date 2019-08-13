
<?php get_header(); ?>

<?php // get_template_part('advanced', 'searchform'); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php if(get_post_type() == 'news' || get_post_type() == 'event'):?>
            <?php get_template_part('content', 'single-news-events');?>
        <?php else:?>
            <?php get_template_part('content', 'cptresources');?>
        <?php endif;?>
        
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
