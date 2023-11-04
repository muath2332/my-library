<?php

$host = 'localhost';       // Your MySQL host, usually "localhost"
$username = 'root';   // Your MySQL username
$password = '';   // Your MySQL password
$database = 'userdb';   // Name of your database

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// The echo statement has been removed


// Remember to close the connection after you're done
$conn->close();

?>