<?php

namespace Inc\controllers;

class ShortCodeController {

    public $custom_post_types = [];
    public static $POST_TYPE_SLUG = 'ecertificate';

    public function __construct() {
        ;
    }

    public function register() {
        
        add_shortcode('participant_info', [$this,'getParticipantInfo']);
        add_filter('the_content','do_shortcode');
    }

    public function getParticipantInfo($attr){
        $post = get_post(get_the_ID());
        $post_meta = get_post_meta($post->ID,'_seameo_ecertificate_personal_info_key', true);
        if(empty($post)){
            return "";
        }

        if(empty($attr['field'])){
            return '';
        }
        if($attr['field'] == 'title'){
            return $post->post_title;
        }
        if(array_key_exists($attr['field'], $post_meta)){
            return $post_meta[$attr['field']];
        }
        
        return '';
    }
    

}
