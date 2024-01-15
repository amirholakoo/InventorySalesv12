<!-- dashboard.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetch data for the tables
$inStockQuery = "SELECT * FROM Products WHERE Status = 'In-Stock'";
$inStockResult = $conn->query($inStockQuery);

$trucksQuery = "SELECT LicenseNumber, DriverName, Phone FROM Trucks";
$trucksResult = $conn->query($trucksQuery);

$shipmentsQuery = "SELECT * FROM Shipments WHERE Status IN ('Incoming', 'Outgoing')";
$shipmentsResult = $conn->query($shipmentsQuery);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .dashboard-link {
            margin-right: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .dashboard-section {
            margin-bottom: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    
    <!-- Top Section with Links -->
    <div class='dashboard-section'>
        <a href='create_sales_order.php' class='dashboard-link'>Create Sales Order</a>
        <a href='create_purchase_order.php' class='dashboard-link'>Create Purchase Order</a>
        <a href='forklift_driver_interface.php' class='dashboard-link'>Forklift Driver Interface</a>
        <!-- Add more links as needed -->
    </div>

    <!-- Bottom Section with Tables -->
    <div class='dashboard-section'>
        <!-- In-Stock Products Table -->
        <h2>In-Stock Products</h2>
        <table>
            <tr>
                <th>Reel Number</th>
                <th>GSM</th>
                <th>Width</th>
                <th>Length</th>
                <th>Grade</th>
                <!-- Add more columns as needed -->
            </tr>";

            // Loop through the in-stock products and add them to the table
            while($row = $inStockResult->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["ReelNumber"]."</td>
                        <td>".$row["GSM"]."</td>
                        <td>".$row["Width"]."</td>
                        <td>".$row["Length"]."</td>
                        <td>".$row["Grade"]."</td>
                      </tr>";
            }

echo "  </table>

        <!-- Trucks Table -->
        <h2>Trucks</h2>
        <table>
            <tr>
                <th>License Number</th>
                <th>Driver Name</th>
                <th>Phone</th>
            </tr>";

            // Loop through the trucks and add them to the table
            while($row = $trucksResult->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["LicenseNumber"]."</td>
                        <td>".$row["DriverName"]."</td>
                        <td>".$row["Phone"]."</td>
                      </tr>";
            }

echo "  </table>

        <!-- Shipments Table -->
        <h2>Shipments</h2>
        <table>
            <tr>
                <th>Shipment ID</th>
                <th>Status</th>
                <th>Location</th>
                <!-- Add more columns as needed -->
            </tr>";

            // Loop through the shipments and add them to the table
            while($row = $shipmentsResult->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["ShipmentID"]."</td>
                        <td>".$row["Status"]."</td>
                        <td>".$row["Location"]."</td>
                      </tr>";
            }

echo "  </table>
    </div>
</body>
</html>";

$conn->close(); // Close the database connection
?>
