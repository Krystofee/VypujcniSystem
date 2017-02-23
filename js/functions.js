
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
* 
*	function login()
*	function logout()
*
*	function component_category_add(element) : boolean;
*	function component_tag_add(element) : boolean;
*	function component_item_add(element) : boolean;
*	function component_item_list(element) : boolean;
*
*	+ document onload events
*	login
*	register
*/

/*
*	To do list:
*				- dokumentace !!!!!! login, logout +
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
			debug(out);
			return true;
		},
		error: function(xhr, ajaxOptions, thrownError){
			debug(xhr.status);
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
			debug(out);
		},
		error: function(xhr, ajaxOptions, thrownError){
			debug(xhr.status);
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
			html = String(html);
			debug('AJAX Login sent successful!');
			debug(html);
			if (html.indexOf('logged_in') !== -1) {
				$('#login-form-content').empty().html('<div class="alert alert-success"><strong>Úspěšné přihlášení</strong><br>Budete přesměrováni do uživatelského rozhraní</div>');
				debug('Byl jste přihlášen');
				window.location = 'main.php';
			} else {
				destroySession();
				$('#login-form-content').empty().html('<div class="alert alert-danger"><strong>Přihlášení nebylo úsppěšné</strong><br>Zkuste to prosím znovu, nebo si založte účet</div>');
			}
		},
		error: function(xht, ajaxOptions, thrownError) {
			debug(xhr.status);
		}
	});
};

/*
*
*/
function logout() {

	$.ajax({
		type: 'POST',
		url: 'logout_AJAX.php',
		success: function() {
			window.location = 'index.php';
		},
		error: function(xht, ajaxOptions, thrownError) {
			debug(xhr.status);
		}
	});
};

/*
*
*/
function component_item_list(element) {
	var component_item_list = $.get('component_item_list.php', function(data_item_list) {
		$(element).append(data_item_list);
		return true;
	});

	return false;
}

/*
*
*/
function component_item_add(element) {
	var component_item_add = $.get('component_item_add.php', function(data_item_add) {
		$(element).append(data_item_add);
		return true;
	});

	return false;
}

/*
*
*/
function component_category_add(element) {
	var component_category_add = $.get('component_category_add.php', function(data_category_add) {
		$(element).append(data_category_add);
		return true;
	});

	return false;
}

/*
*
*/
function component_tag_add(element) {
	var component_tag_add = $.get('component_tag_add.php', function(data_tag_add) {
		$(element).append(data_tag_add);
		return true;
	});

	return false;
}


// ---------------- On Load -------------------

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

		debug(postData);

		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: 'register_AJAX.php',
			data: {myData:postData},
			success: function(html) {
				debug(html);
				if (html[0] == '1') {
					alert('Uživatelské jméno již existuje!');
				}
				else if (html[0] == '2') {
					alert('Tento email je již registrován!')
				} 
				else if (html[0] == '0') {
					debug('registrace proběhla úspěšně');
					$('#register-form-content').empty().html('<div class="alert alert-success"><strong>Úspěšná registrace</strong><br>Nyní se můžete přihlásit v pravém sloupci</div>');
				}
			},
			error: function(xhr, ajaxOptions, thrownError){
				debug(xhr.status);
			},
		});
	} else {
		debug('password != password2.');
	}
});


$('[data-toggle="popover"]').popover(); 
