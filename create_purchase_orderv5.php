<!-- create_purchase_order.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching shipments with status 'Incoming' and location 'Ready'
$query = "SELECT Shipments.ShipmentID, Trucks.LicenseNumber, Shipments.LoadedWeight, Shipments.UnloadedWeight FROM Shipments JOIN Trucks ON Shipments.TruckID = Trucks.TruckID WHERE Shipments.Status = 'Incoming' AND Shipments.Location = 'Ready'";
$result = $conn->query($query);

// Fetching raw materials
$materialsQuery = "SELECT MaterialID, MaterialName FROM RawMaterials";
$materialsResult = $conn->query($materialsQuery);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Create Purchase Order</title>
    <script>
    function calculateNetWeight() {
        var shipment = document.getElementById('shipment');
        var selectedShipment = shipment.options[shipment.selectedIndex].getAttribute('data-weights');
        var weights = selectedShipment.split(',');
        var loadedWeight = parseFloat(weights[0]);
        var unloadedWeight = parseFloat(weights[1]);
        var netWeight = unloadedWeight - loadedWeight;
        document.getElementById('net_weight').value = netWeight;
    }
    </script>
</head>
<body>
    <h1>Create Purchase Order</h1>
    
    <form action='submit_purchase_order.php' method='post'>
        <label for='shipment'>Select Shipment:</label>
        <select name='shipment_id' id='shipment' onchange='calculateNetWeight()'>";

// Loop through the shipments and add them to the dropdown
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."' data-weights='".$row["LoadedWeight"].",".$row["UnloadedWeight"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Shipments Available</option>";
}

echo "</select><br>
        <!-- Other form fields here -->
        Net Weight (KG): <input type='number' name='net_weight' id='net_weight' readonly><br>
        <!-- Rest of the form -->
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
