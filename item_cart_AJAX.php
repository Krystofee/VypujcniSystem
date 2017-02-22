<?php
/*
*	Name: 		item_cart_AJAX.php
*	Author: 	Krystofee
*	Created: 	20.2.2017
*	Desc: 		Cart ajax file called by every component_item_cart javascript function used to call 
				more php functions and return data
*/

require 'session.php';
require_once 'database.php';
require_once 'component_item_cart_functions.php';

Database::connect();

// get data from POST method
$json_encoded = $_POST['myData'];
$data = json_decode($json_encoded);

// Add to cart
if(isset($data->addToCart)) {
	addToCart($data->addToCart);
}

// Count items in cart
if(isset($data->countItemsInCart)) {
	die(strval(countItemsInCart()));
}

// Get whole cart
if(isset($data->getItemsInCart)) {
	die(getItemsInCart());
}

// Empty cart
if(isset($data->emptyCart)) {
	emptyCart();
}

// Remove one specific item from cart
if(isset($data->removeItemFromCart)) {
	removeItemFromCart($data->removeItemFromCart);
}