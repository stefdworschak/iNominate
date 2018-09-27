<?php

  try{
    // Using PDO to connect is the most secure solution
    //$conn=new PDO("mysql:host=$server;dbname=$db", $user, $pw);
    $conn=$conn_str;
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$conn->exec($sql);
    //echo "Connection Established successfully";

    //$conn->close();

  } catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
/*
class inSQL
{
      function connect(){
          try{
            // Using PDO to connect is the most secure solution
            $conn=new PDO("mysql:host=$server;dbname=$db", $user, $pw);

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$conn->exec($sql);
            //echo "Connection Established successfully";

          } catch(PDOException $e)
            {
            echo $e->getMessage();
            }
      }

}

*/

/*
      $conn = new mysqli($server, $user, $pw, $db);

      if($conn->connect_error){
          die('Connection failed ' . $conn->connect_error);
      }

    echo "Connection established successfully!";
*/
    /*$sql = "CREATE TABLE IF NOT EXISTS `users` (
        `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `first_name` VARCHAR(32) NOT NULL,
        `last_name` VARCHAR(32) NOT NULL,
        `email_address` VARCHAR(50) NOT NULL,
        `user_type` VARCHAR(32) NOT NULL,
        `registration_date` TIMESTAMP,
        `active` BOOLEAN
    );";
    //$sql = 'CREATE DATABASE inominate;';
    */
/*
    $sql = "INSERT INTO `users` (`firstname`,`last_name`,`email_address`,`user_type`,`registration_date`,`active`) VALUES ()"

    if($conn->query($sql) === TRUE){
      echo "DB created successfully!";
    } else {
      die('Error in SQL Syntax ' . $conn->connect_error);
    }
*/


?>
