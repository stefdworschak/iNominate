<?php
  require('../init.php');

  if(!empty($_POST)) {
      session_start();
      $c = new DBClass;
      $result = $c->answerPoll($_POST, $_SESSION['userid']);
      if($result == 0){
        header('Location:../../index.php?view=answer_poll?err=no_insert');
      }
      header('Location:../../index.php?view=elections');
    } else {
      header('Location:../../index.php?view=answer_poll?err=db_error');
    }


?>
