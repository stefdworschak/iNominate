<?php

    // Variable to decide if development environment is used or production
    // $m = 1     for production
    // $m = 0     for development

    $m = 1;

    $url = ($m < 0 ? '' : parse_url(getenv("CLEARDB_DATABASE_URL")));
    
    $server = ($m < 1 ? 'localhost' : $url["host"]);
    $user = ($m < 1 ? 'root' : $url["user"]);
    $pw = ($m < 1 ? '' : $url["pass"]);
    $db = ($m < 1 ? 'test' : substr($url["path"], 1));

    $conn_str = new PDO("mysql:host=$server;dbname=$db", $user, $pw);

    echo "Connection Established";

    // Localhost Dev Details
    /*
    $dev_server = 'localhost';
    $dev_user = 'root';
    $dev_pw = '';
    $dev_db = 'test';

    //For live env
    //$conn_str = new PDO("mysql:host=$server;dbname=$db", $user, $pw);

    //For dev env
    $conn_str = new PDO("mysql:host=$dev_server;dbname=$dev_db", $dev_user, $dev_pw);
    */

 ?>
