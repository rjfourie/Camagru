<?php
require 'functions.php';
require 'config/setup.php';
session_start();

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit']))
{
    if (!AlreadyExists($_POST['username'])){
        echo "Username already exists";
    }
    else if ($_POST['password'] != $_POST['conpassword']){
        echo "Passwords do not match!";
    }
    else if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])) {
        echo "Passwords must contain numbers and letters";
    }

    $username = $_POST['username'];
    $password = sha1($_POST['password']);
	
    try
    {
        $username = $_POST['username'];
        $sql = $connection->prepare("UPDATE `user_info` SET `username`=?, `password`=? WHERE `user_id`='$user_id'");
        $sql->execute(array($username,$password));
        header("location:camera.php?success=your_details_has_been_updated");
        exit();
    }

    catch(PDOException $e)
    {
        echo $sql . "\n" . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
</head>
	<p><a href="index.php">home</a></p>
<body>
    
    <div>
		<form method="POST">
        
            <input type="text" name="username" placeholder="Username" required>
            <br>

            <input type="password" name="password" placeholder="Password" required>
            <br>
                 
            <input type="password" name="conpassword" placeholder="Confirm Password" required>
            <br>
                
            <input type="submit" name="submit" value="submit">
            
		</form>
	</div>
</body>
</html>