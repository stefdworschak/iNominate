<?php
  require('../init.php');

  if(!empty($_POST)) {
    echo "post check<br>";
      //$exist = 0;
      $c = new DBClass;
      $result = $c->createElection($_POST);
      echo $result;
      header('Location:../../index.php?view=admin_panel');
    } else {
      header('Location:../../index.php?view=create_election?err=db_error');
    }


?>
