<?php

  try{
    session_start();
    require('../init.php');
    echo "required reps<br>";

    if(!empty($_POST)) {
        $c = new DBClass;
        $userid = $_SESSION['userid'];
        $votes = $c->enterVote($_POST, $userid);
        if($votes == 0){
          header('Location:../../index.php?view=elections&err=no_insert');
        } else {

          header('Location:../../index.php?view=elections&err=vote_success');
        }
      } else {
        header('Location:../../index.php?view=elections&err=vote_success');
      }
    } catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }

?>
