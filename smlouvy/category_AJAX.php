<?php
/*
*	Name: 		category_AJAX.php
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

$cat_name = $data[0]->catname;
$par_id = $data[0]->parid;

$sql = 'INSERT INTO categories (id, name, parent_id) values (null, "' . $cat_name . '", "' . $par_id . '")';
Database::exec($sql);

Database::close();