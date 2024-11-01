<?php

add_shortcode( 'wp_rslogin', 'wp_rslogin_shortcode' );

function wp_rslogin_shortcode( $atts, $post_content ) 
{
	$wp_rslogin = wp_rslogin();
	$content_first = $post_content.$wp_rslogin;
	
	return $content_first;
}

function wp_rslogin()
{ 
	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	?>
	
	<div class="panel-cotainer">

		<div class="panel">
			<div id="message"></div>
			
			<div class="user_login-wrapper">
				<?php
					if ( is_user_logged_in() ) { ?>
					
						<div class="loggedin">
							<div class="profile-pic">
								<?php echo get_avatar( $current_user->user_email, $size = '45' ); ?>
							</div>
							<div class="profile-info">
								<p class="userlogged">Hi, <a href="<?php echo admin_url(); ?>profile.php"><?php echo (($current_user->display_name != "") ? $current_user->display_name : $current_user->user_login) ?></a></p>
							</div> <div class="clear"></div>
							
							<ul class="user-info-list">
								<li><a href="<?php echo admin_url(); ?>" title="Dashboard">Dashboard</a></li>
								<li><a href="<?php echo admin_url(); ?>profile.php" title="Profile">Profile</a></li>
							</ul>
							<p><a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout" class="button logout"><strong>Logout</strong></a></p>
						</div><?php
						
					} else { ?>
					
						<form method="post" id="login_form"> 
							<fieldset>
								<?php
									if ( function_exists('wp_nonce_field') ) 
										wp_nonce_field('rs-login_user_login'); 
								?>
								<p><label class="label" for="username">Username </label> <br />
									<input type="text" name="username" id="username" size="30" /></p>
								<p><label class="label" for="password">Password </label> <br />
									<input type="password" name="password" id="password" size="30" /> </p>
								<p><label class="label"><input type="checkbox" name="rememberme" id="rememberme" value="true" /> Remember Me</label></p>
								
								<p><input type="submit" value="Log In" class="button" id="submit" /> or <a href="javascript: void(0);" id="forgot_password">Forgot Password</a> </p>
								<p>Not a member?  <a href="<?php echo home_url('/'); ?>wp-login.php?action=register">Register today!</a></p>
							</fieldset>
						</form><?php
						
					}
				?>
				
			</div>
		
			<div class="user_reset-wrapper">
				
				<form method="post" id="reset_form">
					<?php
						if ( function_exists('wp_nonce_field') ) 
							wp_nonce_field('rs-login_reset_password'); 
					?>
					<fieldset>
						<p>Please enter your username or email address. You will receive a link to create a new password via email.</p>
						<p><label for="user_login">Username or E-mail:</label>
							<input type="text" name="user_login" id="user_login"  value="" /></p>
						<p><input type="submit" value="Reset Password" class="button" id="submit" /> <span> or <a href="javascript: void(0);" id="login_now">Login Now</a></span></p>
					</fieldset> 
				</form>
				
			</div>
		</div>
		
	</div>
	
	<?php
	// Stop output buffering and capture debug HTML
	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
}

?>