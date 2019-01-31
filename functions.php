<?php

function AlreadyExists($user){
    $email = "SELECT * FROM user_info WHERE email='$user'";
    $username = "SELECT * FROM user_info WHERE username='$user'";
    global $connection;

    $checkemail = $connection->query($email);
    $checkuser = $connection->query($username);

    if ($checkemail->rowCount() > 0 || $checkuser->rowCount() > 0){
        return false;
    }
    else {
        return true;
    }
}