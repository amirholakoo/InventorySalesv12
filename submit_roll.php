<?php
// submit_roll.php

include 'connect_db.php'; // Include the database connection
include 'phpqrcode/qrlib.php'; // Include the phpqrcode library

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect value of input fields
    $reel_number = $_POST['reel_number'];
    $gsm = $_POST['gsm'];
    $width = $_POST['width'];
    $length = $_POST['length'];
    $grade = $_POST['grade'];
    $breaks = $_POST['breaks'];
    $comments = $_POST['comments'];

    // SQL to add a roll
    $sql = "INSERT INTO Products (ReelNumber, GSM, Width, Length, Grade, Breaks, Comments, Location, Status)
            VALUES ('$reel_number', '$gsm', '$width', '$length', '$grade', '$breaks', '$comments', 'Production', 'In-Stock')";

    // Execute the query and check for errors
    if ($conn->query($sql) === TRUE) {
        echo "New roll added successfully. <br>";

        // Generate QR Code
        $qrCodeData = "Reel Number: $reel_number, GSM: $gsm, Width: $width, Length: $length, Grade: $grade";
        $qrCodeFile = 'qrcodes/'.$reel_number.'.png';
        QRcode::png($qrCodeData, $qrCodeFile);

        echo "QR Code for Reel Number $reel_number: <br>";
        echo "<img src='$qrCodeFile' alt='QR Code'/>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Close the database connection
}
?>
