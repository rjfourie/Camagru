<?php
   $sql = "CREATE DATABASE IF NOT EXISTS camagru";
   $connection->exec($sql);

   $sql = "USE camagru";
   $connection->exec($sql);

   $sql = "CREATE TABLE IF NOT EXISTS user_info (
      `user_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      `username` VARCHAR(100) NOT NULL,
      `email` VARCHAR(255) NOT NULL,
      `password` VARCHAR(255) NOT NULL,
      `vkey` VARCHAR(255) NOT NULL,
      `verified` INT(1) DEFAULT 0 NOT NULL
      )";

   $connection->exec($sql);

   $sql = "CREATE TABLE IF NOT EXISTS gallery (
      `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
      `user_id` INT(100),
      `username` VARCHAR(255),
      `img` LONGTEXT,
      `likes` INT(11) DEFAULT 0
      )";
 
   $connection->exec($sql);

   $sql = "CREATE TABLE IF NOT EXISTS comments (
      `c_id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
      `img_id` INT(11) NOT NULL,
      `comment` VARCHAR(255) DEFAULT NULL
      )";

   $connection->exec($sql);
?>