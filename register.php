<?php
    session_start();
	require 'config/setup.php';

	if(isset($_POST['submit']))
	{
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $vkey = md5(time().$username);
        
        $check = $connection->prepare("SELECT `email` FROM `user_info` WHERE `email`=?");
		$check->bindValue(1, $email);
		$check->execute();

        if (strlen($username) < 5){
            header("Location:register.php?err=" . urlencode("Username must be atleast 5 characters"));
            exit();
        }
        else if ($_POST['password'] != $_POST['conpassword']){
            header("Location:register.php?err=" . urlencode("Passwords do not match!"));
            exit();
        }
        else if($check->rowCount() > 0){
            header("Location:register.php?err=" . urlencode("E-mail already in use"));
            exit();
        }
        else
        {
            try
            {
                $connection->beginTransaction();
                $sql = "INSERT INTO user_info (username, email, password, vkey, verified) VALUES ('$username','$email','$password', '$vkey', 0);";
                $connection->exec($sql);

                //send mail
                $subject = "Email verification";
                $message = "<a href='http://localhost/camagru/verify-email.php?vkey=$vkey'>Register Email";
                $header = "From: Camagru";
                
                mail("$email", "Verify Camagru account", "$message", "$header");

                header('location:register.php');

                $connection->commit();
    
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
		<form method="POST" action="register.php">
        
            <input type="text" name="username" placeholder="Username" required>
            <br>
            
            <input type="text" name="email" placeholder="E-mail" required>
            <br>
                 
            <input type="password" name="password" placeholder="Password" required>
            <br>
                 
            <input type="password" name="conpassword" placeholder="Confirm Password" required>
            <br>
                
            <input type="submit" name="submit" value="submit">
            
		</form>
        <p>Already have an account? <a href="login.php">Login</a></p>
	</div>
</body>
</html>