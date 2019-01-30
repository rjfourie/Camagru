<?php

require 'config/setup.php';

session_start();

if(isset($_GET['vkey'])){
    $_SESSION['vkey'] = $_GET['vkey'];
}

$vkey = $_SESSION['vkey'];

if(isset($_POST['submit']))
{
    if ($_POST['password'] != $_POST['conpassword']){
        echo "Passwords do not match!";
    }
    else if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $_POST['password'])) {
        echo "Passwords must contain numbers and letters";
    }
    else
    {
        try
        {
            $password = sha1($_POST['password']);
            $sql = "UPDATE `user_info` SET `password`=`$password` WHERE `vkey`='$vkey'";
            $connection->exec($sql);
            header("location:index.php?success=your_password_has_been_updated");

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
    <title>Create New Password</title>
</head>
<body>
<p>Create New Password</p>
    <div>
		<form method="POST">
        
            <input type="password" name="password" placeholder="Password" required>
            <br>
                 
            <input type="password" name="conpassword" placeholder="Confirm Password" required>
            <br>
                
            <input type="submit" name="submit" value="submit">
            
		</form>
	</div>
</body>
</html>