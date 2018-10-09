<?php
//require('core/env_vars.php');
require('create_hash.php');

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
      $stmt = $this->conn->prepare("SELECT `id`,`first_name`,`last_name`,`email_address`,`user_type`,`org`,`img_link` FROM `{$tbl}` WHERE `email_address` = :username;");
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
        $org = $arr['org'];
        echo "<br>before pw";
        $password = createHash($arr['password']);
        echo $password;
        echo $email_address;
        //print_r($password);
        echo "<br>afterpw";
        $this->connect();
        $tbl = 'users';
        $stmt = $this->conn->prepare("INSERT INTO `{$tbl}` (`email_address`,`first_name`,`last_name`,`password`,`user_type`,`org`,`registration_date`) VALUES(:email_address, :first_name, :last_name, :password, :user_type,:org, CURRENT_TIMESTAMP());");
        $stmt->bindParam(":email_address",$email_address,PDO::PARAM_STR);
        $stmt->bindParam(":first_name",$first_name,PDO::PARAM_STR);
        $stmt->bindParam(":last_name",$last_name,PDO::PARAM_STR);
        $stmt->bindParam(":password",$password,PDO::PARAM_STR);
        $stmt->bindParam(":user_type",$user_type,PDO::PARAM_STR);
        $stmt->bindParam(":org",$org,PDO::PARAM_STR);
        $stmt->execute();
        $this->close();

        return true;
    }

    function imgLink($id, $link){
      $this->connect();
      $tbl = 'users';
      $stmt = $this->conn->prepare("UPDATE `{$tbl}` SET `img_link` = :img_link WHERE `id` = :id;");
      $stmt->bindParam(":img_link",$link,PDO::PARAM_STR);
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $this->close();

      return true;
    }

    function createElection($arr){

      $title = $arr['election_title'];
      $description = $arr['election_description'];
      $department = $arr['election_department'];
      echo $department;
      $num_candidates = $arr['election_numcandidates'];
      $expiry_dt = $arr['election_expirydate'] . " " . $arr['election_expirytime'];

      $this->connect();
      $tbl = 'elections';
      $stmt = $this->conn->prepare("INSERT INTO `{$tbl}` (`title`,`description`,`department`,`num_candidates`,`expiry_date`) VALUES (:title, :description, :department, :num_candidates, :expiry_date);");
      $stmt->bindParam(":title",$title,PDO::PARAM_STR);
      $stmt->bindParam(":description",$description,PDO::PARAM_STR);
      $stmt->bindParam(":department",$department,PDO::PARAM_STR);
      $stmt->bindParam(":num_candidates",$num_candidates,PDO::PARAM_INT);
      $stmt->bindParam(":expiry_date",$expiry_dt,PDO::PARAM_STR);
      $stmt->execute();
      $this->close();
    }

}

  $c = new DBClass;
  //$c->close();
  $results = $c->selectAll('users');
  //print_r($results);



?>
