<?php


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

 	?>
 	<div id="n8f-popup-login-message">
				<ul>
			    <li><a href="#tabs-1">Register</a></li>
			    <li><a href="#tabs-2">Login</a></li>
			  </ul>

		  	<div id="tabs-1" name="myRegistrationForm">
		  		<p class="status"></p>
					Email: <input type="email" id="popup-email-register" name="email" /> <br />
					<button id="popup-submit-register"/>Register</button>
				</div>
				<div id="tabs-2">
					<form id="login" action="login" method="post">
			        <p class="status"></p>
			        <label for="username">Username</label>
			        <input id="username" type="text" name="username">
			        <label for="password">Password</label>
			        <input id="password" type="password" name="password">
			        <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
			        <input class="submit_button" type="submit" value="Login" name="submit">
			        <a class="close" href="">(close)</a>
			        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
			        <a class="login_button" id="show_login" href="">Login</a>
			    </form>

		    </div>


		</div> <?php //end popup

	}
}



function n8f_pop_ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }

    die();
}