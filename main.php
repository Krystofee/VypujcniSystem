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

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">
					<?php 

					/*
					*	Get project name from database
					*/
					
					require_once 'projectinfo.php';

					echo ProjectInfo::getInfo('project_name');

					?>
				</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="#">---</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="navbar-text">
						Přihlášen jako:
						<?php
						if (isset($_SESSION['user']['username'])) {
							echo $_SESSION['user']['username'];
						}
						
						?>
					</li>
					<li class="dropdown" id="cart">
						<?php 
						
						require 'component_item_cart_js.php';

						?>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Můj účet <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Profil</a></li>
							<li><a href="#">Správce peněženek</a></li>
							<li><a href="#">Další akce</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#" onclick="logout();">Odhlásit se</a></li>
						</ul>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
	</nav>

	<div class="container-fluid">
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


		<div class="col-md-8 container-fluid " id="content">
			<script type="text/javascript">

				//component_category_add($('#content'));
				//component_tag_add($('#content'));
				//component_item_add($('#content'));
				component_item_list($('#content'));

			</script>
		</div>
	</div>

	<?php
	require_once 'footer.php';
	?>

<? endif; ?>