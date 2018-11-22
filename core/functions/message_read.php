<?php

  try{

      session_start();
      ob_start();
      require('../init.php');
      if(!empty($_POST) && $_SESSION['xssid'] == $_POST['xssid']) {
          $result=$c->messageRead($_POST['message_id'], $_SESSION['userid']);
          echo $result == true ? true : false;
      } else {
        header("Location:../../index.php");
      }

  } catch(Exception $e){
    print_r($e);
  }

?>
