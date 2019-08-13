<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
add_action('wp_ajax_nopriv_seadstem_load_more', 'seadstem_load_more');
add_action('wp_ajax_seadstem_load_more', 'seadstem_load_more');

function seadstem_load_more() {


    $meta_query = [];
    $fieldKey = 'subjects';
    if (!empty($_POST[$fieldKey])) {
        foreach ($_POST[$fieldKey] as $fieldValue) {
            $meta_query[] = array(
                'key' => $fieldKey,
                'value' => $fieldValue,
                'compare' => 'LIKE'
            );
        }
    }

    $fieldKey = 'topics';
    if (!empty($_POST[$fieldKey])) {
        foreach ($_POST[$fieldKey] as $fieldValue) {
            $meta_query[] = array(
                'key' => $fieldKey,
                'value' => $fieldValue,
                'compare' => 'LIKE'
            );
        }
    }

    $post_types = [];
    $fieldKey = 'resourceTypes';
    $cpt_categories = get_post_types(['_builtin' => false, 'public' => true, 'exclude_from_search' => false]);

    if (!empty($_POST[$fieldKey])) {

        $post_types = array_intersect($_POST[$fieldKey], array_values($cpt_categories));
    } else {
        $post_types = array_values($cpt_categories);
    }
    if (count($meta_query)) {
        $meta_query['relation'] = 'OR';
    }

    $category = pll_get_term(12); //category of resources

    $searchTerm = get_search_query();

    if ($searchTerm == '-custom-filter-') {
        $searchTerm = "";
    }
    $args = [
        'cat' => $category,
        'post_type' => $post_types,
        's' => $_POST['s'],
        'meta_query' => $meta_query,
        'list_mode' => 'category_search',
        'paged' => $_POST['page'] + 1,
        '_meta_or_title' => get_search_query(),
    ];

    $search = new WP_Query($args);
//    var_dump($search->request);
    if ($search->have_posts()):

        while ($search->have_posts()): $search->the_post();

            get_template_part('content', 'category');

        endwhile;

    endif;
    wp_reset_postdata();

    die();
}




add_action('wp_ajax_nopriv_seadstem_news_load_more', 'seadstem_news_load_more');
add_action('wp_ajax_seadstem_news_load_more', 'seadstem_news_load_more');

function seadstem_news_load_more() {
    $category = pll_get_term(77);
    $args = array(
        'cat' => $category,
        'post_type' => ['news'],
        'posts_per_page' => 3,
        'paged' => $_POST['page'] + 1,
    );
    $news_array = new WP_Query($args);
    wp_reset_postdata();
    
    if ($news_array->have_posts()):

        while ($news_array->have_posts()): $news_array->the_post();

            get_template_part('content', 'news-events-news');

        endwhile;

    endif;

    die();
}



add_action('wp_ajax_nopriv_seadstem_events_load_more', 'seadstem_events_load_more');
add_action('wp_ajax_seadstem_events_load_more', 'seadstem_events_load_more');

function seadstem_events_load_more() {
    $category = pll_get_term(77);
    $args = array(
        'cat' => $category,
        'post_type' => ['event'],
        'posts_per_page' => 3,
        'paged' => $_POST['page'] + 1,
    );
    $events_array = new WP_Query($args);
    wp_reset_postdata();
    
    if ($events_array->have_posts()):

        while ($events_array->have_posts()): $events_array->the_post();

            get_template_part('content', 'news-events-events');

        endwhile;

    endif;

    die();
}