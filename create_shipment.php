<!-- create_shipment.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching trucks with status 'Ready'
$query = "SELECT LicenseNumber FROM Trucks WHERE Status = 'Ready'";
$result = $conn->query($query);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Create Shipment</title>
</head>
<body>
    <h1>Create Shipment</h1>
    
    <form action='submit_shipment.php' method='post'>
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
        Shipment Type: 
        <input type='radio' id='incoming' name='shipment_type' value='Incoming'>
        <label for='incoming'>Incoming</label>
        <input type='radio' id='outgoing' name='shipment_type' value='Outgoing'>
        <label for='outgoing'>Outgoing</label><br>
        <input type='submit' value='Create Shipment'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
