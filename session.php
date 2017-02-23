<?php
/*
*	Name: 		cookies.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Start session if has not already started
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
