<?php
// submit_shipment.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $license_number = $_POST['license_number'];
    $shipment_type = $_POST['shipment_type'];
    $entry_time = date('Y-m-d H:i:s'); // Capture the current time as entry time
    $location = 'Entrance'; // As mentioned, the location is Entrance

    // Begin transaction
    $conn->begin_transaction();

    // SQL to create a shipment
    //$sql_shipment = "INSERT INTO Shipments (TruckID, EntryTime, Location, Status) VALUES ((SELECT TruckID FROM Trucks WHERE LicenseNumber = '$license_number'), '$entry_time', '$location', '$shipment_type')";
// SQL to create a shipment
    $sql_shipment = "INSERT INTO Shipments (TruckID, EntryTime, Location, Status) VALUES ((SELECT TruckID FROM Trucks WHERE LicenseNumber = '$license_number'), '$entry_time', '$location', '$shipment_type')";


    // SQL to update the truck's status
    $sql_update_truck = "UPDATE Trucks SET Status = 'Loading' WHERE LicenseNumber = '$license_number'";

    // Execute the queries and check for errors
    if ($conn->query($sql_shipment) === TRUE && $conn->query($sql_update_truck) === TRUE) {
        $conn->commit(); // Commit the transaction if both queries succeed
        echo "New shipment created successfully and truck status updated to Loading.";
    } else {
        $conn->rollback(); // Rollback the transaction in case of any error
        echo "Error: " . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
