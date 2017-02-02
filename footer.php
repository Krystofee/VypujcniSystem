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

			require_once 'database.php';

			Database::connect();

			$sql = 'SELECT value FROM metadata WHERE name LIKE "author"';
			$result = Database::select($sql);

			echo $result[0][0];

			Database::close();

			?>
			&copy; 
			<?php 

			echo date("Y")

			?>
			<?php 

			require_once 'database.php';

			Database::connect();

			$sql = 'SELECT value FROM metadata WHERE name LIKE "version"';
			$result = Database::select($sql);

			echo "verze " . $result[0][0];

			Database::close();

			?>
		</small>
	</h5>
</div>
</body>
</html>