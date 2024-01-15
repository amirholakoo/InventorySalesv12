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

    // SQL to create a shipment
    $sql = "INSERT INTO Shipments (TruckID, LicenseNumber, EntryTime, Location, Status) VALUES ((SELECT TruckID FROM Trucks WHERE LicenseNumber = '$license_number'), '$license_number', '$entry_time', '$location', '$shipment_type')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "New shipment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



    // SQL to create a shipment
    $updatesql = "UPDATE Trucks SET Status = 'Loading' WHERE LicenseNumber = '$license_number'";
 
//"INSERT INTO Shipments (TruckID, LicenseNumber, EntryTime, Location, Status) VALUES ((SELECT TruckID FROM Trucks WHERE LicenseNumber = '$license_number'), '$license_number', '$entry_time', '$location', '$shipment_type')";

    // Execute the query and check for errors
    if ($conn->query($updatesql) === TRUE) {
        echo "New shipment created successfully";
    } else {
        echo "Error: " . $updatesql . "<br>" . $conn->error;
    }


    $conn->close(); // Close the database connection
}
?>
