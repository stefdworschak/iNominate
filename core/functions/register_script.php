<?php

  echo "working<br>";
  try{
    ob_start();
    require('../init.php');
    echo "required reps<br>";

    if(!empty($_POST)) {
      echo "post check<br>";
        //$exist = 0;
        $c = new DBClass;
        $exists = $c->checkExists($_POST['emailaddress']);
        echo "check_exists works";
        if ($exists) {
          echo "Already Exists";
          header('Location:../../index.php?mode=register&err=user_exists');
        } else if($_POST['password'] !== $_POST['password1']){
          echo "Passwords not matching";
          header('Location:../../index.php?mode=register&err=passwords_not_matching');
        }
         else {
          $registered = $c->register($_POST);
          $user_data = $c->fetchUserData($_POST['emailaddress']);
          session_start();
          $_SESSION['userid'] = $user_data['id'];
          $_SESSION['first_name'] = $user_data['first_name'];
          $_SESSION['last_name'] = $user_data['last_name'];
          $_SESSION['email_address'] = $user_data['email_address'];
          $_SESSION['user_type'] = $user_data['user_type'];
          $_SESSION['org'] = $user_data['org'];
          $_SESSION['img_link'] = $user_data['img_link'];
          header('Location:../../index.php');
          }
        } else {
        header('Location:../../index.php');
      }

    } catch(Exception $e){
        echo 'Message: ' .$e->getMessage();
    }

?>
