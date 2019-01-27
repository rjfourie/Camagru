<?php
include 'config/setup.php';
if(isset($_GET['vkey'])){
    $vkey = $_GET['vkey'];

    $resultset = $pdo->query("SELECT verified,vkey FROM user_info WHERE verified  = 0 AND vkey = '$vkey' LIMIT 1");

    if($resultset->num_rows == 1){
        $update = $pdo->query("UPDATE user_info SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
        
        if($update){
            echo "Your account has been verified. You may now login";
        }
        else{
            echo $pdo->error;
        }
    }
    else{
        echo "This account is invalid or already verified";
    }   
}
else{
    die("Something went wrong");
}
?>