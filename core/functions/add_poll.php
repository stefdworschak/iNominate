<?php
  require('../init.php');

  if(!empty($_POST)) {
      $c = new DBClass;
      $result = $c->createPoll($_POST);
      header('Location:../../index.php?view=admin_panel');
    } else {
      header('Location:../../index.php?view=create_election?err=db_error');
    }


?>
