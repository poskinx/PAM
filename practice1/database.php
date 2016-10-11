<?php 
	// Define Database parameters
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbName = "newdb";
    $realname = "";
				
	// Connect to the database	
	function connect ()
	{		 
		global $servername, $username, $password, $dbName;
		
		$conn = mysqli_connect($servername, $username, $password, $dbName);
		// Check connection
		
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		return $conn;
	}
	
	// Disconnect database
	function disconnect ($conn)
	{
		mysqli_close($conn); 
	}

//%%%%%%%%%%%  CHECK USER  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // Check user and welcome him
    function check_user ($conn, $user, $password)
	{
		$sql = "SELECT * FROM `users` where username = '". $user . "' and password = '". $password . "'" ;
		
		$result = mysqli_query($conn, $sql);			

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "Welcome " . $user ;								
			}
		} 		
		else 
        {
			echo "0 results";
		}			
	}

//%%%%%%%%%%%  LIST USERS  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    // Display all users in the list
    function list_users ($conn)
	{
	$sql = "SELECT username from `users`";
	
	$result = mysqli_query($conn, $sql);

	
	if (mysqli_num_rows($result) > 0) {
        // output data of username row
        while($row = $result->fetch_assoc()) {
            echo  $row["username"]. "<br>";
        }
        echo "<br>";
        go_back();
    }
		else 
        {
			echo "0 results";
		}			
	}

//%%%%%%%%%%%  ADD USERS  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    function add_user ($conn)
    {	$username1 = $_POST["username"];
		$password1 = $_POST["password"];
		$realname1 = $_POST["realname"];
        $sql = "INSERT INTO users (username,password,realname)
                VALUES ('$username1','$password1','$realname1')";

       if (mysqli_query($conn, $sql)) {
           echo "<p>Signed up successfully!</p>";
           go_back();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

//%%%%%%%%%%%  DELETE USERS  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	function delete_user ($conn)
	{	$password1 = $_POST["password"];
        $username1 = $_POST["username"];

        //Get the row (username,password & realname) related to the input username
        $sql = "SELECT password FROM users WHERE username='$username1'";
        $result = $conn->query($sql); $row = $result->fetch_assoc();

        //If the password introduced is equal to the one related to the input username, we delete the user
        if ($row["password"] == $password1){
            $sql = "DELETE FROM users WHERE password='$password1'";
            if ($conn->query($sql) === TRUE) {
                echo "<p> User deleted successfully! </p>";
                //echo "<a href = 'index.html'> Go back </a>";
                go_back();
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {echo "Wrong user or password!";}//Else we dont delete the user
	}

//%%%%%%%%%%%  MODIFY USERS  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    function modify_user ($conn)
    {	$password1 = $_POST["password"];
        $username1 = $_POST["username"];
		$new_password = $_POST["new_password"];
		$new_username = $_POST["new_username"];
		$new_realname = $_POST["new_realname"];

        //Get the row (username,password & realname) related to the input username
        $sql = "SELECT password FROM users WHERE username='$username1'";
        $result = $conn->query($sql); $row = $result->fetch_assoc();

        //If the password introduced is equal to the one related to the input username, we apply the changes
        if ($row["password"] == $password1){
            $sql = "UPDATE users SET username='$new_username',password='$new_password',realname='$new_realname'
            WHERE password='$password1'";
            if ($conn->query($sql) === TRUE) {
                echo "User updated successfully!";
                go_back();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {echo "Wrong user or password!";}//Else we dont apply any change
    }
//%%%%%%%%%%%  Go back function  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

    function go_back (){
        echo "<a href = 'index.html'> <h3> Go back </h3> <a>";
    }
?>

