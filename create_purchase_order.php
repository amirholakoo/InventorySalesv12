<!-- create_purchase_order.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching shipments with status 'Incoming' and location 'Ready'
$query = "SELECT Shipments.ShipmentID, Trucks.LicenseNumber FROM Shipments JOIN Trucks ON Shipments.TruckID = Trucks.TruckID WHERE Shipments.Status = 'Incoming'";
$result = $conn->query($query);

// Fetching raw materials
$materialsQuery = "SELECT MaterialID, MaterialName FROM RawMaterials";
$materialsResult = $conn->query($materialsQuery);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Create Purchase Order</title>
</head>
<body>
    <h1>Create Purchase Order</h1>
    
    <form action='submit_purchase_order.php' method='post'>
        <label for='shipment'>Select Shipment:</label>
        <select name='shipment_id' id='shipment'>";

// Loop through the shipments and add them to the dropdown
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["ShipmentID"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Shipments Available</option>";
}

echo "</select><br>
        <label for='raw_material'>Select Raw Material:</label>
        <select name='material_id' id='raw_material'>";

// Loop through the raw materials and add them to the dropdown
if ($materialsResult->num_rows > 0) {
    while($row = $materialsResult->fetch_assoc()) {
        echo "<option value='".$row["MaterialID"]."'>".$row["MaterialName"]."</option>";
    }
} else {
    echo "<option value=''>No Raw Materials Available</option>";
}

echo "</select><br>
        Loaded Weight (KG): <input type='number' name='loaded_weight'><br>
        Unloaded Weight (KG): <input type='number' name='unloaded_weight'><br>
        Net Weight (KG): <input type='number' name='net_weight'><br>
        Total Bill Price: <input type='number' name='total_bill_price'><br>
        Price Per KG: <input type='number' name='price_per_kg'><br>
        Shipping Cost: <input type='number' name='shipping_cost'><br>
        Include VAT (9%): <input type='checkbox' name='vat_included'><br>
        Unloading Location: <input type='text' name='unloading_location'><br>
        Comments: <textarea name='comments'></textarea><br>
        <input type='submit' value='Create Purchase Order'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
