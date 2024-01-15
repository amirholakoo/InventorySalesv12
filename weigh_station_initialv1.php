<!-- weigh_station_initial.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching trucks involved in active shipments
$query = "SELECT LicenseNumber FROM Shipments WHERE Status IN ('Incoming', 'Outgoing')";
$result = $conn->query($query);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Weigh Station - Initial Weight</title>
</head>
<body>
    <h1>Weigh Station - Initial Weight Entry</h1>
    
    <form action='submit_initial_weight.php' method='post'>
        <label for='truck'>Select Truck:</label>
        <select name='license_number' id='truck'>";

// Loop through the trucks and add them to the dropdown
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["LicenseNumber"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Trucks Available</option>";
}

echo "</select><br>
        Weight: <input type='number' name='weight'><br>
        <input type='submit' value='Submit Initial Weight'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
