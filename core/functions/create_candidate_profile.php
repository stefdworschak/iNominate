<?php
  require('../init.php');
  session_start();

  if(!empty($_POST)) {
    $c = new DBClass();
    $result = $c->createCandidateProfile($_POST);
    if($result != 0){
      $_SESSION['my_election']=$_POST['election_id'];
      header('Location:../../index.php?candidate_reg_success=true');
    } else {
        header('Location:../../index.php?err=candidate_reg_err');
    }

  } else {
    header('Location:../../index.php');
  }
?>
