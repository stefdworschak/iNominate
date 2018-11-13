<?php
require("../init.php");
  session_start();
  if($_POST['xssid'] == $_SESSION['xssid']) {
    $c = new DBClass;
    $orgs = $c->checkOrg();
      echo json_encode($orgs);
  } else {
      header('Location:../../index.php');
  }
 ?>
