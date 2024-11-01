/*
 * @author Ryan Sutana
 * @description procees all datas passed from front-end
 * since v 1.5.0
 */

jQuery(document).ready(function($) 
{
	// login form
	$("#login_form").submit(function(){
		var data = {
			action: 'user_login_action',
			nonce: this._wpnonce.value,
			username: this.username.value,
			password: this.password.value,
			rememberme: this.rememberme.value
		};
		
		// disable button onsubmit to avoid dubble submittion
		$(".user_login-wrapper #submit").attr("disabled", "disabled");
		
		// add our pre-loading
		$(".user_login-wrapper #submit").val("loading...");
		
		$.post(rs_login.url, data, login_response);
		
		return false;
	});
	
	function login_response( data ) {
		// return the value to default
		$(".user_login-wrapper #submit").val("Log In");
		
		//append data to #message
		$(".panel #message").html(data);
		
		// remove attr disabled
		$(".user_login-wrapper #submit").removeAttr("disabled");
	}
	
	
	// reset form
	$("#reset_form").submit(function(){
		var data = {
			action: 'user_reset_action',
			nonce: this._wpnonce.value,
			email: this.user_login.value
		};
		
		// disable button onsubmit to avoid dubble submittion
		$(".user_reset-wrapper #submit").attr("disabled", "disabled");
		
		// add our pre-loading
		$(".user_reset-wrapper #submit").val("loading...");
		
		$.post(rs_login.url, data, reset_response);
		
		return false;
	});
	
	
	function reset_response( data ) {
		// return the value to default
		$(".user_reset-wrapper #submit").val("Reset Password");
		
		//append data to #message
		$(".panel #message").html(data);
		
		// remove attr disabled
		$(".user_reset-wrapper #submit").removeAttr("disabled");
	}

});