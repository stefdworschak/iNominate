<?php
    require('core/env_vars.php');
    require('core/functions/connect.php');

    try {
      $query=$_POST['query'];
      $c = new DBClass;
      $c->connect();
      $tbl3 = "DROP TABLE `inbox`;";
      $stmt2=$c->conn->prepare($query);
      $stmt2->execute();
      $nums=$stmt2->rowCount();
      $c->close();
      echo $nums . ' rows were affected.';
    } catch(Exception $e){
      echo $e;
    }

 ?>
