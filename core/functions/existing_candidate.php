<?php
  require('../init.php');
  session_start();

  if(!empty($_POST)) {
      $c = new DBClass;
      $election_id = isset($_POST['election_id']) ? $_POST['election_id'] : 0;
      if($election_id == 0) {
          header('Location:../../index.php?err=no_election_specified');
      } else {
        $check=$c->checkCandidateExists($_SESSION['userid']);
        if($check == 0){
          header('Location:../../index.php?view=create_candidate&election_id='.$election_id);
          $_SESSION['existing_candidate']=0;
        } else {
         header('Location:../../index.php?err=already_candidate&failed_id='.$election_id);
        }
      }
  } else {
     header('Location:../../index.php');
  }

 ?>
