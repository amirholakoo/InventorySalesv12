<!-- weigh_station_final.php -->

<?php
include 'connect_db.php'; // Include the database connection

$query = "SELECT LicenseNumber FROM Trucks WHERE Status IN ('Loading', 'Loaded', 'Unloading')";
$result = $conn->query($query);

echo "<!DOCTYPE html>
<html>
<head>
    <title>Weigh Station - Final Weight</title>
</head>
<body>
    <h1>Weigh Station - Final Weight Entry</h1>
    
    <form action='submit_final_weight.php' method='post'>
        <label for='truck'>Select Truck:</label>
        <select name='license_number' id='truck'>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["LicenseNumber"]."'>".$row["LicenseNumber"]."</option>";
    }
} else {
    echo "<option value=''>No Trucks Available</option>";
}

echo "</select><br>
        Weight: <input type='number' name='final_weight'><br>
        <input type='submit' value='Submit Final Weight'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
