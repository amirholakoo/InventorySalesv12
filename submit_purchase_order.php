<?php
// submit_purchase_order.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['shipment_id'];
    $material_id = $_POST['material_id'];
    $loaded_weight = $_POST['loaded_weight'];
    $unloaded_weight = $_POST['unloaded_weight'];
    $net_weight = $_POST['net_weight'];
    $total_bill_price = $_POST['total_bill_price'];
    $price_per_kg = $_POST['price_per_kg'];
    $shipping_cost = $_POST['shipping_cost'];
    $vat_included = isset($_POST['vat_included']) ? 1 : 0;
    $unloading_location = $_POST['unloading_location'];
    $comments = $_POST['comments'];
    $exit_time = date('Y-m-d H:i:s');
    $status = 'Delivered';
    $location = 'Delivered';
    
    // Calculate VAT if included
    $vat_amount = $vat_included ? ($total_bill_price * 0.09) : 0;
    $total_bill_price_incl_vat = $total_bill_price + $vat_amount;

    // SQL to insert into Purchases table
    $insertPurchaseSQL = "INSERT INTO Purchases (SupplierID, MaterialID, Cost, NetWeight, PurchaseDate) VALUES ((SELECT SupplierID FROM RawMaterials WHERE MaterialID = '$material_id'), '$material_id', '$total_bill_price_incl_vat', '$net_weight', '$exit_time')";

    if ($conn->query($insertPurchaseSQL) === TRUE) {
        $purchase_id = $conn->insert_id; // Get the generated PurchaseID

        // SQL to update the Shipments table
        $updateShipmentSQL = "UPDATE Shipments SET Status = '$status', Location = '$location', MaterialID = '$material_id', PurchaseID = '$purchase_id', UnloadLocation = '$unloading_location', ExitTime = '$exit_time' WHERE ShipmentID = '$shipment_id'";

        if ($conn->query($updateShipmentSQL) === TRUE) {
            // Update the Truck table
            $updateTruckSQL = "UPDATE Trucks JOIN Shipments ON Trucks.TruckID = Shipments.TruckID SET Trucks.Status = 'Ready' WHERE Shipments.ShipmentID = '$shipment_id'";

            if ($conn->query($updateTruckSQL) === TRUE) {
                echo "Purchase order created successfully";
            } else {
                echo "Error updating truck: " . $conn->error;
            }
        } else {
            echo "Error updating shipment: " . $conn->error;
        }
    } else {
        echo "Error creating purchase order: " . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
