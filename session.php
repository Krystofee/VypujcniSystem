<?php
/*
*	Name: 		cookies.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Start session
*/

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}