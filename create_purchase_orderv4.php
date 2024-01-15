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
    <script type='text/javascript'>
        function calculateNetWeight() {
            var shipmentSelect = document.getElementById('shipment');
            var selectedOption = shipmentSelect.options[shipmentSelect.selectedIndex];
            
            var loadedWeight = selectedOption.getAttribute('data-loaded-weight');
            var unloadedWeight = selectedOption.getAttribute('data-unloaded-weight');

            // Calculate Net Weight
            var netWeight = loadedWeight - unloadedWeight;
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
        echo "<option value='".$row["ShipmentID"]."' data-loaded-weight='".$row["LoadedWeight"]."' data-unloaded-weight='".$row["UnloadedWeight"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Shipments Available</option>";
}

echo "</select><br>
        Loaded Weight (KG): <input type='number' name='loaded_weight' id='loaded_weight'><br>
        Unloaded Weight (KG): <input type='number' name='unloaded_weight' id='unloaded_weight'><br>
        Net Weight (KG): <input type='number' name='net_weight' id='net_weight' readonly><br>
        <!-- Rest of your form fields -->
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
