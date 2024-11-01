<?php
	
add_action( 'widgets_init', 'rs_login_widgets' );
/*
 * register cx widget lists
 */
function rs_login_widgets(){
	include_once( RS_PLUGIN_PATH . 'lib/widgets/rs-login.php' );
	
	register_widget( 'RS_login' );
}

?>