<?php
// submit_sales_order.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $roll_width = $_POST['roll_width'];
    $reel_numbers = $_POST['reel_numbers'];
    $customer_id = $_POST['customer_id'];
    $shipment_id = $_POST['shipment_id'];
    $net_weight = $_POST['net_weight'];
    $sales_price_per_kg = $_POST['sales_price_per_kg'];
    $vat_included = isset($_POST['vat_included']) ? 1 : 0;
    $exit_time = date('Y-m-d H:i:s');
    
    // Calculate VAT if included
    $vat_amount = $vat_included ? ($sales_price_per_kg * $net_weight * 0.09) : 0;
    $total_sales_price = $sales_price_per_kg * $net_weight + $vat_amount;

    // SQL to insert into Sales table
    $insertSalesSQL = "INSERT INTO Sales (CustomerID, TruckID, ShipmentID, ReelNumbers, SaleAmount, NetWeight, Date) VALUES ('$customer_id', (SELECT TruckID FROM Shipments WHERE ShipmentID = '$shipment_id'), '$shipment_id', '$reel_numbers', '$total_sales_price', '$net_weight', '$exit_time')";

    if ($conn->query($insertSalesSQL) === TRUE) {
        $sales_id = $conn->insert_id; // Get the generated SalesID

        // SQL to update the Shipments table
        $updateShipmentSQL = "UPDATE Shipments SET SalesID = '$sales_id', ReelNumbers = '$reel_numbers', Status = 'Delivered', Location = 'Delivered', ExitTime = '$exit_time' WHERE ShipmentID = '$shipment_id'";

        if ($conn->query($updateShipmentSQL) === TRUE) {
            // Update the Truck table
            $updateTruckSQL = "UPDATE Trucks JOIN Shipments ON Trucks.TruckID = Shipments.TruckID SET Trucks.Status = 'Ready' WHERE Shipments.ShipmentID = '$shipment_id'";

            if ($conn->query($updateTruckSQL) === TRUE) {
                // Update the Products table
                $reelNumbersArray = explode(',', $reel_numbers);
                foreach ($reelNumbersArray as $reelNumber) {
                    $updateProductSQL = "UPDATE Products SET Status = 'Delivered', Location = (SELECT LicenseNumber FROM Trucks WHERE TruckID = (SELECT TruckID FROM Shipments WHERE ShipmentID = '$shipment_id')) WHERE ReelNumber = '$reelNumber'";
                    $conn->query($updateProductSQL);
                }

                echo "Sales order created successfully";
            } else {
                echo "Error updating truck: " . $conn->error;
            }
        } else {
            echo "Error updating shipment: " . $conn->error;
        }
    } else {
        echo "Error creating sales order: " . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
