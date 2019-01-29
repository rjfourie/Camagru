<?php
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    $connection->exec($sql);

    $sql = "USE camagru";
    $connection->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS User_Info (
       `user_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
       `username` VARCHAR(100) NOT NULL,
       `email` VARCHAR(255) NOT NULL,
       `password` VARCHAR(255) NOT NULL,
       `vkey` VARCHAR(255) NOT NULL,
       `verified` INT(1) DEFAULT 0 NOT NULL
       )";

    $connection->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS Password_Reset (
        ResetID INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
        ResetEmail TEXT NOT NULL,
        ResetSelector TEXT NOT NULL,
        ResetToken LONGTEXT NOT NULL,
        ResetExpires TEXT NULL
    )";

    $connection->exec($sql);

?>