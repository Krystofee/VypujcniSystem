<?php
/*
*	Name: 		footer.php
*	Author: 	Krystofee
*	Created: 	25.1.2017
*	Desc: 		Footer od every HTML document
*/
?>

<div class="col-md-12 text-right">
	<h5>
		<small>
			<?php 

			/*
			*	Get project name from database
			*/

			require_once 'projectinfo.php';

			echo ProjectInfo::getInfo('author');

			?>
			&copy; 
			<?php 

			echo date("Y")

			?>
			<?php 

			/*
			*	Get project name from database
			*/

			require_once 'projectinfo.php';

			echo 'verze ';
			echo ProjectInfo::getInfo('version');

			?>
		</small>
	</h5>
</div>
</body>
</html>