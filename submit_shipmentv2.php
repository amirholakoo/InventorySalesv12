<?php
// submit_shipment.php

include 'connect_db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $license_number = $_POST['license_number'];
    $shipment_type = $_POST['shipment_type'];
    $entry_time = date('Y-m-d H:i:s'); // Get current date and time
    $location = 'Entrance'; // Set location to 'Entrance'

    // SQL to find the TruckID for the given LicenseNumber
    $sql_get_truck_id = "SELECT TruckID FROM Trucks WHERE LicenseNumber = '$license_number'";
    $truck_id_result = $conn->query($sql_get_truck_id);

    if ($truck_id_result->num_rows > 0) {
        $truck_row = $truck_id_result->fetch_assoc();
        $truck_id = $truck_row['TruckID'];

        // SQL to create a new shipment
        $sql_create_shipment = "INSERT INTO Shipments (TruckID, EntryTime, Location, Status) 
                                VALUES ('$truck_id', '$entry_time', '$location', '$shipment_type')";

        // SQL to update the truck's status to 'Loading'
        $sql_update_truck = "UPDATE Trucks SET Status = 'Loading' WHERE LicenseNumber = '$license_number'";

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Execute the queries
            if ($conn->query($sql_create_shipment) === TRUE && $conn->query($sql_update_truck) === TRUE) {
                // Commit transaction if both queries are successful
                $conn->commit();
                echo "New shipment created successfully and truck status updated to 'Loading'.";
            } else {
                throw new Exception("Error in creating shipment or updating truck: " . $conn->error);
            }
        } catch (Exception $e) {
            $conn->rollback(); // Rollback transaction on error
            echo $e->getMessage();
        }
    } else {
        echo "No truck found with License Number: $license_number";
    }

    $conn->close(); // Close the database connection
}
?>
