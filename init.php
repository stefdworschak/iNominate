<?php



    //Heroku Production Details

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    /*
      // Localhost Dev Details

      $server = 'localhost';
      $user = 'root';
      $pw = 'root';

      $conn = new mysqli($server, $user);
    */


    $conn = new mysqli($server, $username, $password, $db);

    if($conn->connect_error){
      die('Connection failed ' . $conn->connect_error);
    }

    echo "Connection established successfully!";

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(32) NOT NULL,
        last_name VARCHAR(32) NOT NULL,
        email_address VARCHAR(50) NOT NULL,
        user_type VARCHAR(32) NOT NULL,
        registration_date TIMESTAMP
    );"

    if($conn->query($sql) === TRUE){
      echo "Table created successfully!";
    } else {
      die('Error in SQL Syntax ' . $conn->connect_error);
    }


 ?>
