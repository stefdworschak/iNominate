<?php
  require('../env_vars.php;');
  require('../functions/connect.php;');

  $c = new DBClass;
  $c->connect();
  $stmt=$c->conn->prepare("ALTER TABLE `users` ADD `password` VARCHAR(100) AFTER `email_address`;");
  $stmt->execute();
  $c->close();

?>
