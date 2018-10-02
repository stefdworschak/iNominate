
<?php
    session_start();
    require('core/init.php');
    //echo "Hello, World 2018!";
?>
<html>
<head>
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
