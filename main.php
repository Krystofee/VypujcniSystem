<?php
/*
*	Name: 		main.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		the main document with the wallet handling user interface
*				The concept is to have everything on that document and make it as 
*				variable as possible
*/

require 'session.php';
require_once 'header.php'
?>

<?php if(!isset($_SESSION['user'])): ?>

	<script type="text/javascript">

		window.location = "index.php";

	</script>

<?php else: ?>

	<nav class="navbar navbar-default navbar-static-top" id="slide-nav">
		<div class="container-fluid">

			<div class="navbar-header">
				<a href="" class="navbar-brand">
					<?php 

					require_once 'database.php';

					Database::connect();

					$sql = 'SELECT value FROM metadata WHERE name LIKE "project_name"';
					$result = Database::select($sql);

					echo $result[0][0];

					?>
				</a>
			</div>

			<!-- LEFT -->
			<ul class="nav navbar-nav navbar-left">
				<li>
					<a href="#">---</a>
				</li>
			</ul>

			<!-- RIGHT -->
			<p class="navbar-text navbar-right">&nbsp;</p>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav navbar-text">
					Přihlášen jako:
					<?php
					if (isset($_SESSION['user']['username'])) {
						echo $_SESSION['user']['username'];
					}
					?>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Můj účet <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Profil</a></li>
						<li><a href="#">Správce peněženek</a></li>
						<li><a href="#">Další akce</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Odhlásit se</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="list-group panel" id="menu">
					<div class="panel-heading">
						<h3>Seznam Kategorií :</h3>
					</div>	
					<div class="panel-content">
						<?php
						require 'component_category_menu.php';
						?>
					</div>
				</div>
			</div>


			<div class="col-md-8 panel" id="content">
				<?php
				/*
				* 	Used for testing components
				*
				require 'component_category_add.php';
				require 'component_tag_add.php'
				require 'component_item_add.php';
				*/
				
				require 'component_item_list.php'

				?>
			</div>
		</div>	
	</div>

	<?php
	require_once 'footer.php';
	?>

<? endif; ?>