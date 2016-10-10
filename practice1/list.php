<!DOCTYPE html>
<html>
	<body>

	<p>
	<h2> List of users </h2>
	<?php 	
		include 'database.php';
				
		$conn = connect ();

		list_users ($conn);	
		
		disconnect($conn); 				
	?> 
	</p>
	</body>
</html> 
