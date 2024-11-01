 === WP RSlogin ===
Contributors: 		ryansutana
Donate link: 		https://www.paypal.com/us/cgi-bin/webscr?cmd=_flow&SESSION=E2VJULJAtQi7Ncy4umbvN0BuA4d5XQ7giPP0bIWopu2ShQuZFyxZf3uo9Wu&dispatch=5885d80a13c0db1f8e263663d3faee8d4026841ac68a446f69dad17fb2afeca3
Tags: 				login, log in, ajax login, jquery login, reset password, edit password, custom login
Requires at least: 	3.0.0
Tested up to: 		4.8
Stable tag: 		1.1.0
License: 			GPLv2 or later
License 			URI: http://www.gnu.org/licenses/gpl-2.0.html

An elegant jQuery Ajax Wordpress plugin that helps your users login without touching in the admin panel.

== Description ==
An elegant jQuery Ajax Wordpress plugin that helps your users login without touching in the admin panel.

After login the plugin redirected to the page where you add the shortcode or template tag and display a list of options like visit to profile page, dashboard and a logout button.

= Important links =
* My portfolio: http://www.sutanaryan.com/portfolio/
* My Blog: http://www.sutanaryan.com/
* Twitter: @ryansutana
* Need a Web Developer [visit http://www.sutanryan.com/services/]

== Installation ==

= Method 1. =
1. Download the "WP RSlogin" plug-in for your WordPress version.
2. Unzip the downloaded file and extract the code to to your /wp-content/plugins/ folder OR simply choose upload in the upper left corder and in the upload box select the wp-rslogin.zip file you downloaded.
3. To complete installation you should activate the plugin in the plug-ins section of your administration panel.

= Method 2. =
1. Go to your WordPress admin account.
2. Open Plug-Ins in the left-side bar menu, choose Add New, and search for WP RSlogin plug-in. Choose the available "WP RSlogin".
3. Install the plug-in and activate it in your account.

== Frequently Asked Questions ==

= How do I add WP RSlogin into my site? =
You can add this plugin in two easist way, by

= shortcode =
[wp_rslogin]

or

= Template code =
if(function_exists(wp_rslogin)) {
wp_rslogin();
}

or

do_shortcode('[wp_rslogin]');


= Can I use this plugin into my site sidebar? =
Yes, just use the shortcode [wp_rslogin], 
if this does not work, then you need to add a little trick into the function.php file of your site.

add_filter('widget_text', 'do_shortcode'); // add this code anywhere in your function.php file

== Screenshots ==

1. This is the Login form. Super simple, it contains all you need including reset and registration link.
2. This is the Reset form. Simple enough and straight forward.
2. This is the Logged-in layout. User will see this once a user has been successfully logged-in.

== Changelog ==

= 2.0 =
* Updated the plugin code, much more user friendly.
* Added lists of screenshots

= 1.1.0 =
* Add Reset Password
* Edit Preloader

= 1.0.5 =
* Change after login interface
* Add Avatar picture
* Change logout URI

= 1.0.0 =
* Initial release version


== Upgrade Notice ==

= 2.0 =
Updated the plugin code, much more user friendly and Added lists of screenshots

= 1.1.0 =
Add Reset Password and Edit Preloader.

= 1.0.5 =
This is just short upgrade that contains basic changes on the plugin interface.

= 1.0.0 =
This is the initial release, no upgrade notice yet at the moment, all you need to do is download and install the plugin.