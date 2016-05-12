<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$mysqli = new mysqli($servername, $username, $password, $dbname);
if (mysqli_connect_errno()){
	die('Unable to connect!'). mysqli_connect_error();
}

?>