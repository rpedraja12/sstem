<?php

/**
 * This file runs when wordpress uninstall the plugin
 * @package SeRec
 */

// Exit if accessed directly.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

$applicants = get_post(['post_type' => 'applicant', 'numberpost' => -1]);

foreach($applicants as $applicant){
    wp_delete_post($applicant->ID, true);
}
