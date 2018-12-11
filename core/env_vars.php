<?php
// $DEPLOYED = 1     for production
// $DEPLOYED = 0     for development
//$ENVIROMENT_PATH ="http://localhost/iNominate/";
$EMAIL_VAR = 1;
//print_r($ENVIROMENT_PATH);
//$EMAIL_VAR = 1;
$ENVIROMENT_PATH ="http://inominate-2018.herokuapp.com/";

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

 ?>
