<?php
/*
*	Name: 		item_list_AJAX.php
*	Author: 	Krystofee
*	Created: 	2.2.2017
*	Desc: 		
*/

require 'session.php';
require_once 'database.php';

Database::connect();

// get data from POST method
$json_encoded = $_POST['myData'];
$data = json_decode($json_encoded);

if(isset($data->catname)) {
	$catname = $data->catname;
	
	$sql = 'SELECT id FROM categories WHERE name LIKE "' . $catname . '"';
	$catid = Database::select($sql);

	if(sizeof($catid) < 1) {
		die('Category '.$catname.' does not exist ...');
	}

	$sql = 'SELECT id, name, description, evc, tags_id, ordered FROM items WHERE category_id LIKE "' . $catid[0][0] . '"';
	$result = Database::select($sql);

	if(sizeof($catname) < 1) {
		die('Category '.$catname.' is empty ...');
	}

	$json = json_encode($result);
} elseif(isset($data->tagname)) {
	// prepared for future
}

Database::close();

if (isset($json)) {
	die($json);
} else {
	die('component item_list_AJAX returned nothing');
}