<?php
  session_start();
  if($_POST['xssid'] == $_SESSION['xssid']) {
      $orgs =['Accenture','KPMG','Arvato','Deloitte'];
      echo json_encode($orgs);
  } else {
      header('Location:../../index.php');
  }
 ?>
