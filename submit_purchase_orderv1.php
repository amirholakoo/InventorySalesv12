<?php
// submit_purchase_order.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    // ... (collect all the input fields here)

    // Calculate VAT if applicable
    $vat_amount = isset($_POST['vat']) ? $_POST['total_bill_price'] * 0.09 : 0;
    $total_cost = $_POST['total_bill_price'] + $vat_amount + $_POST['shipping_cost'];

    // SQL to create a purchase record
    $purchaseSql = "INSERT INTO Purchases (...) VALUES (...)";
    $conn->query($purchaseSql);
    $purchaseID = $conn->insert_id;

    // Update the Shipments table
    $shipmentSql = "UPDATE Shipments SET Status = 'Delivered', Location = 'Delivered', MaterialID = ..., PurchaseID = '$purchaseID', ExitTime = NOW() WHERE ShipmentID = ...";
    $conn->query($shipmentSql);

    // Update the Trucks table
    $truckSql = "UPDATE Trucks SET Status = 'Ready' WHERE TruckID = (SELECT TruckID FROM Shipments WHERE ShipmentID = ...)";
    $conn->query($truckSql);

    // Update the Suppliers table
    $supplierSql = "UPDATE Suppliers SET ... WHERE SupplierID = ...";
    $conn->query($supplierSql);

    // Check for errors
    if ($conn->error) {
        echo "Error: " . $conn->error;
    } else {
        echo "Purchase order created successfully";
    }

    $conn->close(); // Close the database connection
}
?>
