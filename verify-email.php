<?php
require 'config/setup.php';

if(isset($_GET['vkey'])){
    $vkey = $_GET['vkey'];

    $resultset = $connection->query("SELECT verified,vkey FROM user_info WHERE verified  = 0 AND vkey = '$vkey' LIMIT 1");

    if(sizeof($resultset) == 1){
        $update = $connection->query("UPDATE user_info SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");
        
        if($update){
            header("Location:login.php?success=you_may_login");
        }
        else{
            echo $connection->error;
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