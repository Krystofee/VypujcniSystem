<?php
/*
*	Name: 		tag_AJAX.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		
*/


require 'session.php';
require_once 'database.php';

Database::connect();

// get data from POST method
$json_encoded = $_POST['myData'];
$data = json_decode($json_encoded);

$tag_name = $data[0]->tagname;

$sql = 'INSERT INTO tags (id, name) values (null, "' . $tag_name . '")';
Database::exec($sql);

Database::close();