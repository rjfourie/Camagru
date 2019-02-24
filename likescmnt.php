<?php

    require 'config/setup.php';
    // INSERT INTO `comments`(`c_id`, `img_id`, `comment`) VALUES (1,8,'hello world')
    if(empty($_REQUEST['cmnt'])){
        try
        {
            $id = $_REQUEST['id'];
            $sql = "UPDATE `gallery` SET `likes`=likes + 1 WHERE `id`=". $id;
            $resultset = $connection->query($sql);
            exit();
        }

        catch(PDOException $e)
        {
            echo $sql . "\n" . $e->getMessage();
        }
    }else{
        try
        {
            $id = $_REQUEST['id'];
            // $id = 122;
            $cmnt = $_REQUEST['cmnt'];
            // $sql = "INSERT INTO `comments`(`img_id`, `comment`) VALUES (". $id .",'". $cmnt ."')";
            $sql = "INSERT INTO comments (img_id, comment) VALUES ('$id','$cmnt');";          
            $resultset = $connection->query($sql);
            var_dump($_REQUEST);
            exit();
        }

        catch(PDOException $e)
        {
            echo $sql . "\n" . $e->getMessage();
        }
        
    }
?>