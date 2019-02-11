<?php

require 'config/setup.php';
session_start();

if (isset($_POST['save']))
{
    $img = $_POST['image'];
    $name = $_SESSION['username'];
    $userid = $_SESSION['user_id'];
    try
    {
        echo "try ";              
        $sql = "INSERT INTO `gallery` ( `user_id`, `username`, `img`, `likes`) VALUES ('$userid','$name','$img',NULL)";
        $connection->exec($sql);
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Camera</title>
</head>
<body>
    <p><a href="index.php">Back</a></p>
    <form method="post">
    <div>
        <input type="hidden" name="image" id="img">
        <button type="submit" name="save" id="save">Save Photo</button>
    </div>
</form>
    <div class="booth">
        <video id="video" width="400" height="300" ></video>
        <button id="capture"> Take Photo</button>
        <canvas id="canvas" width="400" height="300"></canvas>
    </div>
        <script src="js/webcam.js"></script>
</body>
</html>