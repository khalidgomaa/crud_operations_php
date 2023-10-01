<?php
$servername = "localhost"; // Replace with your server name or IP address
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "php_4"; // Replace with the name of your MySQL database

$connection = new mysqli($servername, $username, $password, $database);

// if ($connection->connect_error) {
//     die("Connection failed: " . $connection->connect_error);
// } else {
//     echo "Connected successfully!";

// }

// $connection->close(); 
?>
