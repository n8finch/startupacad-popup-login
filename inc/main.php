<?php


add_action('wp_footer', 'n8f_is_learndash_content');
add_action('wp_footer', 'n8f_pop_do_login_message');

function n8f_pop_is_user_not_logged_in() {

	if(!is_user_logged_in()) {
		return true;
	} else {
		return false;
	}
}


function n8f_is_learndash_content() {

	if( get_field('show_popup_on_this_page') === 'yes'  ) {
		return true;
	} else {
		return false;
	}
}



function n8f_pop_do_login_message() {

if (n8f_pop_is_user_not_logged_in() && n8f_is_learndash_content()) {

 	?>
 	<div id="n8f-popup-login-message">
		<div class="popup-header-image">
			<img src="/wp-content/themes/new-startupacademy/images/logo-square-3x.png"  />
			<h2>GET STARTED</h2>
			<p>with a free discover pass</p>
		</div>
		<div class="popup-main-content">
			<p style="margin-bottom: 0;">Ready to begin your startup journey? Join thousands of others to access exclusive content and learn to thrive as an entrepreneur.</p>
			<ul>
				<li><a href="#tabs-1">Register</a></li>
				<li><a href="#tabs-2">Login</a></li>
			</ul>

		  	<div id="tabs-1" name="myRegistrationForm">
		  		<p class="status"></p>
				<p>Choose your pass:
					<select id="popup-pass-select" name="email" />
						<option value="free" selected>Free</option>
						<option value="allaccess">All Access Pass (USD $10.99/month)</option>
						<option value="challenge">Challenge Pass (USD $199, one-time purchase)</option>
					</select>
				</p>
				<p>Enter your email: <input type="email" id="popup-email-register" name="email" required="true"/></p>
				<p>Choose a password: <input type="password" id="popup-password-register" name="password" required="true"/></p>
				<p class="button-container"><button id="popup-submit-register">REGISTER</button></p>
				<p>If you are already registered then please click the Login tab.</p>
			</div>
				<div id="tabs-2">
					<form id="login" action="login" method="post">
				        <p class="status"></p>
				        <p class="username"><label for="username">Email: </label><input id="username" type="text" name="username"></p>
				        <p><label for="password">Password: </label><input id="password" type="password" name="password"></p>
							<p class="button-container"><input class="submit_button" type="submit" value="LOGIN" name="submit"></p>
							<p><a class="lost" href="https://www.startupacademy.org/forgot-password/">Lost your password?</a></p>
				        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

			    	</form>

		    </div>
		</div> <!-- end popup-main-content -->



	</div> <?php //end popup

	}
}



// Enable the user with no privileges to run ajax_login() in AJAX
add_action( 'wp_ajax_ajaxlogin', 'n8f_pop_ajax_login' );
add_action( 'wp_ajax_nopriv_ajaxlogin', 'n8f_pop_ajax_login' );

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
