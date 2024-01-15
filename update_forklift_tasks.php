<?php
// update_forklift_tasks.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['shipment_id'];
    $reel_numbers = $_POST['reel_numbers'];
    $unloading_location = $_POST['unloading_location'];

    // Determine the new location based on the shipment status
    $shipmentStatusQuery = "SELECT Status FROM Shipments WHERE ShipmentID = '$shipment_id'";
    $statusResult = $conn->query($shipmentStatusQuery);
    $statusRow = $statusResult->fetch_assoc();
    $newLocation = $statusRow['Status'] == 'Incoming' ? 'Unloaded' : 'Loaded';

    // Update the Products table
    foreach ($reel_numbers as $reel_number) {
        $updateProductSQL = "UPDATE Products SET Status = '$newLocation', Location = '$unloading_location' WHERE ReelNumber = '$reel_number'";
        $conn->query($updateProductSQL);
    }

    echo "Forklift tasks updated successfully";

    $conn->close(); // Close the database connection
}
?>
