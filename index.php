
<?php
    session_start();
    require('core/init.php');
    // To secure from cross-site scripting
    require('core/functions/xss_init.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php echo "<script> var xssid='" . $_SESSION['xssid'] . "'; </script>"; ?>
    <?php
        require_once('core/css/library.php');
        require_once('core/js/library.php');
    ?>
<title>
    iNominate - Your secure Election portal
</title>
</head>
<body>
    <?php

      if(isset($_SESSION['userid'])) {
          include('core/views/loggedin.php');
      } else {
          $mode = isset($_GET['mode']) ? $_GET['mode'] : 'login';
          //echo $mode;
          if($mode == 'register') {
              include('core/views/register.php');
          } else if($mode == 'login') {
              include('core/views/login.php');
          } else {
              include('core/views/login.php');
          }

      }
    ?>
</body>
</html>
