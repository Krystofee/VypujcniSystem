<?php
/*
*	Name: 		component_item_add.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Component used to display form with adding item options
*/
?>

<div class="form-group panel">
	<div class="panel-heading container-fluid">
		<h3>Přidat novou položku : </h3>
	</div>

	<div class="panel-content container-fluid">
		<label for="item-name">Název nové položky : </label>
		<input name="item-name" id="item-name" class="form-control" type="text" placeholder="Name"></input> <br>

		<label for="item-evc">Evidenční číslo : </label>
		<input name="item-evc" id="item-evc" class="form-control" type="text" placeholder="Evidenční číslo"></input> <br>

		<label for="item-desc">Popis předmětu : </label>
		<textarea name="item-desc" id="item-desc" class="form-control" type="text" placeholder="Zadejte popis"></textarea> <br>

		<label class="btn btn-default btn-file" id="label-image">
			<b>Vložte obrázek položky s příponou .jpg 
				<input id="item-img" type="file" style="display: none;" accept=".jpg">
				: 
			</b>&nbsp; 
			<span id="item-img-name">
			</span>
		</label> <br> <br>

		<label class="btn btn-default btn-file" id="label-prew">
			<b>Vložte náhled položky s příponou .jpg (128px * 128px)
				<input id="item-prew" type="file" style="display: none;" accept=".jpg">
				: 
			</b>&nbsp; 
			<span id="item-prew-name"></span>
		</label> <br> <br>

		<label for="cat-id">Vyberte kategorii : </label>
		<select name="cat-id" id="cat-id" class="form-control">
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
		</select>
		<br>
	</div>
	<div class="panel-footer container-fluid">

		<button class="btn btn-primary" onclick="addItem($('#item-name').val(), $('#item-evc').val(), $('#item-desc').val(), $('#item-img'), $('#item-prew'), $('#cat-id').val());">Přidat položku</button>

		<span id="item-state">&nbsp;</span> <br>

	</div>
	<script src="js/component_item_add.js"></script>
</div>	


<script type="text/javascript">

/*
*
*/
function addItem(itemname, evc, desc, elimage, elprew, catid) {
	debug(desc);

	if(itemname == '' || evc == '') {
		$('#item-state').html('Vyplňte prosím všechna pole');
		return;		
	} else {
		$('#item-state').html('');
	}

	if(!elimage[0].files[0]) {
		$('#item-state').html('Vložte prosím obrázek produktu');
		return;
	}

	if(!elprew[0].files[0]) {
		$('#item-state').html('Vložte prosím náhled produktu');
		return;
	}

	var formdata = new FormData();
	formdata.append('image', elimage[0].files[0]);
	formdata.append('preview', elprew[0].files[0]);
	formdata.append('itemname', itemname);
	formdata.append('evc', evc);
	formdata.append('desc', desc);
	formdata.append('catid', catid);

	$.ajax({
		method: 'POST',
		url: 'item_add_AJAX.php',
		data: formdata,
		dataType: 'text',  
		cache: false,
		contentType: false,
		processData: false,  
		success: function(out) {
			debug('addItem() ajax request sent successfuly');
			debug(out);
			$('#item-state').html('Item '+itemname+' byl úspěšně vytvořen <br>'+out);	
		},
		error: function(xhr, ajaxOptions, thrownError){
			debug(xhr.status);
		},
	});
}
</script>
