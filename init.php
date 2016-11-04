<?php
/*
Plugin Name: N8F Popup Login
Plugin URI:  http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This describes my plugin in a short sentence
Version:     1.5
Author:      Nate Finch
Author URI:  http://URI_Of_The_Plugin_Author
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: n8f-popup-login
*/

namespace n8fPopupLogin;

require_once plugin_dir_path( __FILE__ ) . 'inc/main.php';

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\n8f_pop_add_these_plugin_styles_and_scripts' );

function n8f_pop_add_these_plugin_styles_and_scripts() {

	wp_enqueue_style( 'n8f-pop-login-css', plugin_dir_url( __FILE__ ) . 'css/n8f-pop-login.css' );

	wp_enqueue_script( 'n8f-pop-login-js', plugin_dir_url( __FILE__ ) . 'js/n8f-pop-login.js', array( 'jquery', 'jquery-ui-dialog', 'jquery-ui-tabs' ), false, false );

}



