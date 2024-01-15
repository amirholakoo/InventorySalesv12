<?php
// submit_outgoing_shipment.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $roll_width = $_POST['roll_width'];
    $reel_numbers = $_POST['reel_numbers']; // Assuming reel numbers are comma-separated

    // SQL to fetch shipment ID for outgoing shipment
    $shipmentQuery = "SELECT ShipmentID FROM Shipments WHERE Status = 'Outgoing' AND Location = 'Ready'";
    $shipmentResult = $conn->query($shipmentQuery);
    if ($shipmentRow = $shipmentResult->fetch_assoc()) {
        $shipment_id = $shipmentRow['ShipmentID'];

        // SQL to update outgoing shipment
        $updateShipmentSQL = "UPDATE Shipments SET ReelNumbers = '$reel_numbers', Location = 'Loaded' WHERE ShipmentID = '$shipment_id'";

        // Execute the query and check for errors
        if ($conn->query($updateShipmentSQL) === TRUE) {
            echo "Outgoing shipment updated successfully";
        } else {
            echo "Error updating shipment: " . $conn->error;
        }
    } else {
        echo "No outgoing shipment found for the specified width";
    }

    $conn->close(); // Close the database connection
}
?>

