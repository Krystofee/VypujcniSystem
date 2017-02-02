<?
/*
*	Name: 		session.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		handling aplication session from AJAX's requests and session as whole
*/

// starts sessionv
require 'session.php';

// executes only if it is awoken by AJAX's request with myData in POST method
if (isset($_POST['myData'])) {
	$json_encoded = $_POST['myData'];
	$data = json_decode($json_encoded);

	if (isset($data[0]->destroy)) {
		session_unset();
		die('Session was unset and everybody unlogged');
	}

	for($i = 0; $i < count($data); $i ++) {
		$_SESSION[$data[$i]->name] = $data[$i]->status;
	}
}
