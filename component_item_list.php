<?php
/*
*	Name: 		component_item_list.php
*	Author: 	Krystofee
*	Created: 	2.2.2017
*	Desc: 		Component used to display items in category. Works with component_category_list.
*/
?>
<div id="item-list" class="panel">
	<div class="panel-heading" id="items-panel-catname">
		<h3>
			<span id="items-panel-catname-zvolena">Vyberte kategorii pro zobrazení položek </span>
			<span id="items-panel-catname-span"></span>
		</h3>
	</div>
	<div class="panel-content container-fluid" id="items-panel-content">

		<!-- Template for item -->
		<!-- ITEM -->
			<!-- 
			<div class="item col-md-4">
				<div class="panel panel-item">
					<div class="panel-heading">
						<h4>Cannon <br>
							<small>12359-ABCUX-598</small>
						</h4>
					</div>
					<div class="panel-content">
						<img src="uploads/items/test/preview.jpg" class="item-preview">
						<p>
							Fotoaparát s 5MPX a schoppností autozoomu, která z něj dělá nejlepší fotoaparát na trhu.
						</p>
					</div>
					<div class="panel-footer">
						<button class="btn btn-default">
							<span class="avaiable text-success">
								<b>+</b> 
								&nbsp; Přidat do košíku
							</span>
						</button>
					</div>
				</div>
			</div>
		-->
		<!-- / ITEM -->

	</div>
</div>



<script type="text/javascript">

	/*
	*	Display fullscreen fixed div with image in it
	*/
	function showImage(img) {
		debug(img);
		source = $(img).attr('src');
		source = source.replace('preview', 'image');
		$('body').append('<div class="fullscreen-fixed" id="fullscreen-fixed" onclick="$(this).fadeOut(function() {$(this).remove()})" hidden>Pro zavření, klikni.<img src="'+source+'"></div>');
		
		$('#fullscreen-fixed').fadeIn();
	}

	/*
	*	- listItems(catname) gets with AJAX JSON list of items, which it sends into
	*	  the #items-panel-content element
	*/
	function listItems(catname) {
		catname = catname.toString();
		catname = catname.trim();

		var postData = {
			'catname' : catname
		};
		
		$('#items-panel-catname-zvolena').html('Zvolená kategorie: ');
		$('#items-panel-catname-span').html(catname);

		postData = JSON.stringify(postData);

		debug(postData);

		$.ajax({
			method: 'POST',
			datatype: 'json',
			url: 'item_list_AJAX.php',
			data: {myData:postData},
			success: function(o_json) {
				debug('listItems() ajax request sent successfuly');
				debug('item list JSON: '+o_json);

				var o_html = jsonToHtml(o_json); 

				$('#items-panel-content')
				.html('')
				.append(o_html);
			},
			error: function(xhr, ajaxOptions, thrownError){
				debug(xhr.status);
			},
		});
	}

	/**
	*	refreshItems() is function called after every change of cart
	*/
	function refreshItems() {
		var element = $('#items-panel-catname-span');
		listItems($(element).text());
	}

	/*
	*	jsonToHtml(i_json) is used to parse json data from list items into list of items html
	*/
	function jsonToHtml(i_json) {

		var parsed = JSON.parse(i_json);
		/*
		*	parse = [item][value (0 - 5)];
		*   ----------------
		*	0 - id
		*	1 - name
		*	2 - description
		*	3 - evc
		*	4 - tags_id
		*	5 - ordered
		*	----------------
		*/

		var o_html = '';

		for(var i = 0; i < parsed.length; i ++) {
			o_html += '<div class="item col-md-4"><div class="panel panel-item"><div class="panel-heading"><h4>';
			o_html += parsed[i][1];
			o_html += '<br><small>';
			o_html += parsed[i][3];
			o_html += '</small></h4></div><div class="panel-content"><img src="uploads/items/';
			o_html += parsed[i][1]+'-'+parsed[i][3]+'/preview.jpg" class="item-preview" onclick="showImage($(this))"><p>';
			o_html += parsed[i][2];
			o_html += '</p></div><div class="panel-footer"><button class="btn btn-default button-add" id="but-'+parsed[i][0]+'"><span class="avaiable text-success"><b>+</b> &nbsp; Přidat do košíku</span></button></div></div></div>';
		}

		return o_html;
	}

	/**
	*	addToCart(itemid) is function called by clicking on item button, which calls item_cart_AJAX file and adds 
	*	itemid into the database
	*/
	function addToCart(itemid) {

		itemid = itemid.slice(4);
		debug('sliced item id - '+itemid);

		postData = {'addToCart' : itemid};

		postData = JSON.stringify(postData);

		$.ajax({
			method: 'POST',
			datatype: 'json',
			url: 'item_cart_AJAX.php',
			data: {myData:postData},
			success: function(out) {
				debug(out);

				var _but = $('#but-'+itemid).closest('.item');
				$(_but).fadeOut(/*function() {$(_but).remove();}*/);
			},
			error: function(xhr, ajaxOptions, thrownError){
				debug(xhr.status);
			},
		});
	}


	$(document).ready(function() {

		$(document).on('click', '.catname-menu', function() {

			// check if panel exists, if not, abort function.
			if(!$('#items-panel-content')) {
				return;
			}

			// paste items in JSON into the #items-panel-content
			listItems($(this)[0].innerText);
		});

		$(document).on('click', '.button-add', function() { 
			addToCart($(this).attr('id'));
			refreshCart();
		});

	});

</script>

<style type="text/css">
	.item {
		position: relative;
		padding: 0 !important;
	}

	.item .panel {
		border-left: none;
		border-right: none;
	}

	.panel-item > .panel-heading {
		background-image: -webkit-linear-gradient(top, #f5f5f5 0%, #e8e8e8 100%);
		background-image:      -o-linear-gradient(top, #f5f5f5 0%, #e8e8e8 100%);
		background-image: -webkit-gradient(linear, left top, left bottom, from(#f5f5f5), to(#e8e8e8));
		background-image:         linear-gradient(to bottom, #f5f5f5 0%, #e8e8e8 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5', endColorstr='#ffe8e8e8', GradientType=0);
		background-repeat: repeat-x;
	}

	.panel-item > .panel-content {
		padding: 15px;
	}

	.panel-item > .panel-content .item-preview {
		margin-left: 10%;
		padding-bottom: 10%;
		width: 80%;
		height: auto;
	}

	.panel-item > .panel-footer {
		
	}

	#fullscreen-fixed {
		position: fixed;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;

		background-color: rgba(0, 0, 0, 0.75);
	}
</style>
