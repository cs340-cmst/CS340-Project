<?php
    include("connectvars.php");

    // Connect to the database.
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	    if (!$conn) {
	    	die("Could not connect: " . mysql_error());
	    }
?>