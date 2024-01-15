<!-- dashboard.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Factory Management Dashboard</title>
    <!-- Add your CSS file link here -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Existing styles */
        /* ... */

        /* Additional styles for tables */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        tr:hover {background-color: #ddd;}
    </style>


</head>
<body>
    <h1>Factory Management Dashboard</h1>

    <div class="dashboard-container">
        <!-- Add Truck -->
        <div class="dashboard-item">
            <a href="add_truck.php">
                <img src="icons/truck_icon.png" alt="Add Truck">
                <span>Add Truck</span>
            </a>
        </div>

        <!-- Add Customer and Supplier -->
        <div class="dashboard-item">
            <a href="add_customer_supplier.php">
                <img src="icons/customer_supplier_icon.png" alt="Add Customer/Supplier">
                <span>Add Customer/Supplier</span>
            </a>
        </div>

        <!-- Add Raw Material -->
        <div class="dashboard-item">
            <a href="add_raw_material.php">
                <img src="icons/raw_material_icon.png" alt="Add Raw Material">
                <span>Add Raw Material</span>
            </a>
        </div>

        <!-- Add Roll -->
        <div class="dashboard-item">
            <a href="add_roll.php">
                <img src="icons/roll_icon.png" alt="Add Roll">
                <span>Add Roll</span>
            </a>
        </div>

        <!-- Create Shipment -->
        <div class="dashboard-item">
            <a href="create_shipment.php">
                <img src="icons/shipment_icon.png" alt="Create Shipment">
                <span>Create Shipment</span>
            </a>
        </div>

        <!-- Weigh Station (Initial and Final) -->
        <div class="dashboard-item">
            <a href="weigh_station_initial.php">
                <img src="icons/weigh_station_icon.png" alt="Weigh Station Initial">
                <span>Weigh Station Initial</span>
            </a>
            <a href="weigh_station_final.php">
                <img src="icons/weigh_station_icon2.png" alt="Weigh Station Final">
                <span>Weigh Station Final</span>
            </a>
        </div>

        <!-- Create Purchase Order -->
        <div class="dashboard-item">
            <a href="create_purchase_order.php">
                <img src="icons/purchase_order_icon.png" alt="Create Purchase Order">
                <span>Create Purchase Order</span>
            </a>
        </div>

        <!-- Create Sales Order -->
        <div class="dashboard-item">
            <a href="create_sales_order.php">
                <img src="icons/sales_order_icon.png" alt="Create Sales Order">
                <span>Create Sales Order</span>
            </a>
        </div>

        <!-- Forklift Driver Interface -->
        <div class="dashboard-item">
            <a href="forklift_driver_interface.php">
                <img src="icons/forklift_icon.png" alt="Forklift Driver Interface">
                <span>Forklift Driver Interface</span>
            </a>
        </div>
        <!-- Reports -->
        <div class="dashboard-item">
            <a href="report_page.php">
                <img src="icons/report_page.png" alt="Report Section">
                <span>Report Section</span>
            </a>
        </div>



</div>

<!-- Shipments Table -->
    <h2>Shipments Overview</h2>
    <table>
        <thead>
            <tr>
                <th>Shipment ID</th>
                <th>TruckID</th>
<th>LicenseNumber</th>

		<th>ReelNumbers</th>
		<th>MaterialID</th>
<th>SalesID</th>
<th>PurchaseID</th>
<th>EntryTime</th>
<th>Location</th>
<th>UnloadLocation</th>
<th>Status</th>
<th>LoadedWeight</th>
<th>UnloadedWeight</th>
<th>ExitTime</th>




            </tr>
        </thead>
        <tbody>
            <!-- PHP code to populate table -->
            <?php include 'populate_shipments_table.php'; ?>
        </tbody>
    </table>

    <!-- Products Table -->
    <h2>In-Stock Rolls Overview</h2>
    <table>
        <thead>
            <tr>
                <th>Reel Number</th>
                <th>Width</th>
                <th>Length</th>
                <th>GSM</th>
<th>Grade</th>
<th>Breaks</th>
<th>Location</th>
<th>Status</th>
<th>Comments</th>
                <!-- Add other fields as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- PHP code to populate table -->
            <?php include 'populate_products_table.php'; ?>
        </tbody>
    </table>
</body>
</html>

