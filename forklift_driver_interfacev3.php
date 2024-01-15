<!-- forklift_driver_interface.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching incoming shipments
$incomingQuery = "SELECT ShipmentID, LicenseNumber FROM Shipments WHERE Status = 'Incoming'";
$incomingResult = $conn->query($incomingQuery);

// Fetching outgoing shipments
$outgoingQuery = "SELECT ShipmentID, LicenseNumber FROM Shipments WHERE Status = 'Outgoing'";
$outgoingResult = $conn->query($outgoingQuery);

// Fetching rolls with status 'In-Stock'
$rollsQuery = "SELECT ReelNumber, Width FROM Products WHERE Status = 'In-Stock'";
$rollsResult = $conn->query($rollsQuery);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Forklift Driver Interface</title>
</head>
<body>
    <h1>Forklift Driver Interface</h1>
    
    <!-- Incoming Shipments Section -->
    <h2>Incoming Shipments</h2>
    <form action='update_incoming_shipment.php' method='post'>
        <label for='incoming_shipment'>Select Incoming Shipment:</label>
        <select name='incoming_shipment_id' id='incoming_shipment'>";

// Loop through incoming shipments and add them to the dropdown
if ($incomingResult->num_rows > 0) {
    while($row = $incomingResult->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Incoming Shipments Available</option>";
}

echo "</select><br>
        Unload Location: <input type='text' name='unload_location'><br>
        <input type='submit' value='Update Incoming Shipment'>
    </form>

    <hr>

    <!-- Outgoing Shipments Section -->
    <h2>Outgoing Shipments</h2>
    <form action='update_outgoing_shipment.php' method='post'>
        <label for='outgoing_shipment'>Select Outgoing Shipment:</label>
        <select name='outgoing_shipment_id' id='outgoing_shipment'>";

// Loop through outgoing shipments and add them to the dropdown
if ($outgoingResult->num_rows > 0) {
    while($row = $outgoingResult->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Outgoing Shipments Available</option>";
}

echo "</select><br>
        <label for='roll_width'>Select Roll Width:</label>
        <select name='roll_width' id='roll_width'>";

// Loop through the rolls and add them to the dropdown
if ($rollsResult->num_rows > 0) {
    while($row = $rollsResult->fetch_assoc()) {
        echo "<option value='".$row["Width"]."'>".$row["Width"]."</option>";
    }
} else {
    echo "<option value=''>No Rolls Available</option>";
}

echo "</select><br>
        Reel Numbers (comma-separated): <input type='text' name='reel_numbers'><br>
        <input type='submit' value='Update Outgoing Shipment'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
