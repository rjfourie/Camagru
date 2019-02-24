<?php
require 'functions.php';
require 'config/setup.php';
session_start();

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    if (!AlreadyExists($_POST['username'])){
        echo "Username already exists";
    }
    else if ($_POST['password'] != $_POST['conpassword']){
        echo "Passwords do not match!";
    }
    else if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])) {
        echo "Passwords must contain numbers and letters";
    }
    if(isset($_POST['notify'])){
        $notify = 1;
    }
    else
        $notify = 0;
    
        try
        {
            $username = $_POST['username'];
            $sql = $connection->prepare("UPDATE `user_info` SET `username`=?, `email`=?, `password`=?, `notify`=? WHERE `user_id`='$user_id'");
            $sql->execute(array($username,$email,$password,$notify));
            session_destroy();
            header("location:login.php?success=your_details_has_been_updated");
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
	<p><a href="camera.php">home</a></p>
<body> 
    <div>
		<form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <br>
            <input type="email" name="email" placeholder="E-mail"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="example@example.com" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br> 
            <input type="password" name="conpassword" placeholder="Confirm Password" required>
            <br><td>
            Notify<input type="checkbox" name="notify"></td>
            <br>
            <input type="submit" name="submit" value="submit">
		</form>
	</div>
</body>
</html>