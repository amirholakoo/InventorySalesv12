<!-- add_roll.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Add Roll</title>
</head>
<body>
    <h1>Add Roll</h1>
    
    <form action="submit_roll.php" method="post">
        Reel Number: <input type="text" name="reel_number"><br>
        GSM: <input type="number" name="gsm"><br>
        Width: <input type="number" name="width"><br>
        Length: <input type="number" name="length"><br>
        Grade: <input type="text" name="grade"><br>
        Breaks: <input type="text" name="breaks"><br>
        Comments: <textarea name="comments"></textarea><br>
        <input type="submit" value="Add Roll">
    </form>
</body>
</html>
