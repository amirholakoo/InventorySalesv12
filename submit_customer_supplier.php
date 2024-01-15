<?php
// submit_customer_supplier.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's the customer form or the supplier form
    if ($_POST['form_type'] == 'customer') {
        // Collect value of customer input fields
        $name = $_POST['customer_name'];
        $address = $_POST['customer_address'];
        $phone = $_POST['customer_phone'];

        // SQL to add a customer
        $sql = "INSERT INTO Customers (Name, DeliveryAddress, Phone) VALUES ('$name', '$address', '$phone')";

    } elseif ($_POST['form_type'] == 'supplier') {
        // Collect value of supplier input fields
        $name = $_POST['supplier_name'];
        $address = $_POST['supplier_address'];
        $phone = $_POST['supplier_phone'];

        // SQL to add a supplier
        $sql = "INSERT INTO Suppliers (Name, DeliveryAddress, Phone) VALUES ('$name', '$address', '$phone')";
    }

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
