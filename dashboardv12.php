<!DOCTYPE html>
<html>
<head>
    <title>Factory Management Dashboard</title>
    <style>
        /* Existing Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .card {
            background-color: white;
            padding: 20px;
            margin: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .card a {
            text-decoration: none;
            color: #333;
        }
        .card img {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }
        /* New Styles for Tables */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <!-- Existing Dashboard Links -->
    <!-- ... -->

    <!-- Shipments Table -->
    <h2>Shipments</h2>
    <table>
        <tr>
            <th>Shipment ID</th>
            <th>License Number</th>
            <th>Status</th>
            <th>Location</th>
            <!-- Add other fields as needed -->
        </tr>
        <?php
        include 'connect_db.php';
        $shipmentsQuery = "SELECT * FROM Shipments WHERE Status IN ('Incoming', 'Outgoing')";
        $shipmentsResult = $conn->query($shipmentsQuery);
        while($row = $shipmentsResult->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['ShipmentID']."</td>
                    <td>".$row['LicenseNumber']."</td>
                    <td>".$row['Status']."</td>
                    <td>".$row['Location']."</td>
                  </tr>";
        }
        ?>
    </table>

    <!-- In-Stock Reels Table -->
    <h2>In-Stock Reels</h2>
    <table>
        <tr>
            <th>Reel Number</th>
            <th>Width</th>
            <th>GSM</th>
            <th>Grade</th>
            <!-- Add other fields as needed -->
        </tr>
        <?php
        $reelsQuery = "SELECT * FROM Products WHERE Status = 'In-Stock' ORDER BY Width";
        $reelsResult = $conn->query($reelsQuery);
        while($row = $reelsResult->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['ReelNumber']."</td>
                    <td>".$row['Width']."</td>
                    <td>".$row['GSM']."</td>
                    <td>".$row['Grade']."</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
