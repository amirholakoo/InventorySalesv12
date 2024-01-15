<?php
// submit_forklift_operations.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $forklift_type = $_POST['forklift_type'];
    $shipment_id = $_POST['shipment_id'];
    $reel_numbers = $_POST['reel_numbers'];
    $unloading_location = $_POST['unloading_location'];

    // Determine the new location based on the forklift type
    $newLocation = $forklift_type == 'Incoming' ? 'Unloaded' : 'Loaded';

    // SQL to update the Shipments table
    $updateShipmentSQL = "UPDATE Shipments SET ReelNumbers = '$reel_numbers', Location = '$newLocation'";
    if ($forklift_type == 'Incoming') {
        $updateShipmentSQL .= ", UnloadLocation = '$unloading_location'";
    }
    $updateShipmentSQL .= " WHERE ShipmentID = '$shipment_id'";

    // Execute the query and check for errors
    if ($conn->query($updateShipmentSQL) === TRUE) {
        // Update the Products table
        $reelNumbersArray = explode(',', $reel_numbers);
        foreach ($reelNumbersArray as $reelNumber) {
            $updateProductSQL = "UPDATE Products SET Location = (SELECT LicenseNumber FROM Trucks WHERE TruckID = (SELECT TruckID FROM Shipments WHERE ShipmentID = '$shipment_id')) WHERE ReelNumber = '$reelNumber'";
            $conn->query($updateProductSQL);
        }

        echo "Forklift operation submitted successfully";
    } else {
        echo "Error updating shipment: " . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
