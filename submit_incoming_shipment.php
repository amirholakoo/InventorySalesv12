<?php
// submit_incoming_shipment.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['incoming_shipment_id'];
    $unload_location = $_POST['unload_location'];

    // SQL to update incoming shipment
    $sql = "UPDATE Shipments SET Location = 'Unloaded', UnloadLocation = '$unload_location' WHERE ShipmentID = '$shipment_id'";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "Incoming shipment updated successfully";
    } else {
        echo "Error updating shipment: " . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
