
<?php get_header(); ?>



<?php
$category_id = get_query_var('cat');
//var_dump(pll_get_term($category_id, 'en'));
//set the root for categories of news and events
if(pll_get_term($category_id, 'en') == apply_filters('news_events_id', 0)){
//    echo 'here';
     get_template_part('category', 'seadstem-news-and-events');
}else{
    get_template_part('unit', 'roll'); 
    get_template_part('category', 'seadstem-resources');
//    echo 'nothere';
}
?>
