<?php
  require('../init.php');

  if(!empty($_POST)) {
      session_start();
      $c = new DBClass;
      $result = $c->createPoll($_POST, $_SESSION['userid'], $_SESSION['department']);
          //$c->emailPoll($_POST['poll_id'], $_SESSION['department']);
          header('Location:../../index.php');

    } else {
      header('Location:../../index.php?view=create_election?err=db_error');
    }


?>
