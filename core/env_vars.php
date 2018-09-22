<?php

    //Heroku Production Details
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $user = $url["user"];
    $pw = $url["pass"];
    $db = substr($url["path"], 1);

    /*
      // Localhost Dev Details

      $server = 'localhost';
      $user = 'root';
      $pw = '';
      $db = 'test';
    */

 ?>
