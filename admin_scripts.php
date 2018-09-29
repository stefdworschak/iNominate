<?php
  require('core/env_vars.php');
  require('core/functions/connect.php');

  echo "<table style='border: solid 1px black; text-align:center;'>";
  echo "<tr><th>Tables</th></tr>";

  class TableRows extends RecursiveIteratorIterator {
      function __construct($it) {
          parent::__construct($it, self::LEAVES_ONLY);
      }

      function current() {
          return "<td style='max-width:250px;border:1px solid black; overflow:auto;'>" . parent::current(). "</td>";
      }

      function beginChildren() {
          echo "<tr>";
      }

      function endChildren() {
          echo "</tr>" . "\n";
      }
  }

  $c = new DBClass;

  //Alter table
  $c->connect();
  $stmt=$c->conn->prepare("ALTER TABLE `users` ADD `password` VARCHAR(100) AFTER `email_address`;");
  $stmt->execute();

  $c->connect();
  //$stmt=$c->conn->prepare("ALTER TABLE `users` ADD `password` VARCHAR(100) AFTER `email_address`;");
  $stmt=$c->conn->prepare("SHOW TABLES;");
  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
  $c->close();
  echo "</table>";
  echo "<br />";
  echo "<form enctype='multipart/form-data' action='admin_scripts.php' method='POST'><input type='text' placeholder='Enter table name...' name='tbl_name' />";
  echo "<input type='submit' value='search' /> </form>";

  if(!empty($_POST)){

    //Show table schema
    echo "<table style='border: solid 1px black; text-align:center;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    $tbl=$_POST['tbl_name'];
    $c->connect();
    $stmt=$c->conn->prepare("DESCRIBE {$tbl};");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          echo $v;
      }
    echo "</table>";
    echo "<br />";
    //Show first 5 rows as example
    echo "<table style='border: solid 1px black; text-align:center;'>";
  //  echo "<tr><th>id</th><th></th><th>firstname</th><th>last_name</th><th>Default</th><th>Extra</th></tr>";
    $c->connect();
    $stmt=$c->conn->prepare("SELECT * FROM {$tbl} LIMIT 5;");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
          echo $v;
      }
    echo "</table>";

  } else {
    echo "Empty Post";
  }
?>
