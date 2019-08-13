<?php

/**
 * Seadstem Plugin
 *
 * Plugin for Seadstem
 *
 * @package SeRec
 * @author Ronald D. Pedraja
 * @since 0.1.0.0
 */
/*
  Plugin Name: Seadstem Plugin
  Description: Plugin that handles Seadstem specific requirements
  Author: Ronald D. Pedraja
  Version: 1.0.0
  Author URI: https://webdevstudios.com/
  License: GPLv2
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__));

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


if (class_exists("Inc\\Init")) {
    Inc\Init::register_services();
}
