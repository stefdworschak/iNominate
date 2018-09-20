<?php



    //Heroku Production Details

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $conn = new mysqli($server, $username, $password, $db);


/*
  $server = 'localhost';
  $user = 'root';
  $pw = 'root';

  $conn = new mysqli($server, $user);
*/
  if($conn->connect_error){
    die('Connection failed' . $conn->connect_error);
  }

  echo "Connection established successfully!";

 ?>
