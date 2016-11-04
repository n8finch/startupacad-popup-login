<?php


add_action('template_redirect', 'n8f_pop_do_login_message');
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
		  	<div id="tabs">
				  <ul>
				    <li><a href="#tabs-2">Register</a></li>
				    <li><a href="#tabs-3">Login</a></li>
				  </ul>
				  <div id="tabs-2">
				    <form id="n8f-pop-register-form" method="post" action="http://startupacademy.staging.wpengine.com/wp-content/plugins/membermouse/api/webform.php">
									<table>
									<tr>
									  <td>Email</td>
									  <td><input type="text" name="email" required/></td>
									</tr>
									<tr>
									  <td>Password</td>
									  <td><input type="password" name="password" /></td>
									</tr>
									<tr>
									  <td></td>
									  <td>
									  <input type="submit" name="submit" value="Sign Up" />
										<input type="hidden" name="membership_level" value="3" />
									  </td>
									</tr>
									</table>
								</form>
				  </div>
				  <div id="tabs-3">
				  	<form id="n8f-pop-login-form" action="http://startupacademy.staging.wpengine.com/wp-login.php" method="post">
									<table>
									  <tr>
									    <td>Username</td>
									    <td><input type="text" id="log" name="log" required/></td>
									  </tr>
									  <tr>
									    <td>Password</td>
									    <td><input type="password" id="pwd" name="pwd" /></td>
									  </tr>
									  <tr>
									    <td></td>
									    <td>
									      <input type="submit" name="submit" value="Login" />
										  	<input name="rememberme" type="checkbox" checked="checked" value="forever" />
										  Remember me    </td>
									  </tr>
									  <tr>
									    <td></td>
									    <td>
									      <a href="http://startupacademy.staging.wpengine.com/forgot-password/">Forgot Password</a>
									    </td>
									  </tr>
									</table>
								</form>
				  </div>

				</div>

		</div>'; //end popup

	}
}