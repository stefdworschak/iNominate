<?php

$ENVIROMENT_PATH ="http://localhost/iNominate/";

    class DBSettings {

      var $settings;

      function getSettings(){
          // Variable to decide if development environment is used or production
          // $m = 1     for production
          // $m = 0     for development
          $m = 1;
          $url = ($m < 1 ? '' : parse_url(getenv("CLEARDB_DATABASE_URL")));

          $settings['server'] = ($m < 1 ? 'localhost' : $url["host"]);
          $settings['user'] = ($m < 1 ? 'root' : $url["user"]);
          $settings['pw'] = ($m < 1 ? '' : $url["pass"]);
          $settings['db'] = ($m < 1 ? 'test' : substr($url["path"], 1));

          return $settings;
      }

    }


    /*
    $m = 0;

    $url = ($m < 1 ? '' : parse_url(getenv("CLEARDB_DATABASE_URL")));

    $server = ($m < 1 ? 'localhost' : $url["host"]);
    $user = ($m < 1 ? 'root' : $url["user"]);
    $pw = ($m < 1 ? '' : $url["pass"]);
    $db = ($m < 1 ? 'test' : substr($url["path"], 1));

    $conn_str = new PDO("mysql:host=$server;dbname=$db", $user, $pw);

    echo "Connection Established";

    // Localhost Dev Details

    $dev_server = 'localhost';
    $dev_user = 'root';
    $dev_pw = '';
    $dev_db = 'test';
    */

 ?>
