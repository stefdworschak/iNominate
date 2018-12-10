<?php
  print_r($_POST);

  if(!empty($_POST)) {
    require('../init.php');
    session_start();
    $c=new DBClass;

    $votes=$c->calculateResults($_POST['election_id']);
    if($votes == null){
      header('Location:../../index.php?view=admin_panel&err=no_winners');
    } else {
      $notified=$c->notifyVoters($_POST['election_id'],$votes);
      //sleep(1);
      if($notified == 0){
        header('Location:../../index.php?view=admin_panel&err=notify_error');
      } else {
        $closed=$c->closeElection($_POST['election_id']);
        if($closed == 0){
            header('Location:../../index.php?view=admin_panel&err=close_error');
        } else{
        header('Location:../../index.php?view=admin_panel&err=success');
        }
      }
    }

  } else {
    header('Location:../../index.php');
  }



 ?>
