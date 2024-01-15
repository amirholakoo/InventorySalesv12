<?php
// connect_db.php

$servername = "localhost"; // Assuming MySQL is hosted on the same server
$username = "admin"; // The username for the database
$password = "pi"; // The password for the database
$dbname = "PaperFactory"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If this message shows, the connection is successful
echo "Connected successfully";
?>
