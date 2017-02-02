<?php
/*
*	Name: 		component_caegory_add.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Component used to add categories
*/
?>
<div class="form-group panel">
	<div class="panel-heading">
		<h2>
			Přidat novou kateorii:
		</h2>
	</div>
	<div class="panel-contentc col-md-12">

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
		<button class="btn btn-primary" onclick="addCategory($('#cat-name').val() , $('#par-id').val());">Přidat kategorii</button> <br>
		<span id="cat-state">&nbsp;</span>
	</div>
</div>
