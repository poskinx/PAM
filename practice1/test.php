<!DOCTYPE html>
<html>
	<body>

	<p>
	 
	<?php 	
		include 'database.php';
				
		$conn = connect ();

		check_user ($conn, 'Pepito', '12345');	
		
		disconnect($conn); 				
	?> 
	</p>
	</body>
</html> 