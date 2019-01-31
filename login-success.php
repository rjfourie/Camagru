<?php

session_start();

if (isset($_SESSION['username'])) {
    echo '<h3> Login Success, Welcome - '.$_SESSION['username']. '</h3>';
}
else {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Camagru</title>
</head>
<body>
    <p><a href="change-username.php">Change username</a></p>
    <p><a href="logout.php">Logout</a></p>
    
</body>
</html>