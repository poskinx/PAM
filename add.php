<?php

    include 'database.php';
    $conn = connect ();
    add_user ($conn);
    disconnect($conn);
?>