<?php
/*
*	Name: 		item_list_AJAX.php
*	Author: 	Krystofee
*	Created: 	2.2.2017
*	Desc: 		
*/

/*
*	To do list:
*				- DONE - make item filtering system on line 41
*/

require 'session.php';
require_once 'database.php';
require_once 'component_item_cart_functions.php';

Database::connect();

// get data from POST method
$json_encoded = $_POST['myData'];
$data = json_decode($json_encoded);

if(isset($data->catname)) {

	$catname = $data->catname;
	
	$sql = 'SELECT id FROM categories WHERE name LIKE "' . $catname . '"';
	$catid = Database::select($sql);

	// check if category exists
	if(sizeof($catid) < 1) {
		die('Category '.$catname.' does not exist ...');
	}
	
	$sql = 'SELECT id, name, description, evc, tags_id, ordered FROM items WHERE category_id LIKE "' . $catid[0][0] . '"';
	$result = Database::select($sql);
	
	// check if category is not empty
	if(sizeof($catname) < 1) {
		die('Category '.$catname.' is empty ...');
	}

	// filter listed items from returned array, which are already in cart 
	$filtered = [];
	$j = 0;
	
	for($i = 0; $i < sizeof($result); $i ++) {
		if(!isInCart($result[$i][0])) {
			$filtered[$j] = $result[$i];
			$j ++;
		}
	}

	/*
	*	To do: - filter items which are already ordered or are already borrowed
	*/
	// 	HERE

	// encode to return
	$json = json_encode($filtered);

} elseif(isset($data->itemid)) {
	// get only one item parameters

	$sql = 'SELECT name, evc FROM items WHERE id LIKE "' . $data->itemid . '"';
	$result = Database::select($sql);

	// check if item exists
	if(sizeof($result) < 1) {
		die('Item ' . $data->itemid . ' does not exist');
	}

	// encode to return
	$json = json_encode($result);

} elseif(isset($data->tagname)) {
	/*
	*	To do : tag searching
	*/ 
	// prepared for future for the tag searching
}

Database::close();

if (isset($json)) {
	die($json);
} else {
	die('component item_list_AJAX returned nothing');
}