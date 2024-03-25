<?php
$dblocal="localhost";
$dbuser="root";
$dbpassword="";
$dbname="autolinepk";
$connection=mysqli_connect($dblocal,$dbuser,$dbpassword,$dbname);
if (mysqli_connect_errno())
{
    die("database connection Failed:".mysqli_connect_error()."(".mysqli_connect_errno().")");
}
?>
