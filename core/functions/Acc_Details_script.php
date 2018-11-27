<?php
try{
  ob_start();
  session_start();
  require('../init.php');
  echo "required reps<br>";

  if(!empty($_POST)) {
    echo "post check<br>";
      //$exist = 0;
      $c = new DBClass;
      print_r(isset($_POST['e_mail']));
      if(isset($_POST['firstname'])){
        echo $_SESSION['userid'];
        $updatefirst = $c->updatename($_SESSION['userid'],$_POST['firstname'],$_POST['lastname']);
        if($updatefirst == true){
          $_SESSION['first_name']= $_POST['firstname'];
          $_SESSION['last_name']= $_POST['lastname'];
          header('Location:../../index.php?view=Acc_Details');
        }
      }
      elseif(isset($_POST['e_mail'])){
        echo $_SESSION['userid'];
        $updateEmail = $c->updatemail($_SESSION['userid'],$_POST['e_mail']);
        if($updateEmail == true){
          $_SESSION['email_address']= $_POST['e_mail'];
        header('Location:../../index.php?view=Acc_Details');
      }
    }
      else {
      //header('Location:../../index.php?mode=reset&err=reset&userid='.$_POST['hiddenUserid']);
      }
    }
  }

  catch(Exception $e){
      echo 'Message: ' .$e->getMessage();
  }
 ?>
