<?php
  require('auxilary.php');
  $_SESSION['xssid'] = random_str(20);
  //echo "<script>console.log('" .$_SESSION['xssid'] ."');</script>";

 ?>
