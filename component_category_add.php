<?php
/*
*	Name: 		component_caegory_add.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Component used to add categories
*/
?>
<div class="form-group panel">
	<div class="panel-heading container-fluid">
		<h3>
			Přidat novou kateorii:
		</h3>
	</div>
	<div class="panel-content container-fluid">

		<label for="cat-name">Název nové kategorie : </label>
		<input name="cat-name" id="cat-name" class="form-control" type="text" placeholder="Name"></input> <br>
		<label for="par-id">Parentální kategorie : </label>
		<select id="par-id" class="form-control">
			<option value="0">Žádná</option>
			<?php

			require_once 'database.php';

			Database::connect();

			$sql = 'SELECT id, name FROM categories ORDER BY parent_id';
			$result = Database::select($sql);

			if(!sizeof($result)) {
				die("Neexistuje zatím žádná kategorie v databázi.");
			}

			for( $i = 0; $i < sizeof($result); $i ++) {
				echo '<option value="' . $result[$i][0] . '">';
				echo $result[$i][1];
				echo '</option>' . PHP_EOL;
			}

			?>
		</select> <br>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary" onclick="addCategory($('#cat-name').val() , $('#par-id').val());">Přidat kategorii</button>
		<span id="cat-state">&nbsp;</span>
	</div>
</div>


<script type="text/javascript">


/**
*	addCategory(catname, parid) is function used to add category, with its name and parental id (0 for nothing)
*/
function addCategory(catname, parid) {
	if(catname == '') {
		$('#cat-state').html('Vyplňte prosím všechna pole');
		return;
	}

	postData = [{'catname' : catname, 'parid' : parid}];

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'category_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			debug('addCategory() ajax request sent successfuly');
			debug(out);
			$('#cat-state').html('Kategorie '+catname+' byla úspěšně vytvořena <br>'+out);	
		},
		error: function(xhr, ajaxOptions, thrownError){
			debug(xhr.status);
		},
	});
}

</script>