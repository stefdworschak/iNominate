<?php
//require('core/env_vars.php');
//require('create_hash.php');

function createHash($pwd) {
  echo("before options<br>");
  $options = [
      'cost' => 11,
      'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
  ];
  //echo password_hash("Password1", PASSWORD_BCRYPT, $options);
    echo("after options<br>");
  $hash = password_hash($pwd, PASSWORD_BCRYPT, $options);
    echo("after hash options<br>");
    return $hash;
}

class DBClass extends DBSettings
{
    var $conn;

    function connect(){
        $settings = DBSettings::getSettings();

        $server = $settings['server'];
        $user = $settings['user'];
        $pw = $settings['pw'];
        $db = $settings['db'];

        $this->conn = new PDO("mysql:host=$server;dbname=$db", $user, $pw);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //  echo "Connected successfully.\n\r";
    }

    function close(){
        $this->conn=null;
        //echo "Connection closed.\n\r";
    }

    function selectAll($tbl){
      $this->connect();
      $stmt = $this->conn->prepare("SELECT * FROM `{$tbl}`;");
      //$stmt->bindParam(":table",$tbl);
      $result = $stmt->execute();
      //$stmt->close();
      $this->close();
      return $result;
    }

    function checkLogin($user, $pw){
      $this->connect();
      $tbl = 'users';
      $stmt = $this->conn->prepare("SELECT `password` FROM `{$tbl}` WHERE `email_address` = :username;");
      $stmt->bindParam(":username",$user,PDO::PARAM_STR);
      $stmt->execute();
      $f = $stmt->fetchColumn();
      $this->close();
      $loggedin = password_verify($pw,$f);
      return $loggedin;
    }

    function fetchUserData($user){
      $this->connect();
      $tbl = 'users';
      $stmt = $this->conn->prepare("SELECT `id`,`first_name`,`last_name`,`email_address`,`user_type` FROM `{$tbl}` WHERE `email_address` = :username;");
      $stmt->bindParam(":username",$user,PDO::PARAM_STR);
      $stmt->execute();
      $f = $stmt->fetchAll();
      $this->close();
      return $f[0];
    }

    function checkExists($email_address) {
      $this->connect();
      $tbl = 'users';
      $stmt = $this->conn->prepare("SELECT `id` FROM `{$tbl}` WHERE `email_address` = :email_address;");
      $stmt->bindParam(":email_address",$email_address,PDO::PARAM_STR);
      $stmt->execute();
      $f = $stmt->fetchAll();
      $exists = sizeof($f) > 0 ? TRUE : FALSE;
      $this->close();
      return $exists;
    }

    function register($arr){
        $email_address = $arr['emailaddress'];
        $first_name = $arr['first_name'];
        $last_name = $arr['last_name'];
        $user_type = $arr['user_type'];
        echo "<br>before pw";
        $password = createHash($arr['password']);
        echo $password;
        echo $email_address;
        //print_r($password);
        echo "<br>afterpw";
        $this->connect();
        $tbl = 'users';
        $stmt = $this->conn->prepare("INSERT INTO `{$tbl}` (`email_address`,`first_name`,`last_name`,`password`,`user_type`,`registration_date`) VALUES(:email_address, :first_name, :last_name, :password, :user_type, CURRENT_TIMESTAMP());");
        $stmt->bindParam(":email_address",$email_address,PDO::PARAM_STR);
        $stmt->bindParam(":first_name",$first_name,PDO::PARAM_STR);
        $stmt->bindParam(":last_name",$last_name,PDO::PARAM_STR);
        $stmt->bindParam(":password",$password,PDO::PARAM_STR);
        $stmt->bindParam(":user_type",$user_type,PDO::PARAM_STR);
        $stmt->execute();
        $this->close();

        return true;
    }

}

  $c = new DBClass;
  //$c->close();
  $results = $c->selectAll('users');
  //print_r($results);



?>
