<div class="button-group filter-button-group">
            <button data-filter="*">Show All</button>
            <button data-filter=".news">News</button>
            <button data-filter=".web">Web Sites</button>
        </div>

        <?php
       //loop for paged blog posts
       if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
       elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
       else { $paged = 1; }

       $args = array(
           'posts_per_page' => 1,
            'paged' => $paged,
            'order' => 'DESC',
           'post_type' => 'medium'
        );
        $posts = new WP_Query($args);

        if ($posts->have_posts()):

            echo '<div class="grid">
                        <div class="grid-sizer"></div>
                        <div class="gutter-sizer"></div>';

            while($posts->have_posts()): $posts->the_post();
                $catagory = "";
                $cats = get_the_category( $posts->ID);

                //concat catagories slugs for filter
                foreach($cats as $cat){
                    $catagory .= $cat->slug." ";
                }

                $image = get_the_post_thumbnail_url( get_the_ID(),"medium'" );
                $media = '<img src="'.$image.'" width="100%">';
            ?>

                <div class="grid-item <?php echo $catagory; ?>">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo $media; ?>
                    </a>
                </div>

            <?php endwhile; ?>

                <div class="scroller-status">
                    <div class="loader-ellips infinite-scroll-request">
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                        <span class="loader-ellips__dot"></span>
                    </div>
                </div>

                <nav class="pagination">
                    <div class="prev-posts-link alignright" style="display:none;"><?php echo get_next_posts_link( 'Older Entries', $featured->max_num_pages ); ?></div>
                    <div class="next-posts-link alignleft" ><?php echo get_previous_posts_link( 'Newer Entries' ); ?></div>
                </nav>

            </div>

        <?php else: endif; ?>