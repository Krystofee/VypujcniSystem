<?php
/*
*	Name: 		component_tag_add.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Component used to add a new tag
*/
?>

<div class="form-group panel">
	<div class="panel-heading container-fluid">
		<label for="tag-name"><h3>Název nového tagu :</h3> </label>
	</div>
	<div class="panel-content container-fluid">
		<input name="tag-name" id="tag-name" class="form-control" type="text" placeholder="Name"></input> <br>
	</div>
	<div class="panel-footer container-fluid">
		<button class="btn btn-primary" onclick="addTag($('#tag-name').val());">Přidat tag</button>
		<span id="tag-state">&nbsp;</span>
	</div>
</div>	


<script type="text/javascript">

/*
*	addTag(tagname) function used to add tag into the database - calls tag_add_AJAX.php
*/
function addTag(tagname) {
	if(tagname == '') {
		$('#tag-state').html('Vyplňte prosím všechna pole');
		return;		
	}

	postData = [{'tagname' : tagname}];

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'tag_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			debug('addTag() ajax request sent successfuly');
			debug(out);
			$('#tag-state').html('Tag '+tagname+' byl úspěšně vytvořen <br>'+out);	
		},
		error: function(xhr, ajaxOptions, thrownError){
			debug(xhr.status);
		},
	});
}

</script>