<?php
/**
 * @package Zawgyi_mobile
 * @version 2.1.1
 */
/*
Plugin Name: Zawgyi Embed
Plugin URI: http://wordpress.org/extend/plugins/zawgyi-embed/
Description: Zawgyi Mobile
Author: saturngod
Version: 2.1.1
Author URI: http://www.saturngod.net
*/

function zawgyi_css() {
	if(!is_admin())
	{
?>
        <link rel='stylesheet' href='https://mmwebfonts.comquas.com/fonts/?font=zawgyi'/>
<?php
	}
	
}

function footer_css() {
	if (get_option('zawgyi_forceCSS') == 1 && !is_admin()) {
?>
		
		<style>
			body,html,p,code,table,td,tr,span,div,a,ul,li,input,textarea,pre,select,h1,h2,h3,h4,h5,h6 {
				font-family: "Zawgyi-One" !important;
			}
		</style>

<?php
	}

}
add_action('wp_head', 'zawgyi_css');
add_action('wp_footer','footer_css');

require 'adminpanel.php';

?>
