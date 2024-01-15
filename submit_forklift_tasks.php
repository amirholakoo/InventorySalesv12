<?php
// submit_forklift_tasks.php

include 'connect_db.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $shipment_id = $_POST['shipment_id'];
    $roll_width = $_POST['roll_width'];

    // Fetching available reels based on the selected width
    $reelsQuery = "SELECT ReelNumber FROM Products WHERE Status = 'In-Stock' AND Width = '$roll_width'";
    $reelsResult = $conn->query($reelsQuery);

    // Start the HTML for the second part of the form
    echo "<form action='update_forklift_tasks.php' method='post'>
            <input type='hidden' name='shipment_id' value='$shipment_id'>";

    // Loop through the reels and add checkboxes
    if ($reelsResult->num_rows > 0) {
        while($row = $reelsResult->fetch_assoc()) {
            echo "<input type='checkbox' name='reel_numbers[]' value='".$row["ReelNumber"]."'> ".$row["ReelNumber"]."<br>";
        }
    } else {
        echo "No Reels Available for the Selected Width";
    }

    echo "<br>Unloading Location (if applicable): <input type='text' name='unloading_location'><br>
          <input type='submit' value='Update Tasks'>
          </form>";

    $conn->close(); // Close the database connection
}
?>
