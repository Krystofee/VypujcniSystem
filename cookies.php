<?
/*
*	Name: 		cookies.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		handling aplication cookies from start to end :)
*/

require 'session.php';

// acceptation cookie name
$cookie_name = "cookies_accepted";

if (isset($_SESSION['cookies_accepted'])) {
	if ($_SESSION['cookies_accepted']) {
		if (!isset($_COOKIE["cookies_accepted"])) {
			// Create first cookie if it does not exist
			$cookie_value = true;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30));
		}
	}
}

// if cookies were accepted
if (isset($_COOKIE['cookies_accepted'])) {
	if ($_COOKIE['cookies_accepted']) {
		// CODE WITH COOKIES AND EVERYTHING ABOUT THEM
	}
}




