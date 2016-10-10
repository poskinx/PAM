<?php

include 'database.php';
$conn = connect ();
delete_user ($conn);
disconnect($conn);
?>