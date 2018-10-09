<?php
  require('../init.php');

  if(!empty($_POST)) {
    echo "post check<br>";
      //$exist = 0;
      $c = new DBClass;
      $registered = $c->createElection($_POST);
      header('Location:../../index.php?view=admin_panel');
    } else {
      header('Location:../../index.php?view=create_election?err=db_error');
    }


?>
