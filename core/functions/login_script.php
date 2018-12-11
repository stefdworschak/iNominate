<?php
  require('../init.php');

  //print_r($_POST);

  $emailaddress = $_POST['emailaddress'];
  $password = $_POST['password'];

  //echo "details\n\r";
  //echo "Email:" . $emailaddress;
  //echo "Password:" . $password;

  $c = new DBClass;
  $loggedin = $c->checkLogin($emailaddress, $password);

  if($loggedin === TRUE) {
    //echo "true";
    $user_data = $c->fetchUserData($emailaddress);
    print_r($user_data);
    //print_r($user_data['email_address']);
    session_start();
    $_SESSION['userid'] = $user_data['id'];
    $_SESSION['first_name'] = $user_data['first_name'];
    $_SESSION['last_name'] = $user_data['last_name'];
    $_SESSION['email_address'] = $user_data['email_address'];
    $_SESSION['user_type'] = $user_data['user_type'];
    $_SESSION['org'] = $user_data['org'];
    $_SESSION['department'] = $user_data['department'];
    $_SESSION['img_link'] = $user_data['img_link'];
    $_SESSION['existing_candidate']=1;
    $my_election =$c->getMyElectionNew($user_data['id']);
    $_SESSION['my_election'] = $my_election;
    $_SESSION['position'] = $user_data['position'];
    print_r($my_election);
    //header('Location:../../index.php');
    } else {
    header('Location:../../index.php?err=login_err');
  }

?>
