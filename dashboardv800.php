<!-- dashboard.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Section 1: Recent Shipments
$shipmentsQuery = "SELECT LicenseNumber, Status, Location, EntryTime, ExitTime FROM Shipments JOIN Trucks ON Shipments.TruckID = Trucks.TruckID ORDER BY EntryTime DESC";
$shipmentsResult = $conn->query($shipmentsQuery);

// Section 2: Weight Station Status (example query, adjust as needed)
$weightStationQuery = "SELECT LicenseNumber, Status, Location FROM Shipments WHERE Location IN ('Loading', 'Unloading') ORDER BY EntryTime DESC";
$weightStationResult = $conn->query($weightStationQuery);

// Other sections' queries will follow a similar pattern

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

    <!-- Section 1: Recent Shipments -->
    <div class='dashboard-section' id='recent-shipments'>
        <h2>Recent Shipments</h2>
        <table>
            <tr>
                <th>License Number</th>
                <th>Status</th>
                <th>Location</th>
                <th>Entry Time</th>
                <th>Exit Time</th>
            </tr>";

if ($shipmentsResult->num_rows > 0) {
    while($row = $shipmentsResult->fetch_assoc()) {
        echo "<tr>
                <td>".$row["LicenseNumber"]."</td>
                <td>".$row["Status"]."</td>
                <td>".$row["Location"]."</td>
                <td>".$row["EntryTime"]."</td>
                <td>".$row["ExitTime"]."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No Recent Shipments</td></tr>";
}

echo "    </table>
    </div>

    <!-- Section 2: Weight Station Status -->
    <div class='dashboard-section' id='weight-station-status'>
        <h2>Weight Station Status</h2>
        <table>
            <tr>
                <th>License Number</th>
                <th>Status</th>
                <th>Location</th>
            </tr>";

if ($weightStationResult->num_rows > 0) {
    while($row = $weightStationResult->fetch_assoc()) {
        echo "<tr>
                <td>".$row["LicenseNumber"]."</td>
                <td>".$row["Status"]."</td>
                <td>".$row["Location"]."</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No Activity at Weight Station</td></tr>";
}

echo "    </table>
    </div>

    <!-- Other sections will follow a similar pattern -->

    <div style='clear:both;'></div>
</body>
</html>
";

$conn->close(); // Close the database connection
?>
