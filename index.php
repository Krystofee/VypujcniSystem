<?php
/*
*	Name: 		index.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		login screen of the aplication with login a and register forms
*/

require 'session.php';
require_once 'header.php'

?>

<?php if (!isset($_SESSION['cookies_accepted'])): ?>
	<script type="text/javascript">
		$(window).load(function() {
			$('#cookie_alert').modal('show');
		});
	</script>

	<div class="modal fade" id="cookie_alert" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Varování na cookies!</h4>
				</div>
				<div class="modal-body">
					<p>Používáním této stránky akceptujete ukládání cookies v prohlížeči.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="cookiesAccepted(true);">Zavřít</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>


<div class="container text-center">
	<div class="row">
		<div class="col-md-12 center-block text-center">
			<h1 class="page-header bigger">
				<?php 

				require_once 'database.php';

				Database::connect();

				$sql = 'SELECT value FROM metadata WHERE name LIKE "project_name"';
				$result = Database::select($sql);

				echo $result[0][0];

				Database::close();

				?>
			</h1>
			<br>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center font-size-20">
					Informační tabule
				</div>
				<div class="panel-content" id="register-form-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12" style="word-break: keep-all;">
								<br>
								<?php 

								require_once 'database.php';

								Database::connect();

								$sql = 'SELECT value FROM metadata WHERE name LIKE "description"';
								$result = Database::select($sql);

								echo $result[0][0];

								Database::close();

								?>
								<br>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center font-size-20">
					Přihlaste se
				</div>
				<div class="panel-content" id="login-form-content">
					<div class="form-group text-center">
						<table class="display-inline-block space">
							<tr><td><input id="login-username" class="form-control" type="text" name="username" placeholder="Username or email"></td></tr>
							<tr><td><input id="login-password" class="form-control" type="password" name="password" placeholder="Password"></td></tr>
							<tr><td><button class="form-control btn btn-success" id="submit-login" onclick="login($('#login-username').val(), $('#login-password').val());">Přihlásit se</button></td></tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Aktuality:</h3>
		</div>
		<div class="panel-content">
			<ul class="list-group text-left">
				<br>
				<?php

				require_once 'database.php';

				Database::connect();

				$sql = 'SELECT time, description FROM aktuality';

				$result = Database::select($sql);

				Database::close();

				for( $i = 0; $i < sizeof($result); $i++) { 
					echo '<li class="list-group-item borderless"> <b>';
					echo (string) $result[$i][0];
					echo '</b> - ';
					echo (string) $result[$i][1];
					echo '</li>';
				}

				?>
			</ul>
		</div>
	</div>
</div>

<?php
require_once 'footer.php';
?>