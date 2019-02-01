<?php
require 'functions.php';
require 'config/setup.php';
session_start();

$user_id = $_SESSION['user_id'];
echo($user_id);
if(isset($_POST['submit']))
{
    {
        try
        {
            $username = $_POST['username'];
            $sql = $connection->prepare("UPDATE `user_info` SET `username`='$username' WHERE `user_id`='$user_id'");
            $sql->execute();
            header("location:login-success.php?success=your_username_has_been_updated");
            exit();
        }

        catch(PDOException $e)
        {
            echo $sql . "\n" . $e->getMessage();
        }
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
                
            <input type="submit" name="submit" value="submit">
            
		</form>
	</div>
</body>
</html>