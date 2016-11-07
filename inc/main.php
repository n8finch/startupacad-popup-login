<?php


add_action('wp_footer', 'n8f_pop_do_login_message');
add_action('wp_footer', 'n8f_is_learndash_content');
add_action('wp_footer', 'n8f_pop_do_login_message');

function n8f_pop_is_user_logged_in() {

	if(!is_user_logged_in()) {
		return true;
	} else {
		return false;
	}
}


function n8f_is_learndash_content() {

	if(is_singular('sfwd-lessons' ) || is_singular('sfwd-courses' ) || is_singular('sfwd-topic' )) {
		return true;
	} else {
		return false;
	}
}


function n8f_pop_do_login_message() {

if (n8f_pop_is_user_logged_in() && n8f_is_learndash_content()) {

 echo '<div id="n8f-popup-login-message">
		  	<div name="myForm">
					Email: <input type="email" id="popup-email" name="email" /> <br />
					<button id="popup-submit"/>Register</button>
				</div>

		</div>'; //end popup

	}
}