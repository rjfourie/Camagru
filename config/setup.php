<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '123456';
    $dbname = 'camagru';
    try
    {
        $connection = new PDO("mysql:host=$servername", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        include_once("database.php");
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
?>