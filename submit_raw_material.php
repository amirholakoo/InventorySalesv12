<?php
// submit_raw_material.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $supplier_id = $_POST['supplier_id'];
    $material_name = $_POST['material_name'];
    $material_type = $_POST['material_type'];
    $status = $_POST['status'];
    $comments = $_POST['comments'];

    // SQL to add a raw material
    $sql = "INSERT INTO RawMaterials (SupplierID, MaterialName, MaterialType, Status, Comments)
            VALUES ('$supplier_id', '$material_name', '$material_type', '$status', '$comments')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "New raw material record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
