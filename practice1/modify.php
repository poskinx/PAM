<?php

include 'database.php';
$conn = connect ();
modify_user ($conn);
disconnect($conn);
?>