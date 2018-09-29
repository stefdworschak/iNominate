<?php


  echo "working";
  try{
    require('core/env_vars.php');
    require('core/functions/connect.php');
    echo "required reps";
    /*
    if(!empty($_POST)) {
        $c = new DBClass;
        $exists = $c->checkExists($_POST['emailaddress']);
        if ($exists) {
          echo "Already Exists";
          header('Location:../../index.php?mode=register&err=user_exists');
        } else if($_POST['password'] !== $_POST['password1']){
          echo "Passwords not matching";
          header('Location:../../index.php?mode=register&err=passwords_not_matching');
        } else {
          $registered = $c->register($_POST);
          $user_data = fetchUserData($_POST['emailaddress']);

          session_start();
          $_SESSION['userid'] = $user_data['id'];
          $_SESSION['first_name'] = $user_data['first_name'];
          $_SESSION['last_name'] = $user_data['last_name'];
          $_SESSION['email_address'] = $user_data['email_address'];
          header('Location:../../index.php');
        }
      } else {
        header('Location:index.php');
      }
      */
    } catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }



?>
