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
      $stmt = $this->conn->prepare("SELECT `id`,`first_name`,`last_name`,`email_address`,`user_type`,`org`,`department`,`img_link` FROM `{$tbl}` WHERE `email_address` = :username;");
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

    function checkOrg() {
      $this->connect();
      $tbl = 'users';
      $stmt = $this->conn->prepare("SELECT `org` FROM `{$tbl}`;");
      $stmt->execute();
      $f = $stmt->fetchAll();
      $this->close();
      return $f;
    }

    function register($arr){
        $email_address = $arr['emailaddress'];
        $first_name = $arr['first_name'];
        $last_name = $arr['last_name'];
        $user_type = $arr['user_type'];
        $department = $arr['department'];
        $org = $arr['org'];
        echo "<br>before pw";
        $password = createHash($arr['password']);
        echo $password;
        echo $email_address;
        //print_r($password);
        echo "<br>afterpw";
        $this->connect();
        $tbl = 'users';
        $stmt = $this->conn->prepare("INSERT INTO `{$tbl}` (`email_address`,`first_name`,`last_name`,`password`,`user_type`,`org`,`department`,`registration_date`) VALUES(:email_address, :first_name, :last_name, :password, :user_type,:org,:department, CURRENT_TIMESTAMP());");
        $stmt->bindParam(":email_address",$email_address,PDO::PARAM_STR);
        $stmt->bindParam(":first_name",$first_name,PDO::PARAM_STR);
        $stmt->bindParam(":last_name",$last_name,PDO::PARAM_STR);
        $stmt->bindParam(":password",$password,PDO::PARAM_STR);
        $stmt->bindParam(":user_type",$user_type,PDO::PARAM_STR);
        $stmt->bindParam(":org",$org,PDO::PARAM_STR);
        $stmt->bindParam(":department",$department,PDO::PARAM_STR);
        $stmt->execute();
        $this->close();

        return true;
    }

    function reset($userid, $password){
      $this->connect();
      $tbl ='users';
      $stmt = $this->conn->prepare("UPDATE `{$tbl}` SET `password` = :password WHERE `id` = :userid;");
      $stmt->bindParam(":password",createHash($password),PDO::PARAM_STR);
      $stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
      $stmt->execute();
      $this->close();

      return true;
    }
    function updatename($userid, $first_name, $last_name){
      $this->connect();
      $tbl ='users';
      $stmt = $this->conn->prepare("UPDATE `{$tbl}` SET `first_name` = :firstname, `last_name` = :lastname WHERE `id` = :userid;");
      $stmt->bindParam(":firstname",$first_name,PDO::PARAM_STR);
      $stmt->bindParam(":lastname",$last_name,PDO::PARAM_STR);
      $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->rowCount();
      $this->close();

      return $result;
    }
    function updatemail($userid, $email_address){
      $this->connect();
      $tbl ='users';
      $stmt = $this->conn->prepare("UPDATE `{$tbl}` SET `email_address` = :e_mail WHERE `id` = :userid;");
      $stmt->bindParam(":e_mail",$email_address,PDO::PARAM_STR);
      $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
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

      try{
          $title = $arr['election_title'];
          $description = $arr['election_description'];
          $department = $arr['election_department'];
          echo $department;
          $num_candidates = $arr['election_numcandidates'];
          $num_roles = $arr['election_numroles'];
          $expiry_dt = $arr['election_expirydate'] . " " . $arr['election_expirytime'];
          $org = $arr['org'];
          $createdby = $arr['createdby'];

          $this->connect();
          $tbl = 'elections';
          $stmt = $this->conn->prepare("INSERT INTO `{$tbl}` (`title`,`description`,`department`,`num_candidates`,`num_roles`,`expiry_date`,`createdby`,`org`) VALUES (:title, :description, :department, :num_candidates, :num_roles, :expiry_date, :createdby, :org);");
          $stmt->bindParam(":title",$title,PDO::PARAM_STR);
          $stmt->bindParam(":description",$description,PDO::PARAM_STR);
          $stmt->bindParam(":department",$department,PDO::PARAM_STR);
          $stmt->bindParam(":num_candidates",$num_candidates,PDO::PARAM_INT);
          $stmt->bindParam(":num_roles",$num_roles,PDO::PARAM_INT);
          $stmt->bindParam(":expiry_date",$expiry_dt,PDO::PARAM_STR);
          $stmt->bindParam(":createdby",$createdby,PDO::PARAM_INT);
          $stmt->bindParam(":org",$org,PDO::PARAM_STR);
          $stmt->execute();
          $this->close();
          $return = true;
        } catch(Exception $e) {
          $return = $e->getMessage();
        }
        return $return;
    }

    function getCandidates($org){
      //Add to only retrieve for current company
      $this->connect();
      $tbl='profiles';
      $stmt=$this->conn->prepare("SELECT a.`profile_id`, CONCAT(b.`first_name`,' ',b.`last_name`) AS candidate_name, b.`org`,b.`img_link`, c.`title` AS election_title, c.`department` AS election_department, c.`expiry_date` AS election_end FROM `profiles` AS a JOIN `users` AS b ON a.`user_id` = b.`id` JOIN `elections` AS c ON a.`election_id` = c.`id` WHERE c.`org` = :org");
      $stmt->bindParam(":org",$org,PDO::PARAM_STR);
      $stmt->execute();
      $result=$stmt->fetchAll();
      $this->close();
      return $result;

    }

    function getElections ($org){
      //Add to only retrieve for cur){rent company
      $this->connect();
      $tbl='elections';
      $stmt=$this->conn->prepare("SELECT * FROM `{$tbl}` WHERE `org` = :org");
      $stmt->bindParam(":org",$org,PDO::PARAM_STR);
      $stmt->execute();
      $result=$stmt->fetchAll();
      $this->close();
      return $result;

    }

    function getCandidateProfile($id){
      $this->connect();
      $stmt=$this->conn->prepare("SELECT a.`profile_id`, a.`user_id`, a.`mission_statement`,a.`policies`,a.`areas_of_interest`,CONCAT(b.`first_name`,' ',b.`last_name`) AS candidate_name, b.`user_type`,b.`org`,b.`img_link`, c.`title` AS election_title, c.`description` AS election_description, c.`department` AS election_department, c.`expiry_date` AS election_end FROM `profiles` AS a JOIN `users` AS b ON a.`user_id` = b.`id` JOIN `elections` AS c ON a.`election_id` = c.`id` WHERE a.`profile_id` = :id");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll();
      $this->close();
      return $result[0];

    }

    function sendMessage($from, $to, $subject, $msg, $thid){
        $this->connect();
        $tbl='inbox';
        $stmt=$this->conn->prepare("INSERT INTO `inbox` (`from_id`,`to_id`,`subject`,`message`) VALUES (:from_id, :to_id, :subject, :msg);");
        $stmt->bindParam(":from_id",$from,PDO::PARAM_INT);
        $stmt->bindParam(":to_id",$to,PDO::PARAM_INT);
        $stmt->bindParam(":subject",$subject,PDO::PARAM_STR);
        $stmt->bindParam(":msg",$msg,PDO::PARAM_STR);
        $stmt->execute();

        //Retrieve the new message_id
        $stmt_id=$this->conn->lastInsertId();

        //Update record with thread_id
        $update=$this->conn->prepare("UPDATE `inbox` SET `thread_id`= :thread_id WHERE `message_id` = :message_id");
        $thread_id = $thid == 0 ? $stmt_id . $from . $to : $thid;
        $update->bindParam(":thread_id",$thread_id,PDO::PARAM_INT);
        $update->bindParam(":message_id",$stmt_id,PDO::PARAM_INT);
        $update->execute();
        $this->close();
        return true;
    }

    function numMessages($id){
      $this->connect();
      $tbl='inbox';
      $stmt=$this->conn->prepare("SELECT `message_id` FROM `inbox` WHERE `to_id` = :id AND `message_read` IS NULL;");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->rowCount();
      $this->close();
      return $result;
    }

    function allMessages($id){
      $this->connect();
      $tbl='inbox';
      //Currently limited to the last 100 msgs
      $stmt=$this->conn->prepare("SELECT a.`message_id`, a.`subject`, a.`message`, a.`from_id`,CONCAT(b.`first_name`,' ',b.`last_name`) AS sent_from, CONCAT(c.`first_name`,' ',c.`last_name`) AS sent_to, a.`sent` AS received_at, a.`message_read` AS status FROM `inbox` AS a JOIN `users` AS b ON a.`from_id` = b.`id` JOIN `users` AS c ON a.`to_id` = c.`id` WHERE a.`to_id` = :id ORDER BY a.`sent` DESC LIMIT 100;");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll();
      $this->close();
      return $result;
    }

    function allSent($id){
      $this->connect();
      $tbl='inbox';
      //Currently limited to the last 100 msgs
      $stmt=$this->conn->prepare("SELECT a.`message_id`, a.`subject`, a.`message`, a.`from_id`,CONCAT(b.`first_name`,' ',b.`last_name`) AS sent_from, CONCAT(c.`first_name`,' ',c.`last_name`) AS sent_to, a.`sent` AS received_at, a.`message_read` AS status FROM `inbox` AS a JOIN `users` AS b ON a.`from_id` = b.`id` JOIN `users` AS c ON a.`to_id` = c.`id` WHERE a.`from_id` = :id ORDER BY a.`sent` DESC LIMIT 100;");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll();
      $this->close();
      return $result;
    }

    function getMessage($id, $userid){
      $this->connect();
      $tbl='inbox';
      $stmt=$this->conn->prepare("SELECT a.`message_id`, a.`subject`, a.`message`, a.`from_id`,CONCAT(b.`first_name`,' ',b.`last_name`) AS sent_from, CONCAT(c.`first_name`,' ',c.`last_name`) AS sent_to, a.`sent` AS received_at, a.`message_read` AS status FROM `inbox` AS a JOIN `users` AS b ON a.`from_id` = b.`id` JOIN `users` AS c ON a.`to_id` = c.`id` WHERE a.`message_id` = :id AND (a.`from_id` = :userid OR a.`to_id` = :userid);");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll();
      $this->close();
      return $result[0];
    }

    function messageRead($id, $userid){
      $this->connect();
      $tbl='inbox';
      $stmt=$this->conn->prepare("UPDATE `inbox` SET `message_read` = 1, `seen` = CURRENT_TIMESTAMP() WHERE `message_id` = :id AND `to_id`= :userid;");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
      $stmt->execute();
      $count=$stmt->rowCount();
      $this->close();
      return $count;
    }

    function checkCandidateExists($userid){
      $this->connect();
      $stmt=$this->conn->prepare("SELECT a.`user_id` FROM `profiles` AS a JOIN `elections` AS b ON a.`election_id` = b.`id` WHERE a.`user_id` = :userid AND b.`expiry_date` > CURRENT_TIMESTAMP()");
      $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
      $stmt->execute();
      $count=$stmt->rowCount();
      $this->close();
      return $count;
    }

    function updateCandidateProfile($arr){
      try{
          $user_id = $arr['userid'];
          $election_id = $arr['election_id'];
          $mission = $arr['mission_statement'];
          $areas = $arr['areas_of_interest'];
          $policies = $arr['policies'];
          $motto = $arr['motto'];

          $this->connect();
          $tbl = 'profiles';
          $stmt = $this->conn->prepare("UPDATE `{$tbl}` SET `election_id` = :election_id, `mission_statement` = :mission, `areas_of_interest` = :areas, `policies` = :policies, `motto` = :motto WHERE `user_id` = :user_id");
          $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
          $stmt->bindParam(":election_id",$election_id,PDO::PARAM_INT);
          $stmt->bindParam(":mission",$mission,PDO::PARAM_STR);
          $stmt->bindParam(":areas",$areas,PDO::PARAM_STR);
          $stmt->bindParam(":policies",$policies,PDO::PARAM_STR);
          $stmt->bindParam(":motto",$motto,PDO::PARAM_STR);
          $stmt->execute();
          $count = $stmt->rowCount();
          $this->close();
          return $count;
        } catch(Exception $e) {
          $return = $e->getMessage();
        }
    }
    function createCandidateProfile($arr){
      try{
          $user_id = $arr['userid'];
          $election_id = $arr['election_id'];
          $mission = $arr['mission_statement'];
          $areas = $arr['areas_of_interest'];
          $policies = $arr['policies'];
          $motto = $arr['motto'];

          $this->connect();
          $tbl = 'profiles';
          $stmt = $this->conn->prepare("INSERT INTO `{$tbl}` (`user_id`,`election_id`,`mission_statement`,`areas_of_interest`,`policies`,`motto`) VALUES(:user_id,:election_id,:mission,:areas,:policies,:motto)");
          $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
          $stmt->bindParam(":election_id",$election_id,PDO::PARAM_INT);
          $stmt->bindParam(":mission",$mission,PDO::PARAM_STR);
          $stmt->bindParam(":areas",$areas,PDO::PARAM_STR);
          $stmt->bindParam(":policies",$policies,PDO::PARAM_STR);
          $stmt->bindParam(":motto",$motto,PDO::PARAM_STR);
          $stmt->execute();
          $this->close();
          return true;
        } catch(Exception $e) {
          $return = $e->getMessage();
        }
    }

    function getMyVotes($userid){
        $this->connect();
        $tbl='votes';
        $stmt=$this->conn->prepare("SELECT * FROM `votes` WHERE `user_id` = :userid");
        $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->close();
        $arr = [];
        for($i = 0; $i < sizeof($result); $i++){
          array_push($arr,$result[$i]['election_id']);
        }
        return $arr;
    }
    function getMyElection($userid){
        $this->connect();
        $tbl='profiles';
        $stmt=$this->conn->prepare("SELECT * FROM `profiles` WHERE `user_id` = :userid");
        $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->close();
        if($result == null) {
          return $result;
        } else {
          $arr = $result[0];
          return $arr['election_id'];
        }

    }

}

  $c = new DBClass;
  //$c->close();
  $results = $c->selectAll('users');
  //print_r($results);



?>
