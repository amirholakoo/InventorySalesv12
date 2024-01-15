<!-- weigh_station_final.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching shipments with locations 'Loading', 'Loaded', or 'Unloading'
$query = "SELECT Shipments.ShipmentID, Trucks.LicenseNumber FROM Shipments JOIN Trucks ON Shipments.TruckID = Trucks.TruckID WHERE Shipments.Location IN ('Loading', 'Loaded', 'Unloading', 'Unloaded')";
$result = $conn->query($query);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Weigh Station - Final Weight</title>
</head>
<body>
    <h1>Weigh Station - Final Weight Entry</h1>
    
    <form action='submit_final_weight.php' method='post'>
        <label for='shipment'>Select Truck:</label>
        <select name='shipment_id' id='shipment'>";

// Loop through the shipments and add them to the dropdown
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Trucks Available</option>";
}

echo "</select><br>
        Weight: <input type='number' name='weight'><br>
        <input type='submit' value='Submit Final Weight'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
