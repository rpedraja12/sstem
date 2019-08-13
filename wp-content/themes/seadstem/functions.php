<?php

require get_template_directory() . '/inc/ajax.php';
add_image_size('news-and-events-thumbnail', 520, 280, true);

function enqueue_seadstem() {
    wp_enqueue_style('seadstem_style', get_template_directory_uri() . '/css/seadstem.css', [], '1.0', 'all');
    wp_enqueue_script('seadstem_js`', get_template_directory_uri() . '/js/seadstem.js', [], '1.0', true);

    //jquery
    wp_enqueue_script('jquery');
    //load Popper
    wp_enqueue_script('popper', get_template_directory_uri() . '/vendor/popper/1.0/js/popper.min.js', [], '1.0', true);
    //load Isotope
    wp_enqueue_script('isotope', get_template_directory_uri() . '/vendor/isotope/3.0.6/js/isotope.pkgd.min.js', [], '3.0.6', true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/vendor/isotope/3.0.6/js/fitcolumns.js', [], '3.0.6', true);
    //load bootstrap
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/4.0.0/css/bootstrap.min.css', [], '4.0.0', 'all');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/4.0.0/js/bootstrap.min.js', [], '4.0.0', true);
    //font awesome
    wp_enqueue_style('fontawsome', get_template_directory_uri() . '/vendor/fontawesome/4.7.0/css/font-awesome.min.css', [], '4.7.0', 'all');

    //search javascript
    if (is_category()) {
        wp_enqueue_script('seadstem_search_js`', get_template_directory_uri() . '/js/advanced_search_seadstem.js', [], '1.0', true);
        wp_enqueue_script('seadstem_category_js`', get_template_directory_uri() . '/js/category.js', [], '1.0', true);
        wp_enqueue_script('infinte-scroll', get_template_directory_uri() . '/vendor/infinite-scroll/3.0.4/js/infinite-scroll-pkjd.min.js', [], '3.0.4', true);
        //owl carousel
        wp_enqueue_style('owl_carousel_css`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/css/owl.carousel.min.css', [], '2.2.3.4', 'all');
        wp_enqueue_style('owl_carousel_theme_css`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/css/owl.theme.default.min.css', [], '2.2.3.4', 'all');
        wp_enqueue_script('owl_carousel_js`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/js/owl.carousel.min.js', [], '2.2.3.4', true);
    }

    if (is_search()) {
        wp_enqueue_script('seadstem_search_js`', get_template_directory_uri() . '/js/advanced_search_seadstem.js', [], '1.0', true);
        wp_enqueue_script('seadstem_category_js`', get_template_directory_uri() . '/js/category.js', [], '1.0', true);
        wp_enqueue_script('infinte-scroll', get_template_directory_uri() . '/vendor/infinite-scroll/3.0.4/js/infinite-scroll-pkjd.min.js', [], '3.0.4', true);
        //owl carousel
        wp_enqueue_style('owl_carousel_css`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/css/owl.carousel.min.css', [], '2.2.3.4', 'all');
        wp_enqueue_style('owl_carousel_theme_css`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/css/owl.theme.default.min.css', [], '2.2.3.4', 'all');
        wp_enqueue_script('owl_carousel_js`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/js/owl.carousel.min.js', [], '2.2.3.4', true);
    }

    if (is_single()) {
        wp_enqueue_script('seadstem_single_js`', get_template_directory_uri() . '/js/single.js', [], '1.0', true);
        //owl carousel
        wp_enqueue_style('owl_carousel_css`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/css/owl.carousel.min.css', [], '2.2.3.4', 'all');
        wp_enqueue_style('owl_carousel_theme_css`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/css/owl.theme.default.min.css', [], '2.2.3.4', 'all');
        wp_enqueue_script('owl_carousel_js`', get_template_directory_uri() . '/vendor/owl_carousel/2-2.3.4/js/owl.carousel.min.js', [], '2.2.3.4', true);
    }
}

add_action('wp_enqueue_scripts', 'enqueue_seadstem');

function init_support_seadstem() {
    add_theme_support('menu');

    register_nav_menu('left-header', 'Seadstem Left header menu');
    register_nav_menu('collapsed-header', 'Seadstem Collapsed header menu');
    register_nav_menu('right-header', 'Seadstem Right header menu');

    register_nav_menu('left-footer', 'Seadstem Left footer menu');
    register_nav_menu('right-footer', 'Seadstem Right footer menu');
}

add_action('init', 'init_support_seadstem');

add_theme_support('post-thumbnails');

add_theme_support('custom-logo', array(
    'height' => 100,
    'width' => 400,
    'flex-height' => true,
    'flex-width' => true,
    'header-text' => array('site-title', 'site-description'),
));

add_theme_support('html5', ['search-form']);

function widget_setup_seadstem() {
    register_sidebar([
        'name' => 'widget-container',
        'id' => 'widget-container-1',
        'class' => 'widget-container-class',
        'description' => 'This widget will be located at the top right',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ]);

    register_sidebar([
        'name' => 'widget-footer-container',
        'id' => 'widget-footer-container-1',
        'class' => 'widget-footer-container-class',
        'description' => 'This widget will be located at the bottom right',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ]);

    register_sidebar([
        'name' => 'widget-footer-image-container',
        'id' => 'widget-footer-image-container-1',
        'class' => 'widget-footer-image-container-class',
        'description' => 'This widget will be located at the bottom center',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ]);

    register_sidebar([
        'name' => 'widget-header-collapsed-container',
        'id' => 'widget-container-2',
        'class' => 'widget-container-class',
        'description' => 'This widget will be located at the top right',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ]);
}

add_action('widgets_init', 'widget_setup_seadstem');


/* ===============================
  Search Functions
  ===============================
 */

function load_custom_search_template_seadstem() {
    if (isset($_REQUEST['search']) == 'advanced') {
        require('advanced-search-result.php');
        die();
    }
}

add_action('init', 'load_custom_search_template_seadstem');

/* ===============================
  CPTUI Polylang register strings
  ===============================
 */

function cpt__labels($cpts) {
    $types = get_option('cptui_post_types');

    if (!empty($types) && function_exists('pll_register_string')) {
        foreach ($types as $type) {
            pll_register_string('CPT', $type['name']);
            pll_register_string('CPT', $type['singular_label']);
            pll_register_string('CPT', $type['label']);

            if (!empty($type['description'])) {
                pll_register_string('CPT', $type['description']);
            }

            foreach ($type['labels'] as $label) {
                pll_register_string('CPT', $label);
            }
        }
    }

    return $cpts;
}

add_action('cptui_post_register_post_types', 'cpt__labels');


/* ===============================
  String Registers
  ===============================
 */

function register_strings() {
    if (function_exists('pll_register_string')) {
        pll_register_string('seadstem', 'Subject');
        pll_register_string('seadstem', 'Resource Type');
        pll_register_string('seadstem', 'Author');
        pll_register_string('seadstem', 'Documents');
        pll_register_string('seadstem', 'No results found.');
        pll_register_string('seadstem', 'Related Resources');
        pll_register_string('seadstem', 'delete all filters');
        pll_register_string('seadstem', 'new');
        pll_register_string('seadstem', 'news');
        pll_register_string('seadstem', 'events');
        pll_register_string('seadstem', 'results');
        pll_register_string('seadstem', 'search');
        pll_register_string('seadstem', 'load more');
        pll_register_string('seadstem', 'latest');
    }
}

add_action('init', 'register_strings');

function seadsteam_register_acf_fields($field) {
    var_dump($field['choices']);
    pll_register_string('ron', 'ROnisgood');
    foreach ($field['choices'] as $key => $value) {
        pll_register_string('ACF-OPTIONS', $value);
        echo 'here';
        echo $key;
    }

//    exit;
    return $field;
}

add_action('acf/load_field/type=checkbox', 'seadsteam_register_acf_fields');

function seadstem_get_multiple_meta($data) {
    $values = [];
    if (empty($data)) {
        return $values;
    }
    foreach ($data as $key => $value) {
        $value_str = array_pop($value);
//        var_dump($value_str);
        $values[] = pll__($value_str);
    }
    return $values;
}

function seadstem_get_types_field_checkboxes_options($checkboxField) {
    $values = [];
    if (isset($checkboxField['data']['options'])) {
        return $checkboxField['data']['options'];
    }

    return $values;
}

function seadstem_get_types_field_checkboxes_options_by_value($checkboxField, $valueToCheck, $value_key = 'set_value') {
//    var_dump(pll__('Biology', 'de'));
//    var_dump($valueToCheck);
    foreach ($checkboxField as $checkbox_detail) {

        if ($valueToCheck == pll__($checkbox_detail[$value_key])) {
            return $checkbox_detail;
        }
    }
    return [];
}

function getSize($file) {
    $bytes = filesize($file);
    $s = array('b', 'Kb', 'Mb', 'Gb');
    $e = floor(log($bytes) / log(1024));
    $divisor = pow(1024, floor($e));
    if ($divisor == 0) {
        return 0;
    }
    return sprintf('%.2f ' . $s[$e], ($bytes / $divisor));
}

/*
 * ============= custom search ================
 */

/**
 * Register custom query vars
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
 */
//function seadstem_register_query_vars( $vars ) {
//    $vars[] = '';
//    $vars[] = 'editor';
//    return $vars;
//}
//add_filter( 'query_vars', 'seadstem_register_query_vars' );
function seadstem_empty_search_box($query) {
    if ($query->is_search) {

        $fetchedTag = term_exists($_GET['s']);
        if ($fetchedTag == '-custom-filter-') {
            unset($_GET['s']);
        }
    }
}

add_filter('pre_get_posts', 'seadstem_empty_search_box');

//function seadstem_tag_search_2($search, &$wp_query) {
//    
//    
//    
//    
//    global $wpdb;
//    if($title = $wp_query->get('_meta_or_title')){
//        add_filter( 'get_meta_sql', function( $sql ) use ( $title )
//        {
//            global $wpdb;
//            // Only run once:
//            static $nr = 0; 
//            if( 0 != $nr++ ) return $sql;
//            
//            // Modify WHERE part:
//            $sql['where'] = sprintf(
//                " AND ( %s OR %s ) ",
//                $wpdb->prepare( "{$wpdb->posts}.post_title = '%s'", $title ),
//                mb_substr( $sql['where'], 5, mb_strlen( $sql['where'] ) )
//            );
//            return $sql;
//        });
//    }
//    
////    if(empty($search)) {
////        return $search; // skip processing - no search term in query
////    }
////    $q = $wp_query->query_vars;
////    $n = !empty($q['exact']) ? '' : '%';
////    $search =
////    $searchand = '';
////    foreach ((array)$q['search_terms'] as $term) {
////        $term = esc_sql($wpdb->esc_like($term));
////        $search .= "{$searchand}($wpdb-&gt;posts.post_title LIKE '{$n}{$term}{$n}')";
////        $searchand = ' AND ';
////    }
////    if (!empty($search)) {
////        $search = " AND ({$search}) ";
////        if (!is_user_logged_in())
////            $search .= " AND ($wpdb-&gt;posts.post_password = '') ";
////    }
//    return $search;
//}

function seadstem_tag_search_2($where, $wp_query) {
//    if (is_search()) {
//        $where = preg_replace(
//                "/\(\s*post_title\s+LIKE\s*(\'[^\']+\')\s*\)/", "(post_title LIKE $1) OR (geotag_city LIKE $1) OR (geotag_state LIKE $1) OR (geotag_country LIKE $1)", $where);
//    }
    global $wpdb;
    if (is_search()) {
        if ($title = $wp_query->get('_meta_or_title')) {
//             $where .= ' OR ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $title ) ) . '%\'';
//             $where .= ' ron ron';
//            var_dump($where);
//            echo '<br/>';
//            exit;
//            echo '<br/>';
//            var_dump($wp_query);
            $startOfPostTitleSearch = strpos($where, "(wp_posts.post_title");
            $result = preg_split('/\(wp_posts\.post_title/', $where);
            $customWhere = "";
            if (count($result) >= 2) {
                $tagWhere = "({$wpdb->postmeta}.meta_key  = 'wpcf-tag' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%') OR ";
                $tagWhere .= "({$wpdb->postmeta}.meta_key  = 'wpcf-subjects' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%') OR ";
                $tagWhere .= "({$wpdb->postmeta}.meta_key  = 'wpcf-topics' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%') OR ";
                $tagWhere .= "({$wpdb->postmeta}.meta_key  = 'wpcf-level' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%') OR ";

                $tileExploded = explode(" ", $wpdb->esc_like($title));
                if (empty($tileExploded)) {
                    $tagWhere .= "({$wpdb->posts}.post_type LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%') OR ";
                } else {
                    foreach ($tileExploded as $tile) {
                        $tagWhere .= "({$wpdb->posts}.post_type LIKE '%" . esc_sql($wpdb->esc_like($tile)) . "%') OR ";
                    }
                }

//                $tagWhere .= "({$wpdb->posts}.post_type LIKE '%" . esc_sql($wpdb->esc_like($title)) . "%') OR ";
//                var_dump($tagWhere);
                $where = $result[0];
                for ($ctr = 1; $ctr < count($result); $ctr++) {

                    $where .= $tagWhere . "(wp_posts.post_title" . $result[$ctr];
                }
            }
//            var_dump($result);
//            echo 'POSITION OF '. strpos($where,"(wp_posts.post_title");
//            var_dump(mb_substr($where));
//            var_dump(sprintf(
//                " AND ( %s OR %s ) ",
//                $wpdb->prepare( "{$wpdb->posts}.xxx = '%s'", $title ),
//                mb_substr( $where, 5, mb_strlen( $where ) )
//            ));
        }
    }

    return $where;
}

add_filter('posts_where', 'seadstem_tag_search_2', 10000, 2);

function seadstem_tag_search_2_join($join, $wp_query) {
    if (is_search()) {
        if ($title = $wp_query->get('_meta_or_title')) {
            if (count($wp_query->get('meta_query') == 0)) {
                global $wpdb;
                $position = strpos($join, " INNER JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id )");
                if ($position === false) {
                    $join .= " INNER JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id )";
                }
            }
        }
    }
    return $join;
}

add_action('posts_join', 'seadstem_tag_search_2_join', 10, 2);

function seadsteam_seadstem_post_type_orderby($orderby, $wp_query) {
    if ($wp_query->get('list_mode') == 'category_search') {
//        var_dump($orderby);
//        var_dump($wp_query);
        $orderby = "FIELD(wp_posts.post_type,'project', 'experiment', 'worksheet', 'audio', 'video', 'app', 'game', 'simulation', 'virtual-lab'), ID DESC";
//        var_dump($orderby);
    }

    return $orderby;
}

add_filter('posts_orderby', 'seadsteam_seadstem_post_type_orderby', 10, 2);

function seadstem_redirect_homepage() {
    // Check for blog posts index
    // NOT site front page, 
    // which would be is_front_page()
    if (is_home() || is_front_page()) {

        $category = get_categories();
        wp_redirect(get_category_link(12));
        exit();
    }
//    echo "here";
//    exit;
}

add_action('template_redirect', 'seadstem_redirect_homepage');

function seadstem_get_links_icon($linkImg) {

    $legendArray = ['apple_store' => 'fa fa-apple', 'play_store', 'youtube' => 'fa fa-youtube-play', 'website' => 'fa fa-globe'];
    return isset($legendArray[$linkImg]) ? $legendArray[$linkImg] : '';
}

function seadstem_nav_class($classes, $item) {
    if ('category' == $item->object) {
        $current_category = array();

        $category = get_category($item->object_id);
        $category = $category->term_id;
        //var_dump($category);

        global $wp_query, $wp_rewrite;

        $queried_object = $wp_query->get_queried_object();
        $post_categories = wp_get_post_categories($queried_object->ID);
        //echo 'post_categories';
        //var_dump($post_categories);
        //$current_category[] = $queried_object->term_id;
        //var_dump($current_category, $category);
        //echo '<br/>';
        // uncomment the following if you want to debug:
        // echo '<pre>Category of this menu item<br />';
        // print_r($category);
        // echo '</pre>';
        // echo '<pre>Category queried for this page<br />';
        // print_r($current_category);
        // echo '</pre>';

        if (in_array($category, $post_categories)) {

            $classes[] = 'current-menu-item';
        }
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'seadstem_nav_class', 10, 2);

function custom_rating_image_extension() {
    return 'png';
}

add_filter('wp_postratings_image_extension', 'custom_rating_image_extension');

function return_news_events_category($arg = '') {
    return 78;
}

add_filter('news_events_id', 'return_news_events_category');


/* Additional Column in Post List */

function seadstem_columns_head($columns) {

    $n_columns = array();
    $before = 'author'; // move before this
    foreach ($columns as $key => $value) {
        if ($key == $before) {

            $n_columns['en_title'] = 'EN Title';
        }
        if ($key == 'title') {
            $n_columns['id'] = 'id';
        }
        $n_columns[$key] = $value;
    }
    return $n_columns;

//
//    $defaults['en_title'] = 'EN Title';
//    return $defaults;
}

// SHOW THE EN Title
function seadstem_columns_content($column_name, $post_id) {
//    echo 'here';
//    var_dump($column_name);
    if ($column_name == 'en_title') {
        // echo $column_name;
        $post = get_post(pll_get_post($post_id, 'en'));
//        var_dump($post);
        echo $post->post_title;
        echo ' (' . pll_get_post($post_id, 'en') . ')';
    }
    if ($column_name == 'id') {
        echo $post_id;
    }
}

add_filter('manage_posts_columns', 'seadstem_columns_head');
add_action('manage_posts_custom_column', 'seadstem_columns_content', 1, 2);
add_action('manage_unit_posts_custom_column', 'seadstem_columns_content', 1, 2);

/* Additional Column in Post List */

function seadstem_get_attachment_id_by_url($url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url));
    return $attachment[0];
}

/*
 * 	Re-usable RSS feed reader with shortcode
 */
if (!function_exists('base_rss_feed')) {

    function base_rss_feed($size = 5, $feed = 'http://wordpress.org/news/feed/', $date = false, $cache_time = 1800) {
        // Include SimplePie RSS parsing engine
        include_once ABSPATH . WPINC . '/feed.php';

        // Set the cache time for SimplePie
        add_filter('wp_feed_cache_transient_lifetime', create_function('$a', "return $cache_time;"));

        // Build the SimplePie object
        $rss = fetch_feed($feed);

        // Check for errors in the RSS XML
        if (!is_wp_error($rss)) {

            // Set a limit for the number of items to parse
//            var_dump($rss->get_error_code());
            $maxitems = $rss->get_item_quantity($size);
            $rss_items = $rss->get_items(0, $maxitems);
//            var_dump($rss->get_items());
            // Store the total number of items found in the feed
            $i = 0;
            $total_entries = count($rss_items);

            // Output HTML
            $html = "<div class='card-columns'>";
            foreach ($rss_items as $item) {
                $i++;

                // Add a class of "last" to the last item in the list
                if ($total_entries == $i) {
                    $last = " class='last'";
                } else {
                    $last = "";
                }

                // Store the data we need from the feed
                $title = $item->get_title();
                $link = $item->get_permalink();
                $desc = $item->get_description();
                $date_posted = $item->get_date('F j, Y');

                // Output
//                $html .= "";
//                $html .= '<a href="'.$link.'">'.$title.'</a>';
//                if ($date == true)
//                    $html .= "$date_posted";
//                $html .= "$desc";
////                $html .= '<a href="'.$link.'">Click Here</a>';
//                $html .= "<br/>";
                $html .= "";
                $html .= '<!-- <div class="col-md-3"> -->
                            <div class="card">
                                <div class="card-body">';
                $html .= '<h5 class="card-title">' . $title . '</h5>';
                $html .= '<p class="card-text">' . $desc . '</p>';
                $html .= '<a href="' . $link . '" class="btn btn-primary">Go somewhere</a>';
                $html .= '</div>
                        </div>
                    <!-- </div> -->';
            }

            $html .= "</div>";
        } else {

            $html = "An error occurred while parsing your RSS feed. Check that it's a valid XML file.";
        }

        return $html;
        echo 'rss here';
    }

}
/** Define [rss] shortcode */
if (function_exists('base_rss_feed') && !function_exists('base_rss_shortcode')) {

    function base_rss_shortcode($atts) {
        extract(shortcode_atts(array(
            'size' => '10',
            'feed' => 'http://wordpress.org/news/feed/',
            'date' => false,
                        ), $atts));

        $content = base_rss_feed($size, $feed, $date);
        return $content;
    }

    add_shortcode("rss", "base_rss_shortcode");
}

function save_event_meta($post_id, $post) {

//     $post_type = get_post_type($post_id);
//  
//    // If this isn't a 'event' post, don't update it.
//    if ( "event" != $post_type ) return;
//     update_post_meta( $post_id, 'wpcf-event-id', 'ABCDE' );
//    echo '<pre>';
//    var_dump($post);
//    echo '<hr/>';
//    var_dump($_POST);
//    echo '<hr/>';
//    echo serialize($_POST['wpcf']['topics']);
//    echo '<hr/>';
    if (isset($_POST['wpcf']['topics'])) {
        foreach ($_POST['wpcf']['topics'] as $topic_to_save => $topic_value_to_save) {
            $_POST['wpcf']['topics'][$topic_to_save][0] = pll__($topic_value_to_save[0]);
//        echo 'Topic to store:'. pll__($topic_value_to_save[0]);
//        echo '<hr/>';
        }
//    var_dump($_POST['wpcf']['topics']);
//    exit;
        update_post_meta($post_id, 'wpcf-topics', $_POST['wpcf']['topics']);
    }
}

add_action('save_post', 'save_event_meta', 20, 2);
//add_action('wpcf_fields_checkbox_save_check','testF', 10,2);
//function testF($a,$b){
//    exit;
//}
//function ron_update_postmeta( $meta_id,  $object_id,  $meta_key, $meta_value ){
//      
////     $post_type = get_post_type($post_id);
////  
////    // If this isn't a 'event' post, don't update it.
////    if ( "event" != $post_type ) return;
////     update_post_meta( $post_id, 'wpcf-event-id', 'ABCDE' );
////    var_dump($_POST);
//    echo '<pre>';
//    var_dump(types_get_field( 'topics' ));
//    exit;
////    $meta_key = 'wpcf-topics'; //name of custom checkbox group
////    $values = get_post_custom_values( $meta_key); //a
////    var_dump($values);
////    exit;
//    if($meta_key == '_wptoolset_checkbox'){
//        
//    }
//    log_it($meta_key);
//}
//add_action( 'update_postmeta', 'ron_update_postmeta', 20,4 );

if (!function_exists('log_it')) {

    function log_it($message) {
        if (WP_DEBUG === true) {
            if (is_array($message) || is_object($message)) {
                error_log(print_r($message, true));
            } else {
                error_log($message);
            }
        }
    }

}