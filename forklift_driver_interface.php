<!-- forklift_driver_interface.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching incoming shipments
$incomingShipmentsQuery = "SELECT ShipmentID, LicenseNumber FROM Shipments WHERE Status = 'Incoming' AND Location = 'Entrance' OR Location = 'Unloading'";
$incomingShipmentsResult = $conn->query($incomingShipmentsQuery);

// Fetching outgoing shipments
$outgoingShipmentsQuery = "SELECT ShipmentID, LicenseNumber FROM Shipments WHERE Status = 'Outgoing' AND Location ='Loading'";
$outgoingShipmentsResult = $conn->query($outgoingShipmentsQuery);

// Fetching available widths for In-Stock rolls
$widthsQuery = "SELECT DISTINCT Width FROM Products WHERE Status = 'In-Stock'";
$widthsResult = $conn->query($widthsQuery);

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
        <label for='incoming_shipment'>Select Truck:</label>
        <select name='incoming_shipment_id' id='incoming_shipment'>";

// Loop through the incoming shipments and add them to the dropdown
if ($incomingShipmentsResult->num_rows > 0) {
    while($row = $incomingShipmentsResult->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Incoming Shipments Available</option>";
}

echo "</select><br>
        Unload Location: <input type='text' name='unload_location'><br>
        <input type='submit' value='Update Incoming Shipment'>
    </form>

    <br><hr><br>

    <!-- Outgoing Shipments Section -->
    <h2>Outgoing Shipments</h2>
    <form action='update_outgoing_shipment.php' method='post'>
        <label for='outgoing_shipment'>Select Truck:</label>
        <select name='outgoing_shipment_id' id='outgoing_shipment'>";

// Loop through the outgoing shipments and add them to the dropdown
if ($outgoingShipmentsResult->num_rows > 0) {
    while($row = $outgoingShipmentsResult->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Outgoing Shipments Available</option>";
}

echo "</select><br>
        <label for='roll_width'>Select Roll Width:</label>
        <select name='roll_width' id='roll_width'>";

// Loop through the widths and add them to the dropdown
if ($widthsResult->num_rows > 0) {
    while($row = $widthsResult->fetch_assoc()) {
        echo "<option value='".$row["Width"]."'>".$row["Width"]."</option>";
    }
} else {
    echo "<option value=''>No Widths Available</option>";
}

echo "</select><br>
        <input type='submit' value='Load Rolls for Outgoing Shipment'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
