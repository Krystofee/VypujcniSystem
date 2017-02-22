<?php
/*
*	Name: 		tag_AJAX.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		fille called by component_tag_add javascript function used to create tag
*	POST: itemname, evc, desc, catid	
*	FILES: image, preview
*/


require 'session.php';
require_once 'database.php';

Database::connect();

// get data from POST
$itemname = $_POST['itemname'];
$evc = $_POST['evc'];
$desc = $_POST['desc'];
$catid = $_POST['catid'];

// get items from POSTED Files
$image = $_FILES['image'];
$preview = $_FILES['preview'];

// set directory
/*
*	Directory format:
*				/uploads/items/itemname-evc/*
*											- item.jpg
*											- preview.jpg			
*/
$dir = 'uploads/items/' . $itemname . '-' . $evc . '/';
if(!file_exists($dir)) {
	mkdir($dir);	
}

move_uploaded_file($image['tmp_name'], $dir . 'image.jpg');
move_uploaded_file($preview['tmp_name'], $dir . 'preview.jpg');

// insert item into database
$sql = 'INSERT INTO items (id, name, description, evc, category_id, tags_id, ordered) VALUES(null, "' . $itemname . '", "' . $desc . '", "' . $evc . '", "' . $catid . '", null, null)';

Database::exec($sql);

Database::close();
