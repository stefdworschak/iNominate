<?php

  try{
    session_start();
    require('../init.php');
    echo "required reps<br>";

    if(!empty($_POST)) {
        $c = new DBClass;
        $candidate_id = $_POST['candidate_id'];
        $election_id = $_POST['election_id'];
        $userid = $_SESSION['userid'];
        $vote = $c->enterVote($candidate_id, $election_id, $userid);
        if($vote == 0){
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
