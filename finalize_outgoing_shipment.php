<?php
// finalize_outgoing_shipment.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['shipment_id'];
    $selected_rolls = $_POST['selected_rolls'];
    $reel_numbers = implode(',', $selected_rolls);

    // SQL to update the outgoing shipment
    $sql = "UPDATE Shipments SET Location = 'Loaded', ReelNumbers = '$reel_numbers' WHERE ShipmentID = '$shipment_id'";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "Outgoing shipment updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
