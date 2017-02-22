<?php
/*
*	Name: 		component_item_cart.php
*	Author: 	Krystofee
*	Created: 	20.2.2017
*	Desc: 		Items cart used to display dropdown cart button in the navbar, containing its functions and styles
*/

?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	Váš košík: 
	<span id="cart-item-count"></span>
	<span class="caret"></span>
</a>
<div class="dropdown-menu container-fluid">
	<div class="panel margin-bottom-none">
		<div class="panel-heading"><h4>Obsah košíku</h4></div>
		<div class="panel-content text-nowrap">
			<ul class="list-unstyled" id="cart-item-list">

					<!-- TEMPLATE
					<li class="btn-default container-fluid" id="cart-id">
						<h5>
							<a class="text-danger underline-none remove-from-cart" onclick="removeItemFromCart($(this).closest('li').attr('id').replace('cart-',''));">
								<span class="glyphicon glyphicon-trash"></span>
							</a>
							<span class="margin-side-5">Cannon</span>
							<small class="margin-side-2">(KBX-00001)</small>
						</h5>
					</li>-->

				</ul>
			</div>
			<div class="panel-footer"> 
				<button class="btn btn-danger" onclick="emptyCart();">Vyprázdnit košík</button>
			</div>
		</div>
	<!--
	<li><a href="#"></a></li>
	<li><a href="#">Item 2</a></li>
	<li><a href="#">Item 3</a></li>-->
</div>

<script type="text/javascript">

	$(document).ready(function() {
		refreshCart();
	
		// function used to stop onclick close of cart dropdown
		$('.dropdown-menu div').click(function(e) {
			e.stopPropagation();
		});
	})

</script>


<script type="text/javascript">

	/**
	*	getItem(itemid) is used to get only one item specified by itemid - calls item_list_AJAX
	*/
	function getItem(itemid) {
		var result = '';
		
		postData = {'itemid' : itemid};

		postData = JSON.stringify(postData);

		$.ajax({
			method: 'POST',
			url: 'item_list_AJAX.php',
			datatype: 'json',
			data: {myData:postData},
			async: false,
			success: function(data) {
				result = JSON.parse(data);
			}
		});

		return result;
	}

	/**
	*	refreshCart() is called after every change of cart to refresh the list of items in cart
	*	calls item_cart_AJAX
	*/
	function refreshCart() {
		postData = {'getItemsInCart' : true};

		postData = JSON.stringify(postData);

		$.ajax({
			method: 'POST',
			datatype: 'json',
			url: 'item_cart_AJAX.php',
			data: {myData:postData},
			success: function(output) {
				output = JSON.parse(output);

				debug('Počet itemů v košíku: '+output.length);
				$('#cart').find('#cart-item-count').html(output.length);

				var append = '';
				var item = [[]];

				for(var i = 0; i < output.length; i ++) {
					item = getItem(output[i]);

					append += '<li class="btn-default container-fluid" id="';
					append += 'cart-'+output[i];
					append += '"><h5><a class="text-danger underline-none remove-from-cart" onclick="removeItemFromCart('
					append += "$(this).closest('li').attr('id').replace('cart-',''));";
					append += '"><span class="glyphicon glyphicon-trash"></span></a><span class="margin-side-5">';
					append += item[0][0];
					append += '</span><small class="margin-side-2">'
					append += item[0][1];
					append += '</small></h5></li>'
				}
				
				$('#cart-item-list').html(append);
			},
			error: function(xhr, ajaxOptions, thrownError){
				debug(xhr.status);
			},
		});
	}

	/**
	*	emptyCart() is used to empty whole cart, it calls item_cart_AJAX
	*/	
	function emptyCart() {
		postData = {'emptyCart' : true};

		postData = JSON.stringify(postData);

		$.ajax({
			method: 'POST',
			datatype: 'json',
			url: 'item_cart_AJAX.php',
			data: {myData:postData},
			success: function(output) {
				debug('Cart is empty');
				refreshCart();
				refreshItems();
			},
			error: function(xhr, ajaxOptions, thrownError){
				debug(xhr.status);
			},
		});
	}

	/**
	*	removeItemFromCart(itemid) deletes item from the cart specified by itemid
	*/
	function removeItemFromCart(itemid) {
		postData = {'removeItemFromCart' : itemid};

		postData = JSON.stringify(postData);

		$.ajax({
			method: 'POST',
			datatype: 'json',
			url: 'item_cart_AJAX.php',
			data: {myData:postData},
			success: function(output) {
				debug('Item '+itemid+' was removed from the cart');
				debug(output);
				refreshCart();

				var _but = $('#but-'+itemid).closest('.item');
				$(_but).fadeIn();
				if($(_but).length == 0) {
					refreshItems();
				}

				$('#cart-'+itemid).fadeOut(function() {$(this).remove()});
			},
			error: function(xhr, ajaxOptions, thrownError){
				debug(xhr.status);
			},
		});
	}

</script>

<style type="text/css">
	/*
	*	Specific component styles
	*/

	.margin-bottom-none {
		margin-bottom: 0;
	}

	.margin-side-2 {
		margin: 0 2px;
	}

	.margin-side-5 {
		margin: 0 5px;
	}

	.underline-none {
		text-decoration: none;
	}
	.underline-none:hover {
		text-decoration: none;
	}

</style>