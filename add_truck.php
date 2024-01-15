<!-- add_truck.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Add Truck</title>
</head>
<body>
    <h1>Add a New Truck</h1>
    <form action="submit_truck.php" method="post">
        License Number: <input type="text" name="license_number"><br>
        Driver Name: <input type="text" name="driver_name"><br>
        Phone: <input type="text" name="phone"><br>
        <input type="submit" value="Add Truck">
    </form>
</body>
</html>
