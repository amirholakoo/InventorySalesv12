<?php
// submit_truck.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input field
    $license_number = $_POST['license_number'];
    $driver_name = $_POST['driver_name'];
    $phone = $_POST['phone'];
$status = 'Ready';

    // SQL to add a truck
    $sql = "INSERT INTO Trucks (LicenseNumber, DriverName, Phone, Status) VALUES ('$license_number', '$driver_name', '$phone', 'Ready')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
