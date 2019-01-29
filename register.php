<?php
    $error = NULL;
    session_start();
	require 'config/setup.php';

	if(isset($_POST['submit']))
	{
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $vkey = md5(time().$username);
        
        $check = $connection->prepare("SELECT `email` FROM `user_info` WHERE `email`=?");
		$check->bindValue(1, $email);
		$check->execute();

        if (strlen($username) < 3){
            echo "Username must be atleast 3 characters";
        }
        else if ($_POST['password'] != $_POST['conpassword']){
            echo "Passwords do not match!";
        }
        //else if(!preg_match('/(?=.*?[0-9])(?=.*?[A-Za-z])(?=.*[^0-9A-Za-z]).+', $password)) { 
        //    echo "Password must contain:<br>
        //    - At least one number<br>
        //    - At least one letter";
        //}
        else if($check->rowCount() > 0){
            echo "E-mail already in use";
        }
        else
        {
            try
            {
                $connection->beginTransaction();
                $sql = "INSERT INTO user_info (username, email, password, vkey) VALUES ('$username','$email','$password', '$vkey');";
                if($sql){
                    echo "An email verification has been sent to your email";
                }
                $connection->exec($sql);

                //send mail
                $subject = "Email verification";
                $message = "<a href='http://localhost:8080/camagru/verify-email.php?vkey=$vkey'>Register Account</a>";
                $headers = "From: Camagru@rfourie.co.za \r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                mail("$email", "$subject", "$message", "$headers");

                //header('location:login.php');

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
            
            <input type="email" name="email" placeholder="E-mail" required>
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
<?php
echo $error
?>
</html>