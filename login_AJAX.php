<?
/*
*	Name: 		login.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		script used to accept AJAX request and handle log into 
*				users account and store information about user in superglobal $_SESSION
*/


require 'session.php';
require_once 'database.php';


$json_encoded = $_POST['myData'];
$data = json_decode($json_encoded);

$username_email = $data->username;
$password = $data->password;


Database::connect();

$sql = 'SELECT password FROM users WHERE username LIKE "' . $username_email . '" OR email LIKE "' . $username_email . '"';

$result = Database::select($sql);

echo "Username: " . $username_email;

// checks if username or email exists in database
if(count($result) != 1)
	die('2 - bad_username');

$db_password = $result[0][0];

// if input password matches with that one in DB, continue
if(sha1($password) == $db_password) {

	// store data in $_SESSION
	$sql = 'SELECT id FROM users WHERE username LIKE "' . $username_email . '" OR email LIKE "' . $username_email . '"';
	$result = Database::select($sql);
	$_SESSION['user']['id'] = $result[0][0];

	$sql = 'SELECT username FROM users WHERE id LIKE "' . $_SESSION['user']['id'] . '"';
	$result = Database::select($sql);
	$_SESSION['user']['username'] = $result[0][0];

	$sql = 'SELECT email FROM users WHERE id LIKE "' . $_SESSION['user']['id'] . '"';
	$result = Database::select($sql);
	$_SESSION['user']['email'] = $result[0][0];

	Database::close();
	die("0 - logged_in");
} else {
	die("1 - bad_password");
}
