<?php
/*
*	Name: 		header.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Header od every HTML document
*/


require 'session.php';
require "cookies.php";

?>


<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>
		<?php 

		require_once 'database.php';

		Database::connect();

		$sql = 'SELECT value FROM metadata WHERE name LIKE "project_name"';
		$result = Database::select($sql);

		echo $result[0][0];

		?>
	</title>

	<!-- Background stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="font/dosis/stylesheet.css">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<!-- Bootstrap -->
	<link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

	<!-- Main stalysheet -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<script src="js/debug.js"></script>
	<!-- core scripts -->
	<script src="js/jquery.js"></script>
	<!--<script src="js/jquery.min.js"></script>-->
	<script src="js/bootstrap/js/bootstrap.min.js"></script>
	<!-- Main javascript file -->
	<script src="js/functions.js"></script>

	
</head>


<body>