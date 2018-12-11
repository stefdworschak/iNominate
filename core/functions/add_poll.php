<?php
  require('../init.php');

  if(!empty($_POST)) {
      session_start();
      $c = new DBClass;
      $result = $c->createPoll($_POST, $_SESSION['userid'], $_SESSION['department']);
      header('Location:../../index.php?view=admin_panel');
    } else {
      header('Location:../../index.php?view=create_election?err=db_error');
    }


?>
