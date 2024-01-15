<?php
// submit_initial_weight.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['shipment_id'];
    $weight = $_POST['weight'];

    // Retrieve the current status of the shipment
    $statusQuery = "SELECT Status FROM Shipments WHERE ShipmentID = '$shipment_id'";
    $statusResult = $conn->query($statusQuery);
    $row = $statusResult->fetch_assoc();
    $shipmentStatus = $row['Status'];

    // Determine the weight field to update based on the shipment status
    $weightField = $shipmentStatus == 'Outgoing' ? 'UnloadedWeight' : 'LoadedWeight';
    $nextLocation = $shipmentStatus == 'Outgoing' ? 'Loading' : 'Unloading';

    // SQL to update the weight and location
    $sql = "UPDATE Shipments SET $weightField = '$weight', Location = '$nextLocation' WHERE ShipmentID = '$shipment_id'";
    $updateTruckStatus = "UPDATE Trucks JOIN Shipments ON Trucks.TruckID = Shipments.TruckID SET Trucks.Status = 'Loading' WHERE Shipments.ShipmentID = '$shipment_id'";

    // Execute the queries and check for errors
    if ($conn->query($sql) === TRUE && $conn->query($updateTruckStatus) === TRUE) {
        echo "Weight updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
