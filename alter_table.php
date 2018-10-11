<?php
    require('core/env_vars.php');
    require('core/functions/connect.php');
    $c = new DBClass;
    $c->connect();
    //$stmt=$c->conn->prepare("ALTER TABLE `users` ADD `password` VARCHAR(100) AFTER `email_address`;");

    $str = "DROP TABLE `elections`;";
    $stmt=$c->conn->prepare($str);
    $stmt->execute();

    $str = "CREATE TABLE IF NOT EXISTS `elections3` (`id` int(11) NOT NULL AUTO_INCREMENT,";
    $str .= "`title` varchar(50) NOT NULL, ";
    $str .= "`description` tinytext NOT NULL,";
    $str .= "`department` varchar(32) NOT NULL,";
    $str .= "`num_candidates` int(6) NOT NULL,";
    $str .= "`num_roles` int(6) NOT NULL,";
    $str .= "`expiry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,";
    $str .= "`creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,";
    $str .= "PRIMARY KEY(id)";
    $str .= ");";

    $stmt=$c->conn->prepare($str);
    $stmt->execute();
    $c->close();
 ?>
