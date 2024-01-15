<!-- forklift_tasks.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching shipments with status 'Incoming' or 'Outgoing'
$shipmentsQuery = "SELECT Shipments.ShipmentID, Trucks.LicenseNumber FROM Shipments JOIN Trucks ON Shipments.TruckID = Trucks.TruckID WHERE Shipments.Status IN ('Incoming', 'Outgoing')";
$shipmentsResult = $conn->query($shipmentsQuery);

// Fetching available widths from Products
$widthsQuery = "SELECT DISTINCT Width FROM Products WHERE Status = 'In-Stock'";
$widthsResult = $conn->query($widthsQuery);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Forklift Tasks</title>
</head>
<body>
    <h1>Forklift Driver's Tasks</h1>
    
    <form action='submit_forklift_tasks.php' method='post'>
        <label for='shipment'>Select Shipment:</label>
        <select name='shipment_id' id='shipment'>";

// Loop through the shipments and add them to the dropdown
if ($shipmentsResult->num_rows > 0) {
    while($row = $shipmentsResult->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Shipments Available</option>";
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
        <input type='submit' value='Load Reels'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
