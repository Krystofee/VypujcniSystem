<?php
/*
*	Name: 		component_tag_add.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Component used to add a new tag
*/
?>

<div class="form-group">
	<label for="tag-name">Název nového tagu : </label>
	<input name="tag-name" id="tag-name" class="form-control" type="text" placeholder="Name"></input> <br>
	<button class="btn btn-primary" onclick="addTag($('#tag-name').val());">Přidat tag</button> <br>
	<span id="tag-state">&nbsp;</span>
</div>	