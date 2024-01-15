<!-- create_sales_order.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching rolls with status 'In-Stock'
$rollsQuery = "SELECT ReelNumber, Width FROM Products WHERE Status = 'In-Stock'";
$rollsResult = $conn->query($rollsQuery);

// Fetching customers
$customersQuery = "SELECT CustomerID, Name FROM Customers";
$customersResult = $conn->query($customersQuery);

// Fetching shipments with status 'Outgoing' and location 'Ready'
$shipmentsQuery = "SELECT Shipments.ShipmentID, Trucks.LicenseNumber FROM Shipments JOIN Trucks ON Shipments.TruckID = Trucks.TruckID WHERE Shipments.Status = 'Outgoing' AND Shipments.Location = 'Loaded'";
$shipmentsResult = $conn->query($shipmentsQuery);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Create Sales Order</title>
</head>
<body>
    <h1>Create Sales Order</h1>
    
    <form action='submit_sales_order.php' method='post'>
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
        <label for='customer'>Select Customer:</label>
        <select name='customer_id' id='customer'>";

// Loop through the customers and add them to the dropdown
if ($customersResult->num_rows > 0) {
    while($row = $customersResult->fetch_assoc()) {
        echo "<option value='".$row["CustomerID"]."'>".$row["Name"]."</option>";
    }
} else {
    echo "<option value=''>No Customers Available</option>";
}

echo "</select><br>
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
        Net Weight (KG): <input type='number' name='net_weight'><br>
        Sales Price Per KG: <input type='number' name='sales_price_per_kg'><br>
        Include VAT (9%): <input type='checkbox' name='vat_included'><br>
        <input type='submit' value='Create Sales Order'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
