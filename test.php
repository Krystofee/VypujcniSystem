<?php

require_once 'component_item_cart_functions.php';
require_once 'session.php';

echo countItemsInCart();
echo '<br>';
echo json_encode(getItemsInCart());
echo '<br>';
echo '<br>';

//addToCart(2);
//addToCart(24);


echo countItemsInCart();
echo '<br>';
echo json_encode(getItemsInCart());
echo '<br>';
echo '<br>';
//echo isInCart(2);
//echo '<br>';
echo '<br>';



for($i = 0; $i < 100; $i ++) {
	if(isInCart($i)) {
		echo($i . ', ');	
	}
}


echo '<br>';
echo '<br>';removeItemFromCart(9);
echo '<br>';
echo json_encode(getItemsInCart());

