<?php
$db_name = "three_d"; // Database name
$host = "localhost"; // Hostname
$username = "root"; // MySQL username
$password = ""; // MySQL password
$port = 3307; // Port number

// Establishing the database connection
$connection = mysqli_connect($host, $username, $password, $db_name, $port);

// Check if the connection was successful
if (!$connection) {
    die("Connection to the database failed: " . mysqli_connect_error());
}
?>
