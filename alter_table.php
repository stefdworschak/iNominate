<?php
    require('core/env_vars.php');
    require('core/functions/connect.php');
    $c = new DBClass;
    $c->connect();
    //$stmt=$c->conn->prepare("ALTER TABLE `users` ADD `password` VARCHAR(100) AFTER `email_address`;");
    $stmt=$c->conn->prepare("ALTER TABLE `users` ADD `img_link` AFTER `user_type`;");
    $stmt->execute();
    $c->close();
 ?>
