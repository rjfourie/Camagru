<?php

require 'config/setup.php';
session_start();

if (isset($_SESSION['username'])) {
    echo '<h3> User: '.$_SESSION['username']. '</h3>';
}
else { 
    header("location:login.php?An-error-occured-logging-in");
}

if (isset($_POST['upload']))
{
    $image = $_FILES['image']['name'];
    $name = $_SESSION['username'];
    $userid = $_SESSION['user_id'];
    try
    {             
        $sql = "INSERT INTO `gallery` (`user_id`, `username`, `img`, `likes`) VALUES ('$userid','$name','$image',0)";
        $connection->exec($sql);
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['save']))
{
    $img = $_POST['image'];
    $name = $_SESSION['username'];
    $userid = $_SESSION['user_id'];
    try
    {             
        $sql = "INSERT INTO `gallery` ( `user_id`, `username`, `img`, `likes`) VALUES ('$userid','$name','$img',0)";
        $connection->exec($sql);
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}

// else {
//     header("location:login.php");
//     echo("An error occurred with logging in");
// }

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
    <p><a href="index.php">Home</a></p>
    <p><a href="gallery.php">Gallery</a></p>
    <p><a href="update.php">Update details</a></p>
    <p><a href="logout.php">Logout</a></p>
    
<form method="POST" enctype="multipart/form-data">
  	<div>
  	  <input type="file" name="image" accept=".jpg,.jpeg,.png,.gif,.bmp,.tif,.tiff">
  	</div>
  	<div>
  		<button type="submit" name="upload">Upload Image</button>
  	</div>
  </form>
    <div>
        <video id="video" width="400" height="300" ></video>
        <button id="capture"> Take Photo</button>
        <canvas id="canvas" width="400" height="300"></canvas>
    </div>
    <form method="POST">
    <div>
        <input type="hidden" name="image" id="img">
        <button type="submit" name="save" id="save">Save Photo</button>
    </div>
    </form>
    <button><img id="WSL" src="stickers/WSL.png" height="100px"></button>
    <button><img id="hundred" src="stickers/hundred.png" height="100px"></button>
    <button><img id="alien" src="stickers/alien.png" height="100px"></button>
    <script src="js/webcam.js">
    </script>
</body>
</html>