<?php
    include("include/dbcon.php");
    $sql ='TRUNCATE TABLE cart';
    mysqli_query($connection, $sql);
	session_start();
	session_destroy();
	session_unset();
	header('location: index.php');
	exit();
?>