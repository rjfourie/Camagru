<?php

require 'config/setup.php';

session_start();  
 
if(isset($_POST["login"]))  
{
     $username = $_POST['username'];
     $password = sha1($_POST['password']);

     $sql = "SELECT * FROM user_info WHERE username='$username' AND password='$password'";
     $resultset = $connection->query($sql);

     if(sizeof($resultset) != 0){
          $row = $resultset->fetch(PDO::FETCH_ASSOC);
          $_SESSION['user_id'] = $row['user_id'];
          $verified = $row['verified'];

          if($verified == 1){
               $_SESSION["username"] = $_POST["username"];
               header("location:login-success.php");
               
          }
          else{
                echo "This account has not yet been verified.";
          }
     }
     else{
          echo "The username or password you entered is incorrect";
     }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>
	<p><a href="index.php">home</a></p>
<body>
	<div>
		<form method="POST">

			<input type="text" name="username" placeholder="Username" required>
			<br>

			<input type="password" name="password" placeholder="Password" require>
			<br>

			<input type="submit" name="login" value="login">
		</form>
          <p><a href="forgot-password.php">Forgot password?</a></p>
		<p>Not registered yet?  <a href="register.php">Sign up</a></p>
	</div>
</body>
</html>