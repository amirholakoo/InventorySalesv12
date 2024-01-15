<!-- add_raw_material.php -->

<?php
include 'connect_db.php'; // Include the database connection

// Fetching supplier names from the database
$query = "SELECT SupplierID, Name FROM Suppliers";
$result = $conn->query($query);

// Start the HTML
echo "<!DOCTYPE html>
<html>
<head>
    <title>Add Raw Material</title>
</head>
<body>
    <h1>Add Raw Material Entry</h1>
    
    <form action='submit_raw_material.php' method='post'>
        <label for='supplier'>Supplier:</label>
        <select name='supplier_id' id='supplier'>";

// Loop through the suppliers and add them to the dropdown
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["SupplierID"]."'>".$row["Name"]."</option>";
    }
} else {
    echo "<option value=''>No Suppliers Found</option>";
}

echo "</select><br>
        Material Name: <input type='text' name='material_name'><br>
        Material Type: <input type='text' name='material_type'><br>
        Status: <input type='text' name='status'><br>
        Comments: <textarea name='comments'></textarea><br>
        <input type='submit' value='Add Raw Material'>
    </form>
</body>
</html>";

$conn->close(); // Close the database connection
?>
