<?php
$db_name = "three_d";
$host = "localhost";
$username = "root";
$password = ""; 
$port = 3307; 


$connection = mysqli_connect($host, $username, $password, $db_name, $port);

if (!$connection) {
    die("Connection to the database failed: " . mysqli_connect_error());
}
?>
