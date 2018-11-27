<?php
try{
  ob_start();
  require('../init.php');
  echo "required reps<br>";

  if(!empty($_POST)) {
    echo "post check<br>";
      //$exist = 0;
      $c = new DBClass;
      if($_POST['resetPassword1']==$_POST['resetPassword2']){
        $resetPassword = $c->reset($_POST['hiddenUserid'],$_POST['resetPassword2']);
        if($_POST['validate']== "account"){
          header('Location:../../index.php?mode=Acc_Details');
        }else{
        header('Location:../../index.php');
        }
      }elseif(($_POST['resetPassword1']!=$_POST['resetPassword2'])){
        if($_POST['validate']== "account"){
        header('Location:../../index.php?view=Acc_Details&err=change');
      }else{
      header('Location:../../index.php');
      }

      }
      else {
       header('Location:../../index.php?mode=reset&err=reset&userid='.$_POST['hiddenUserid']);
      }
    }
  }

  catch(Exception $e){
      echo 'Message: ' .$e->getMessage();
  }
 ?>
