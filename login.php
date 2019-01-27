<?php

$error = NULL;

require 'config/setup.php';
session_start();  
 
if(isset($_POST["login"]))  
{
     $username = $_POST['username'];
     $password = sha1($_POST['password']);

     $resultset = $pdo->query("SELECT * FROM user_info WHERE username = '$username' AND password = '$password' LIMIT 1");

     if($resultset->num_rows != 0){
          $row = $resultset->fetch_assoc();
          $verified = $row['verified'];
          $email = $row['email'];

          if($verified == 1){
               echo "Your account is verified and you have now been logged in";
               
          }
          else{
               $error = "This account has not yet been verified. An email was sent to $email to $username";
          }
     }
     else{
          $error = "The username or password you entered is incorrect";
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
		<form method="POST" action="login.php">

			<input type="text" name="username" placeholder="Username">
			<br>

			<input type="password" name="password" placeholder="Password">
			<br>

			<input type="submit" name="login" value="login">
		</form>
		<p>Not registered yet? <a href="register.php">Sign up</a></p>
	</div>
<?php echo $error; ?>
</body>
</html>