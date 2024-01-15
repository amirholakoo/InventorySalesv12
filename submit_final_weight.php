<?php
// submit_final_weight.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['shipment_id'];
    $weight = $_POST['weight'];

    // Retrieve the current location of the shipment
    $locationQuery = "SELECT Location FROM Shipments WHERE ShipmentID = '$shipment_id'";
    $locationResult = $conn->query($locationQuery);
    $row = $locationResult->fetch_assoc();
    $shipmentLocation = $row['Location'];

    // Determine the weight field to update based on the location
    $weightField = $shipmentLocation == 'Unloading' ? 'UnloadedWeight' : 'LoadedWeight';

    // SQL to update the weight and set location to 'Ready'
    $sql = "UPDATE Shipments SET $weightField = '$weight', Location = 'Loaded' WHERE ShipmentID = '$shipment_id'";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "Weight updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
