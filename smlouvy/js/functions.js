
/*
*	Name: 		functions.js
*	Author: 	Krystofee
*	Created: 	2.1.2017
*	Desc: 		file containing all javascript background functions and event listeners
*
*	function get(elementID) : element;
*	function write(string) : boolean;
*	function alphanumeric(str) : boolean;
*	function allLetter(str) : boolean;
*	function destroySession() : AJAX;
*	function cookiesAccepted(val) : AJAX;
*	function addCategory(catname, parid) : AJAX;
*	function addTag(tagname) : AJAX;
*	function addItem(itemname, evc, desc, elimage, elprew, catid) : AJAX;	
*	function listItems(catname) : json_encoded;
*
*	+ document onload events
*	login
*	register
*/

/*
*	To do list:
*
*/



// ------------ Functions ----------------

/*
*	get(elementID) : element;
*/
function get(elementID) {
	return document.getElementById(elementID);
}

/*
*	write(string) to the document
*/
function write(string) {
	return document.write(string);
}

/*
*	alphanumeric(str) is used in input validation
*/
function alphanumeric(str) {   
	
	var letters = /^[0-9a-zA-Z]+$/;  

	if(str.match(letters)) {  
		return true;  
	}  
	else {  
		return false;  
	}  
}  

/*
*	allLetter(str) is used in input validation
*/
function allLetter(str) {   

	var letters = /^[A-Za-z]+$/;  

	if(ustr.match(letters)) {  
		return true;  
	}  
	else {   
		return false;  
	}  
}  

/*
*	destroySession() is used to erase everything from PHP session
*/
function destroySession() {
	postData = [{'destroy' : true}];

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'session_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			console.log(out);
			return true;
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
			return false;
		},
	});
}

/*
*	cookiesAccepted(val) is used to tell the session that cookies are accepted
*/
function cookiesAccepted(val) {
	postData = [{'name' : 'cookies_accepted', 'status': true}];

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'session_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			console.log(out);
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});
}

/*
*
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
			console.log('addCategory() ajax request sent successfuly');
			console.log(out);
			$('#cat-state').html('Kategorie '+catname+' byla úspěšně vytvořena <br>'+out);	
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});
}

/*
*
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
			console.log('addTag() ajax request sent successfuly');
			console.log(out);
			$('#tag-state').html('Tag '+tagname+' byl úspěšně vytvořen <br>'+out);	
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});
}

/*
*
*/
function addItem(itemname, evc, desc, elimage, elprew, catid) {
	console.log(desc);

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

	/*
	postData = {
		'itemname' : itemname, 
		'evc' : evc, 
		'desc' : desc, 
		'image' : elimage[0].files[0], 
		'prewiev' : elprew[0].files[0],
		'catid' : catid
	};

	postData = JSON.stringify(postData);
	*/

	$.ajax({
		method: 'POST',
		url: 'item_add_AJAX.php',
		data: formdata,
		dataType: 'text',  
		cache: false,
		contentType: false,
		processData: false,  
		success: function(out) {
			console.log('addItem() ajax request sent successfuly');
			console.log(out);
			$('#item-state').html('Item '+itemname+' byl úspěšně vytvořen <br>'+out);	
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});
}

/*
*
*/
function login(username, password) {
	var postData = {
		'username' : username,
		'password' : password
	};

	postData = JSON.stringify(postData);

	$.ajax({
		type: 'POST',
		datatype: 'json',
		url: 'login_AJAX.php',
		data: {myData:postData},
		success: function(html) {
			console.log('AJAX Login sent successful!');
			console.log(html);
			if (html.includes('logged_in')) {
				$('#login-form-content').empty().html('<div class="alert alert-success"><strong>Úspěšné přihlášení</strong><br>Budete přesměrováni do uživatelského rozhraní</div>');
				console.log('Byl jste přihlášen');
				window.location = 'main.php';
			} else {
				destroySession();
				$('#login-form-content').empty().html('<div class="alert alert-danger"><strong>Přihlášení nebylo úsppěšné</strong><br>Zkuste to prosím znovu, nebo si založte účet</div>');
			}
		},
		error: function(xht, ajaxOptions, thrownError) {
			console.log(xhr.status);
		}
	});
};

/*
*
*/
function listItems(catname) {
	var postData = {
		'catname' : catname
	};

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'item_list_AJAX.php',
		data: {myData:postData},
		success: function(out) {
			console.log('listItems() ajax request sent successfuly');
			console.log(out);
			$('#items-panel')
				.html('')
				.append('out');

		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});
}

// --------------- On Load -------------------

$('#submit-register').on('click', function() {
	var username = $('#register-username').val().toLowerCase();
	var password = $('#register-password').val();
	var password2 = $('#register-password2').val();
	var email = $('#register-email').val().toLowerCase();
	var den = $('#day').val();
	var mesic = $('#month').val();
	var rok = $('#year').val();


	// needs to be improved!!

	if (username == '') {
		alert('Prázdné pole username');
		return false;
	}

	else if (email == '') {
		alert('Prázdné pole email.');
		return false;
	}

	else if (!(email.includes('@') && email.includes('.'))) {
		alert('Neplatná emailová adresa')
	}

	else if (password == '') {
		alert('Prázdné pole password');
		return false;
	}

	else if (password2 == '') {
		alert('Prázdné pole password check');
		return false;
	}

	else if (den == null) {
		alert('Prázdné pole den.');
		return false;
	}

	else if (mesic == null) {
		alert('Prázdné pole mesic.');
		return false;
	}

	else if (rok == null) {
		alert('Prázdné pole rok.');
		return false;
	}


	else if (password == password2) {
		var postData = {
			"username" : username,
			"password" : password,
			"email" : email,
			"day" : den,
			"month" : mesic,
			"year" : rok
		}

		postData = JSON.stringify(postData);

		console.log(postData);

		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: 'register_AJAX.php',
			data: {myData:postData},
			success: function(html) {
				console.log(html);
				if (html[0] == '1') {
					alert('Uživatelské jméno již existuje!');
				}
				else if (html[0] == '2') {
					alert('Tento email je již registrován!')
				} 
				else if (html[0] == '0') {
					console.log('registrace proběhla úspěšně');
					$('#register-form-content').empty().html('<div class="alert alert-success"><strong>Úspěšná registrace</strong><br>Nyní se můžete přihlásit v pravém sloupci</div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				console.log(xhr.status);
			},
		});
	} else {
		console.log('password != password2.');
	}
});


$('[data-toggle="popover"]').popover(); 
