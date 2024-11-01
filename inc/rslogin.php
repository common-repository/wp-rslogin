<?php
/*
 * @author Ryan Sutana
 * @description save data to database or display message if everthing goes wrong
 * since v 1.5.0
 */

add_action('wp_ajax_nopriv_user_login_action', 'user_login_action_callback');
add_action('wp_ajax_user_login_action', 'user_login_action_callback');
function user_login_action_callback() 
{
	global $wpdb;
	$error = '';
	$success = '';
	
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'rs-login_user_login' ) )
        die ( 'Security checked!');
		
	$username = $wpdb->escape(trim($_POST['username']));
	$password = $wpdb->escape(trim($_POST['password']));
	$rememberme = (isset($_POST['rememberme']) ?  $_POST['rememberme'] : 'false');
	
	if( empty( $username ) ) {
		$error = 'The username field is empty.';
	} else if( empty( $password ) ) {
		$error = 'The password field is empty.';
	}  else {

		$credentials = array();
		
		$credentials['user_login'] = $username;
		$credentials['user_password'] = $password;
		$credentials['remember'] = $rememberme;
		$user = wp_signon( $credentials, false );
		
		if ( is_wp_error( $user ) ) {
			$error = $user->get_error_message();
		} else {
			wp_set_current_user( $user->ID );
			
			// successfully login
			echo '<meta http-equiv="refresh" content="0; url='. get_permalink() .'">';
		}
	}
	
	if( ! empty( $error ) )
		echo '<div class="error_login"><strong>ERROR:</strong> '. $error .'</div>';
	
	if( ! empty( $success ) )
		echo '<div class="updated">'. $success .'</div>';
	
	
	//return proper result
	die();
}


add_action('wp_ajax_nopriv_user_reset_action', 'user_reset_action_callback');
add_action('wp_ajax_user_reset_action', 'user_reset_action_callback');
function user_reset_action_callback() 
{
	global $wpdb;
	$error = '';
	$success = '';
	
	$nonce = $_POST['nonce'];
 
    if ( ! wp_verify_nonce( $nonce, 'rs-login_reset_password' ) )
        die ( 'Security checked!');
		
	$email = $wpdb->escape(trim($_POST['email']));
	
	if( empty( $email ) ) {
		$error = 'Enter a username or e-mail address..';
	} else if( is_email( $email )) {
		$error = 'Invalid username or e-mail address.';
	} else if( ! email_exists($email) ) {
		$error = 'There is no user registered with that email address.';
	} else {
	
		$random_password = wp_generate_password( 12, false );
		$userid = get_user_id_from_string( $email );
		
		$update_user = wp_update_user( array (
				'ID' => $userid, 
				'user_pass' => $random_password
			)
		);
		
		if( $update_user ) {
			$to = $email;
			$subject = 'Your new password';
			$sender = get_option('name');
			
			$message = 'Your new password is: '.$random_password;
			
			$headers[] = 'MIME-Version: 1.0' . "\r\n";
			$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers[] = "X-Mailer: PHP \r\n";
			$headers[] = 'From: '.$sender.' <'.$email.'>' . "\r\n";
			
			$mail = wp_mail( $to, $subject, $message, $headers );
			if( $mail )
				$success = 'Check your email address for you new password.';
				
		} else {
			$error = 'Oops something went wrong updaing your account.';
		}

	}
	
	if( ! empty( $error ) )
		echo '<div class="error_login"><strong>ERROR:</strong> '. $error .'</div>';
	
	if( ! empty( $success ) )
		echo '<div class="updated"> '. $success .'</div>';
		
	//return proper result
	die();
	
}
?>