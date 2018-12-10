<?php
//require('core/env_vars.php');
require('create_hash.php');
require('winner.php');


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
      $stmt = $this->conn->prepare("
      SELECT u.`id`,u.`first_name`,u.`last_name`,u.`email_address`,u.`user_type`,u.`org`,u.`department`,u.`img_link`, e.`title` AS position,
        IF(r.`expiry_date` IS NOT NULL, 1,0) AS elected
        FROM `users` AS u
        LEFT JOIN `reps` AS r
        ON u.`id` = r.`user_id`
        LEFT JOIN `elections` AS e
        ON r.`election_id` = e.`id`
        WHERE (r.`expiry_date` > NOW() OR r.`expiry_date` IS NULL)
        AND `email_address` = :username
      ");
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
      $stmt = $this->conn->prepare("SELECT DISTINCT `org` FROM `{$tbl}` ORDER BY `org`;");
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

    function getElections($org){
      //Add to only retrieve for cur){rent company
      $this->connect();
      $stmt=$this->conn->prepare("SELECT e.*, p.`reg_candidates`, v.`num_votes` FROM `elections` AS e LEFT JOIN( SELECT `election_id`,COUNT(*) AS reg_candidates FROM `profiles` GROUP BY `election_id` ) AS p ON e.`id` = p.`election_id` LEFT JOIN ( SELECT `election_id`,COUNT(*) AS num_votes FROM `votes` GROUP BY `election_id` ) AS v ON e.`id` = v.`election_id` WHERE `org` = :org ORDER BY `expiry_date` DESC");
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
      $stmt=$this->conn->prepare("SELECT a.`message_id`, a.`subject`, a.`message`, a.`from_id`,IF(a.`from_id` < 0, 'System',CONCAT(b.`first_name`,' ',b.`last_name`)) AS sent_from, CONCAT(c.`first_name`,' ',c.`last_name`) AS sent_to, a.`sent` AS received_at, a.`message_read` AS status FROM `inbox` AS a LEFT JOIN `users` AS b ON a.`from_id` = b.`id` JOIN `users` AS c ON a.`to_id` = c.`id` WHERE a.`to_id` = :id ORDER BY a.`sent` DESC LIMIT 100;");
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
      $stmt=$this->conn->prepare("SELECT a.`message_id`, a.`subject`, a.`message`, a.`from_id`,CONCAT(b.`first_name`,' ',b.`last_name`) AS sent_from, IF(a.`to_id` =-1, 'System',CONCAT(c.`first_name`,' ',c.`last_name`)) AS sent_to, a.`sent` AS received_at, a.`message_read` AS status FROM `inbox` AS a JOIN `users` AS b ON a.`from_id` = b.`id` LEFT JOIN `users` AS c ON a.`to_id` = c.`id` WHERE a.`from_id` = 3 ORDER BY a.`sent` DESC LIMIT 100");
      $stmt->bindParam(":id",$id,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll();
      $this->close();
      return $result;
    }

    function getMessage($id, $userid){
      $this->connect();
      $tbl='inbox';
      $stmt=$this->conn->prepare("SELECT a.`message_id`, a.`subject`, a.`message`, a.`from_id`,IF(a.`from_id` < 0, 'System', CONCAT(b.`first_name`,' ',b.`last_name`)) AS sent_from, CONCAT(c.`first_name`,' ',c.`last_name`) AS sent_to, a.`sent` AS received_at, a.`message_read` AS status FROM `inbox` AS a LEFT JOIN `users` AS b ON a.`from_id` = b.`id` JOIN `users` AS c ON a.`to_id` = c.`id` WHERE a.`message_id` = :id AND (a.`from_id` = :userid OR a.`to_id` = :userid);");
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
        $stmt=$this->conn->prepare("SELECT p.* FROM `profiles` AS p JOIN `elections` e ON p.`election_id` = e.`id` WHERE p.`user_id` = :userid AND e.`closed` IS NULL");
        $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->close();
        //print_r($result);
        if($result == null) {
          $result=null;
          return $result;
        } else {
          $arr = $result[0];
          return $arr['election_id'];
        }
    }

    function getMyElectionNew($userid){
        $this->connect();
        $tbl='profiles';
        $stmt=$this->conn->prepare("SELECT a.*,b.`expiry_date` FROM `profiles` AS a JOIN `elections` AS b ON a.`election_id` = b.`id` WHERE `user_id` = :userid ORDER BY profile_id DESC LIMIT 1;");
        $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->close();
        if($result == null) {
          $result=null;
          return $result;
        } else if(strtotime($result[0]['expiry_date']) < time() ) {
          $result=null;
          return $result;
        } else {
          $arr = $result[0];
          return $arr['election_id'];
        }

    }

    function enterVote($param, $userid){
      $this->connect();
      $tbl = 'votes';
      $stmt = $this->conn->prepare("INSERT INTO `{$tbl}` (`candidate_id`,`candidate_id2`,`candidate_id3`,`election_id`,`user_id`) VALUES(:candidate_id,:candidate_id2,:candidate_id3,:election_id,:userid);");
      $stmt->bindParam(":candidate_id",$param['candidate_id'],PDO::PARAM_INT);
      $stmt->bindParam(":candidate_id2",$param['candidate_id2'],PDO::PARAM_INT);
      $stmt->bindParam(":candidate_id3",$param['candidate_id3'],PDO::PARAM_INT);
      $stmt->bindParam(":election_id",$param['election_id'],PDO::PARAM_INT);
      $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->rowCount();
      $this->close();
      return $result;
    }
    function getElectionCandidates($election_id){
      $this->connect();
      $stmt=$this->conn->prepare("SELECT a.`profile_id`, a.`user_id`, a.`motto`,CONCAT(b.`first_name`,' ',b.`last_name`) AS candidate_name, b.`org`,b.`img_link`, c.`title` AS election_title, c.`department` AS election_department, c.`expiry_date` AS election_end FROM `profiles` AS a JOIN `users` AS b ON a.`user_id` = b.`id` JOIN `elections` AS c ON a.`election_id` = c.`id` WHERE a.`election_id` = :election_id");
      $stmt->bindParam(":election_id",$election_id,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->fetchAll();
      return $result;
    }

    function closeElection($election_id){
      //Change closed to 1 in election
      print_r($election_id);
      $this->connect();
      $stmt=$this->conn->prepare("UPDATE `elections` SET `closed` = 1 WHERE `id` = :election_id;");
      $stmt->bindParam(":election_id",$election_id,PDO::PARAM_INT);
      $stmt->execute();
      $result=$stmt->rowCount();
      return $result;
    }

    function calculateResults($election_id){
      $this->connect();
      $stmt=$this->conn->prepare("SELECT `num_roles` FROM `elections` WHERE `id` = :election_id;");
      $stmt->bindParam(":election_id",$election_id,PDO::PARAM_INT);
      $stmt->execute();
      $top=$stmt->fetchAll()[0]['num_roles'];
      $query = "
      SELECT * FROM (
        SELECT a.`candidate`, a.`candidate_name`, SUM(a.`num_votes`) AS votes,
        SUM(a.`rank1_votes`) AS rank1_votes, SUM(a.`rank2_votes`) AS rank2_votes, SUM(a.`rank3_votes`) AS rank3_votes
        FROM (
          SELECT v.`candidate_id`  AS candidate, CONCAT(u.`first_name`,' ',u.`last_name`) AS candidate_name, v.`election_id`, COUNT(v.`candidate_id`) AS num_votes,
                COUNT(v.`candidate_id`) AS rank1_votes, 0 AS rank2_votes, 0 AS rank3_votes
          FROM `votes` AS v
          JOIN `users` AS u
          ON u.`id` = v.`candidate_id`
          GROUP BY `candidate_id`,`election_id`

          UNION

          SELECT v.`candidate_id2` AS candidate, CONCAT(u.`first_name`,' ',u.`last_name`) AS candidate_name, v.`election_id`, COUNT(v.`candidate_id2`)*0.3 AS num_votes,
          0 AS rank1_votes, COUNT(v.`candidate_id2`) AS rank2_votes, 0 AS rank3_votes
          FROM `votes` AS v
          JOIN `users` AS u
          ON u.`id` = v.`candidate_id2`
          GROUP BY `candidate_id2`,`election_id`

          UNION

          SELECT `candidate_id3`  AS candidate, CONCAT(u.`first_name`,' ',u.`last_name`) AS candidate_name, `election_id`, COUNT(`candidate_id3`)*0.15 AS num_votes,
          0 AS rank1_votes, 0 AS rank2_votes, COUNT(v.`candidate_id3`) AS rank3_votes
          FROM `votes` AS v
          JOIN `users` AS u
          ON u.`id` = v.`candidate_id3`
          GROUP BY `candidate_id3`,`election_id`) As a
        WHERE a.`election_id` = :election_id
        GROUP BY a.`candidate`
      ) As b
      ORDER BY b.votes DESC";

      $query2="
        INSERT INTO `reps` (`user_id`,`election_id`,`expiry_date`)
        SELECT * FROM (SELECT :user_id, :election_id, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 YEAR)) AS tmp
        WHERE NOT EXISTS (
            SELECT `user_id`,`election_id` FROM `reps` WHERE `user_id` = :user_id AND `election_id` = :election_id
        );
      ";

      $stmt2=$this->conn->prepare($query);
      $stmt2->bindParam(":election_id",$election_id,PDO::PARAM_INT);
      $stmt2->execute();
      $winners=$stmt2->fetchAll();
      $win_arr = [];
      $count =0;

      for($i=1; $i < sizeof($winners);$i++){
            if($winners[$i-1]['votes'] > $winners[$i]['votes']){
              $count++;
              array_push($win_arr, $winners[$i-1]['candidate']);
              $stmt3=$this->conn->prepare($query2);
              $stmt3->bindParam(":user_id",$winners[$i-1]['candidate'],PDO::PARAM_INT);
              $stmt3->bindParam(":election_id",$election_id,PDO::PARAM_INT);
              $stmt3->execute();
            }
        $i = $top == $count ? $i = sizeof($winners) : $i;
      }

      if($win_arr == []) {
        return null;
      } else {
        return $win_arr;
      }
    }

    function notifyVoters($election_id, $win_arr){
      //create inbox entry for every voter to tell them the election results
      $query = "
      INSERT INTO `inbox` (`from_id`,`to_id`,`subject`,`message`)
      SELECT * FROM (SELECT -(:election_id) AS from_id, v.`user_id` AS to_id, 'Election Results' AS subject,
      CONCAT('Dear ',IFNULL(u.`first_name`,'User'), ', <br />The election results for ', e.title,' are finally in.<br />Please click [link=\"index.php?view=election_results&election_id=',e.`id`,'\"](here) to see the results.<br />Your Support Team' ) As message
      FROM `votes` AS v
      LEFT JOIN `users` AS u
      ON v.`user_id` = u.`id`
      LEFT JOIN `elections` AS e
      ON v.`election_id` = e.`id`

      UNION

      SELECT -(:election_id) AS from_id, r.`user_id` AS to_id, 'Congratulations!!' AS subject,
            CONCAT('Dear ',IFNULL(u.`first_name`,'User'), ', <br />The election results for ', e.title,' are finally in.<br />Please click [link=\"index.php?view=election_results&election_id=',e.`id`,'\"](here)  to see the results.<br />Your Support Team' ) As message
            FROM `reps` AS r
            LEFT JOIN `users` AS u
            ON r.`user_id` = u.`id`
            LEFT JOIN `elections` AS e
            ON r.`election_id` = e.`id`
            WHERE r.`election_id`= :election_id
            AND FIND_IN_SET(CONCAT(r.`user_id`,''),:user_ids)
      ) as a
      WHERE NOT EXISTS (
          SELECT -(:election_id) AS from_id, v.`user_id` AS to_id
          FROM `inbox` AS i,votes AS v
          WHERE -(i.from_id) = :election_id
          AND v.election_id = :election_id
      );";

      $this->connect();
      $stmt=$this->conn->prepare($query);
      $stmt->bindParam(":election_id",$election_id,PDO::PARAM_INT);
      $stmt->bindParam(":user_ids",implode(',',$win_arr),PDO::PARAM_STR);
      $stmt->execute();
      $check=$stmt->rowCount();
      $check2 =1;
      $this->close();
      if($check > 0 && $check2 > 0){
        return 1;
      } else {
        return 0;
      }
    }

    function displayResults($election_id){
      $query = "
      SELECT b.*,IF(r.`id` IS NULL, 0,1) AS elected FROM (
                  SELECT a.`candidate`, a.`candidate_name`, SUM(a.`num_votes`) AS votes,
                  SUM(a.`rank1_votes`) AS rank1_votes, SUM(a.`rank2_votes`) AS rank2_votes, SUM(a.`rank3_votes`) AS rank3_votes
                  FROM (
                    SELECT v.`candidate_id`  AS candidate, CONCAT(u.`first_name`,' ',u.`last_name`) AS candidate_name, v.`election_id`, COUNT(v.`candidate_id`) AS num_votes,
                          COUNT(v.`candidate_id`) AS rank1_votes, 0 AS rank2_votes, 0 AS rank3_votes
                    FROM `votes` AS v
                    JOIN `users` AS u
                    ON u.`id` = v.`candidate_id`
                    GROUP BY `candidate_id`,`election_id`

                    UNION

                    SELECT v.`candidate_id2` AS candidate, CONCAT(u.`first_name`,' ',u.`last_name`) AS candidate_name, v.`election_id`, COUNT(v.`candidate_id2`)*0.3 AS num_votes,
                    0 AS rank1_votes, COUNT(v.`candidate_id2`) AS rank2_votes, 0 AS rank3_votes
                    FROM `votes` AS v
                    JOIN `users` AS u
                    ON u.`id` = v.`candidate_id2`
                    GROUP BY `candidate_id2`,`election_id`

                    UNION

                    SELECT `candidate_id3`  AS candidate, CONCAT(u.`first_name`,' ',u.`last_name`) AS candidate_name, `election_id`, COUNT(`candidate_id3`)*0.15 AS num_votes,
                    0 AS rank1_votes, 0 AS rank2_votes, COUNT(v.`candidate_id3`) AS rank3_votes
                    FROM `votes` AS v
                    JOIN `users` AS u
                    ON u.`id` = v.`candidate_id3`
                    GROUP BY `candidate_id3`,`election_id`) As a
                  WHERE a.`election_id` = :election_id
                  GROUP BY a.`candidate`
                ) As b
                LEFT JOIN (SELECT * FROM reps WHERE `election_id` = :election_id)  AS r
                ON b.`candidate` = r.`user_id`
                ORDER BY b.`votes` DESC
        ";
        $this->connect();
        $stmt=$this->conn->prepare($query);


        $stmt->bindParam(":election_id",$election_id,PDO::PARAM_INT);
        $stmt->execute();
        $rows=$stmt->fetchAll();
        $results=[];
        //This part is used for display results

        //print_r($win_arr);
        for($j=0;$j < sizeof($rows);$j++){
          $win = new Winner;
          $arr =$win->setWinner(
              $rows[$j]['candidate'],
              $rows[$j]['candidate_name'],
              $rows[$j]['votes'],
              $rows[$j]['rank1_votes'],
              $rows[$j]['rank2_votes'],
              $rows[$j]['rank3_votes'],
              ($j+1),
              $rows[$j]['elected']
          );
          array_push($results,$arr);
        }
        return $results;

    }

}

  $c = new DBClass;
  //$c->close();
  $results = $c->selectAll('users');
  //print_r($results);



?>
