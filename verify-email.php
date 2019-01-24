<?php
include 'config/setup.php';
if(isset($_GET['vkey'])){
    //Process Verification
    $vkey = $_GET['vkey'];
    $query = "update user_info set status='1' where vkey='$vkey'";

    if($pdo->query($query)){
        header("Location:login.php?err=Your account has been activated!");
        exit();
    }
    else{
        echo "This account is invalid or already verified";
    }   
}
?>