<?php
// update_outgoing_shipment.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['outgoing_shipment_id'];
    $roll_width = $_POST['roll_width'];

    // Fetching rolls based on selected width
    $rollsQuery = "SELECT ReelNumber FROM Products WHERE Width = '$roll_width' AND Status = 'In-Stock'";
    $rollsResult = $conn->query($rollsQuery);

    // Start the HTML for selecting rolls
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Select Rolls for Outgoing Shipment</title>
    </head>
    <body>
        <h1>Select Rolls for Outgoing Shipment</h1>
        
        <form action='finalize_outgoing_shipment.php' method='post'>
            <input type='hidden' name='shipment_id' value='$shipment_id'>";

    // Loop through the rolls and add checkboxes
    if ($rollsResult->num_rows > 0) {
        while($row = $rollsResult->fetch_assoc()) {
            echo "<input type='checkbox' name='selected_rolls[]' value='".$row["ReelNumber"]."'>".$row["ReelNumber"]."<br>";
        }
    } else {
        echo "No Rolls Available for the Selected Width";
    }

    echo "<br><input type='submit' value='Finalize Outgoing Shipment'>
        </form>
    </body>
    </html>";

    $conn->close(); // Close the database connection
}
?>
