<!-- dashboard.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetch necessary data from the database
// Example: $shipmentsQuery = "SELECT * FROM Shipments ORDER BY EntryTime DESC LIMIT 5";
// Similar queries can be written for other sections

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        .dashboard-section {
            width: 30%;
            float: left;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            min-height: 200px;
            margin: 1.66%;
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>

    <div class='dashboard-section' id='recent-shipments'>
        <h2>Recent Shipments</h2>
        <!-- Populate with PHP from Shipments -->
    </div>

    <div class='dashboard-section' id='weight-station-status'>
        <h2>Weight Station Status</h2>
        <!-- Populate with PHP from Weight Station Data -->
    </div>

    <div class='dashboard-section' id='current-inventory'>
        <h2>Current Inventory</h2>
        <!-- Populate with PHP from Inventory Data -->
    </div>

    <div class='dashboard-section' id='recent-sales-orders'>
        <h2>Recent Sales Orders</h2>
        <!-- Populate with PHP from Sales Orders -->
    </div>

    <div class='dashboard-section' id='recent-purchase-orders'>
        <h2>Recent Purchase Orders</h2>
        <!-- Populate with PHP from Purchase Orders -->
    </div>

    <div class='dashboard-section' id='truck-status-overview'>
        <h2>Truck Status Overview</h2>
        <!-- Populate with PHP from Truck Data -->
    </div>

    <div style='clear:both;'></div>
</body>
</html>
";
$conn->close(); // Close the database connection
?>
