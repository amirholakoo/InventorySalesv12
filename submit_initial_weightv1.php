<?php
// submit_initial_weight.php

include 'connect_db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $license_number = $_POST['license_number'];
    $weight = $_POST['weight'];
$Status = 'Loading';

    // Update the weight and status in Shipments table
    $sql = "UPDATE Shipments SET 
            LoadedWeight = '$weight', 
            Status = IF(Status='Incoming', 'Unloading', 'Loading') 
            WHERE TruckID = (SELECT TruckID FROM Trucks WHERE LicenseNumber = '$license_number')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "Initial weight recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Update the status in Trucks table
    $sql_truck = "UPDATE Trucks SET Status = IF(Status='Incoming', 'Unloading', 'Loading') WHERE LicenseNumber = '$license_number'";
    
    if ($conn->query($sql_truck) === TRUE) {
        echo "Truck status updated successfully";
    } else {
        echo "Error: " . $sql_truck . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
