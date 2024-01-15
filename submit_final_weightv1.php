<?php
// submit_final_weight.php

include 'connect_db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $license_number = $_POST['license_number'];
    $final_weight = $_POST['final_weight'];

    // Update the final weight and status in Shipments table
    $sql = "UPDATE Shipments SET 
            UnloadedWeight = '$final_weight', 
            Status = 'Ready' 
            WHERE TruckID = (SELECT TruckID FROM Trucks WHERE LicenseNumber = '$license_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Final weight recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Update the status in Trucks table
    $sql_truck = "UPDATE Trucks SET Status = 'Ready' WHERE LicenseNumber = '$license_number'";
    
    if ($conn->query($sql_truck) === TRUE) {
        echo "Truck status updated successfully";
    } else {
        echo "Error: " . $sql_truck . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
