<!-- forklift_driver_interface.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching incoming shipments
$incomingQuery = "SELECT ShipmentID, LicenseNumber FROM Shipments WHERE Status = 'Incoming'";
$incomingResult = $conn->query($incomingQuery);

// Fetching available roll widths for outgoing shipments
$outgoingRollsQuery = "SELECT DISTINCT Width FROM Products WHERE Status = 'In-Stock'";
$outgoingRollsResult = $conn->query($outgoingRollsQuery);

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
    <form action='submit_incoming_shipment.php' method='post'>
        <label for='incoming_shipment'>Select Shipment:</label>
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
    <form action='submit_outgoing_shipment.php' method='post'>
        <label for='roll_width'>Select Roll Width:</label>
        <select name='roll_width' id='roll_width'>";

// Loop through roll widths and add them to the dropdown
if ($outgoingRollsResult->num_rows > 0) {
    while($row = $outgoingRollsResult->fetch_assoc()) {
        echo "<option value='".$row["Width"]."'>".$row["Width"]."</option>";
    }
} else {
    echo "<option value=''>No Rolls Available</option>";
}

echo "</select><br>
        <label for='reel_numbers'>Select Reel Numbers:</label><br>";

// Fetching reel numbers for the selected width
echo "<div id='reel_numbers_container'></div>
        <input type='submit' value='Update Outgoing Shipment'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
