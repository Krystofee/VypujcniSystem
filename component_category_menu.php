<?php 
/*
*	Name: 		component_category_menu.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Compoent which displays the categories
*/

require_once 'database.php';

Database::connect();

$sql = 'SELECT id, name, parent_id FROM categories';
$result = Database::select($sql);

/**
*	getChild($id - index, $result - array, $count - counter) is "tree walking" function searching for categories and its
*	child categories in a recursive way 
*/
function getChild($id, $result, $count) {
	if($count > 0) {
		echo '<div class="collapse list-group-submenu" id="' . $id . '">' . PHP_EOL;
	}
	for( $i = 0; $i < sizeof($result); $i ++) {
		if( $result[$i][2] == $id) {

			echo '<a class="list-group-item catname-menu" href="#' . $result[$i][0] . '" data-toggle="collapse" data-parent="#menu">' . PHP_EOL;
			echo $result[$i][1] . PHP_EOL;
			echo '</a>' . PHP_EOL;
			getChild($result[$i][0], $result, $count + 1);
		}
	}
	if($count > 0) {
		echo '</div>' . PHP_EOL;
	}
}

getChild(0, $result, 0);

