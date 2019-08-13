<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Inc;

/**
 * Description of Init
 *
 * @author rpedraja
 */
class Init {

    public static function get_services() {
        return [
            pages\Admin::class,
            controllers\CustomPostTypeController::class,
            controllers\ShortCodeController::class,
        ];
    }

    //put your code here
    public static function register_services() {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    public static function instantiate($class) {
        return new $class();
    }

}

//class SeameoRecruitment {
//
//    public $plugin;
//
//    public function __construct() {
//        $this->plugin = plugin_basename(__FILE__);
//        add_action('init', [$this, 'custom_post_type']);
//    }
//
//    public function register() {
//        add_action('admin_enqueue_scripts', [$this, 'enqueue']);
//
//        add_action('admin_menu', [$this, 'add_admin_pages']);
//
//        add_filter('plugin_action_links_' . $this->plugin, [$this, 'settings_link']);
//    }
//
//    public function settings_link($links) {
//        $settings_link = '<a href="admin.php?page=e_recruitment_settings">settings</a>';
//        array_push($links, $settings_link);
//        return $links;
//    }
//
//    public function add_admin_pages() {
//        add_menu_page('e-Recruitment Settings', 'e-Recruitment', 'manage_options', 'e_recruitment_settings', [$this, 'admin_index'], 'dashicons-id-alt', null);
//    }
//
//    public function admin_index() {
//        //page that will laod on menu_page
//        require_once plugin_dir_path(__FILE__) . 'template/settings.php';
//    }
//
//    public function activate() {
//        $this->custom_post_type();
//        flush_rewrite_rules();
//    }
//
//    public function deactivate() {
//        flush_rewrite_rules();
//    }
//
//    public function uninstall() {
//        
//    }
//
//    public function custom_post_type() {
//        register_post_type(
//                'applicant', ['public' => true, 'label' => 'Applicant']
//        );
//    }
//
//    public function enqueue() {
//        wp_enqueue_style('seameo-e-recruitment-style', plugins_url('/assets/test.css', __FILE__), [], false, 'all');
//        wp_enqueue_script('seameo-e-recruitment-style', plugins_url('/assets/test.js', __FILE__), [], false, 'all');
//    }
//
//}
//
//if (class_exists('SeameoRecruitment')) {
//    $seameoRecruitment = new SeameoRecruitment();
//    $seameoRecruitment->register();
//}
//
//register_activation_hook(__FILE__, [$seameoRecruitment, 'activate']);
//register_deactivation_hook(__FILE__, [$seameoRecruitment, 'deactivate']);
