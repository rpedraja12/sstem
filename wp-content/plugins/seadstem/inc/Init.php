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
            controllers\TeacherRoleController::class,
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
