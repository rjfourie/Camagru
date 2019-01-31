<?php

require 'config/setup.php';

if (isset($_POST['password-reset'])) {
    $email = $_POST['email'];
    $stmt = "SELECT * FROM user_info WHERE email='$email'";
    $result = $connection->query($stmt);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $vkey = $row['vkey'];


    
    $subject = "Email verification";
    $message = "<a href='http://localhost:8080/camagru/create-newpassword.php?vkey=$vkey'>Reset Password</a>";
    $headers = "From: Camagru@rfourie.co.za \r\n";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    if(mail("$email", "$subject", "$message", "$headers")){
        echo "An email has been sent to your email with a reset link";
    }
    else {
        echo "Email doesn't exist in our database";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
</head>
	<p><a href="index.php">home</a></p>
<body>
	<div>
		<form method="POST">

			<input type="email" name="email" placeholder="Enter e-mail" required>
			<br>

			<input type="submit" name="password-reset" value="Reset Password">
        </form>
	</div>
</body>
</html>