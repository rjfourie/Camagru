<?php

if (isset($_POST['password-reset'])) {
    $selector = bin2hex(random_bytes(8));
    $token =  random_bytes(32);

    $url = "http://localhost:8080/camagru/reset-password?selector=?" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;
}
else {
    header("location:index.php");
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