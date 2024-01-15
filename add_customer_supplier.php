<!-- add_customer_supplier.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer and Supplier</title>
</head>
<body>
    <h1>Add Customer and Supplier</h1>
    
    <!-- Customer Form Section -->
    <h2>Add Customer</h2>
    <form action="submit_customer_supplier.php" method="post">
        Name: <input type="text" name="customer_name"><br>
        Delivery Address: <input type="text" name="customer_address"><br>
        Phone: <input type="text" name="customer_phone"><br>
        <input type="hidden" name="form_type" value="customer">
        <input type="submit" value="Add Customer">
    </form>

    <br><hr><br>

    <!-- Supplier Form Section -->
    <h2>Add Supplier</h2>
    <form action="submit_customer_supplier.php" method="post">
        Name: <input type="text" name="supplier_name"><br>
        Delivery Address: <input type="text" name="supplier_address"><br>
        Phone: <input type="text" name="supplier_phone"><br>
        <input type="hidden" name="form_type" value="supplier">
        <input type="submit" value="Add Supplier">
    </form>
</body>
</html>
