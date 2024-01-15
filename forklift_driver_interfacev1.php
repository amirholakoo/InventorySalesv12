<!-- forklift_driver_interface.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching shipments with status 'Incoming' or 'Outgoing'
$shipmentsQuery = "SELECT Shipments.ShipmentID, Trucks.LicenseNumber FROM Shipments JOIN Trucks ON Shipments.TruckID = Trucks.TruckID WHERE Shipments.Status IN ('Incoming', 'Outgoing')";
$shipmentsResult = $conn->query($shipmentsQuery);

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
    
    <form action='submit_forklift_operations.php' method='post'>
        Forklift Type: 
        <input type='radio' id='incoming' name='forklift_type' value='Incoming'>
        <label for='incoming'>Incoming</label>
        <input type='radio' id='outgoing' name='forklift_type' value='Outgoing'>
        <label for='outgoing'>Outgoing</label><br>
        
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
        Unloading Location (if applicable): <input type='text' name='unloading_location'><br>
        <input type='submit' value='Submit Operation'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
