<?php 
$error = NULL;
if(isset($_POST['submit'])){
	//Connect to the database 
	$mysqli = NEW MySQLi ('localhost', 'root','','test');
	
	//Get form data
	 $username = $mysqli->real_escape_string ($_POST['username']); 
	 $password = $mysqli->real_escape_string ($_POST['password']); 
	 $password = md5 ($password);
	
	 //query the database 
	$resultSet = $mysqli->query("SELECT * FROM user_info WHERE username = '$username' AND password = '$password' LIMIT 1");
	if ($resultSet->num_rows !=0) {
		//Process Login
		 $row = $resultSet->fetch_assoc(); 
		 $verified = $row['verified'];
		 $email = $row['email'];
		
		 if ($verified == 1) {
			//Continue Processing
			echo "Your account is verified you have been logged in";
		 }
		 else{ 
			 echo "This account is not yet been verified";
		 }
	}
	else{
	//Invalid credentials
 	$error = "The username or password you entered is incorrect";
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

			<input type="submit" value="Login">
		</form>
		<p>Not registered yet? <a href="register.php">Sign up</a></p>
	</div>
</body>
</html>