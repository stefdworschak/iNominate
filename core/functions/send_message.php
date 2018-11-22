<?php
    try{
      ob_start();
      session_start();
      require('../init.php');

      // Check if actually something has been posted and the xssid has been sent
      if(!empty($_POST) && $_SESSION['xssid'] == $_POST['xssid']) {

          //Check if the subject and message fields were filled in otherwise give an error message
          if(empty($_POST['subject']) || empty($_POST['message'])) {
              header('Location:../../index.php?view=profile&id=' . $_POST['to_id'] . '&send=missing_fields');
          //Otherwise add the message
          } else {
            $c = new DBClass;
            $result=$c->sendMessage($_POST['from_id'], $_POST['to_id'], $_POST['subject'], $_POST['message'], $_POST['thread_id']);
            if($result == true){
                header('Location:../../index.php?view=profile&id=' . $_POST['to_id'] . '&send=success');
            } else {
               header('Location:../../index.php?view=profile&id=' . $_POST['to_id'] . '&send=error');
            }
          }

      } else {
        header('Location:index.php?view=all_candidates');
      }
    } catch(Exception $e){
        print_r($e);
    }


?>
