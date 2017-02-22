<?php
/*
*	Name: 		projectinfo.php
*	Author: 	Krystofee
*	Created: 	22.2.2017
*	Desc: 		
*/

class ProjectInfo {

	/**
	*	get info from $var as column name from table metadata in database
	*/
	public static function getInfo($var) {
		require_once 'database.php';

		Database::connect();

		$sql = 'SELECT value FROM metadata WHERE name LIKE "' . $var . '"';
		$result = Database::select($sql);

		Database::close();

		return $result[0][0];
	}	
}
