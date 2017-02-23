<?php
/*
*	Name: 		component_item_cart_functions.php
*	Author: 	Krystofee
*	Created: 	20.2.2017
*	Desc: 		
*/

require 'session.php';

/**
*	createCart() function that creates an empty array ised to store list of items in the cart
*	if that list does not exist before
*/
function createCart() {
	if(!isset($_SESSION['cart'])) {		
		$_SESSION['cart'] = array('items' => array());
	}

	if(!isset($_SESSION['cart']['items'])) {
		$_SESSION['cart']['items'] = array();
	}
}

/**
*	addToCart($itemid) is used to cart, push in to the array
*/	
function addToCart($itemid) {
	createCart();

	array_push($_SESSION['cart']['items'], $itemid);
}

/**
*	getItemsInCart() is used to return whole array of item id's in array
*/
function getItemsInCart() {
	createCart();

	return json_encode($_SESSION['cart']['items']);
}

/**
*	isInCart($itemid) searches for specified itemid in array
*/
function isInCart($itemid) {
	createCart();

	for($i = 0; $i < sizeof($_SESSION['cart']['items']); $i ++) {
		if(isset($_SESSION['cart']['items'][$i])) {
			if($itemid == $_SESSION['cart']['items'][$i]) {
				return true;
			}
		}
	}
	
	return false;
}

/**
*	countItemsInCart() counts items in cart
*/
function countItemsInCart() {
	createCart();

	return count($_SESSION['cart']['items']);
}

/**
*	emptyCart() drops whole cart and makes new
*/
function emptyCart() {
	unset($_SESSION['cart']['items']);
	$_SESSION['cart']['items'] = array();
}

/**
*	removeItemFromCart($itemid) removes specified itemid from the cart array
*/
function removeItemFromCart($itemid) {
	createCart();

	$items = array();
	$j = 0;

	for($i = 0; $i < sizeof($_SESSION['cart']['items']); $i ++) {
		if($_SESSION['cart']['items'][$i] != $itemid) {
			$items[$j] = $_SESSION['cart']['items'][$i];
			$j ++;
		}
	}

	emptyCart();
	$_SESSION['cart']['items'] = $items;
}
