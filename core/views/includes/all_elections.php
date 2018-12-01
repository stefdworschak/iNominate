<?php

  $c = new DBClass;
  $all=$c->getElections($_SESSION['org']);
  $votes=$c->getMyVotes($_SESSION['userid']);

  $html = "";
  $curtime = time();
  $view = isset($_GET['eType']) ? $_GET['eType'] : 'current';
  $failed_id = isset($_GET['failed_id']) ? $_GET['failed_id'] : 0;
  $success = isset($_GET['candidate_reg_success']) ? $_GET['candidate_reg_success'] : false;
  $err_type = isset($_GET['err']) ? $_GET['err'] : '';

  if($err_type != ''){
    if($err_type == 'already_candidate'){
        $errors = "<div class='err_output'>You cannot register for more than one election at a time.</div>";
    } else if($err_type == 'no_election_specified' && $failed_id == $all[$i]['id']){
        $errors = "<div class='err_output'>Please select an election from this list.</div>";
    } else if($err_type == 'candidate_reg_err' && $failed_id == $all[$i]['id']){
        $errors = "<div class='err_output'>An unexpected error occurred registering you as candidate. Please try again or contact your administrator.</div>";
    }
  }
  //$html .= '<div class="row">';
  for($i=0; $i < sizeof($all);$i++){

    if($all[$i]['id'] != $failed_id){ $err = ''; }
    else { $err = $errors; }

    //Disable candidate button if you are a candidate
    if($_SESSION['my_election'] == null){ $candidated = '<button class="btn btn-primary">Register as Candidate</button>'; }
    else if($_SESSION['my_election'] == $all[$i]['id']) { $candidated = '<button class="btn btn-primary" disabled>Registered as Candidate <i class="fas fa-check"></i></button>'; }
    else { $candidated = ''; }

    if(in_array($all[$i]['id'],$votes)){
      $voted = "<button class='btn btn-success' disabled>Voted <i class='fas fa-check'></i></button>";
    } else {
      $voted = "<button class='btn btn-danger'>Vote!</button>";
    }

      if(($view == 'current' && strtotime($all[$i]['expiry_date']) >= $curtime)
          || ($view == 'expired' && strtotime($all[$i]['expiry_date']) < $curtime)) {
        $html .= "
          <div class='card main_card'>
            <h5 class='card-header'>" . $all[$i]['title'] .  "</h5>
            <div class='card-body'>
              <h5 class='card-title'>
                  <span class='badge badge-secondary'>" . $all[$i]['department'] .  "</span>&nbsp;
                  <span class='badge badge-secondary'>0 of " . $all[$i]['num_candidates'] .  "</span>&nbsp;
                  <span class='badge badge-secondary'>" . $all[$i]['expiry_date'] .  "</span>&nbsp;
              </h5>
              <p class='card-text'>" . $all[$i]['description'] .  "</p>
              <form id='regCandidate' method='POST' action='core/functions/existing_candidate.php' enctype='multipart/form-data'>
                <input type='hidden' value='". $all[$i]['id'] ."' name='election_id' />
                " . $candidated . "
              </form>
              <form id='voteElection' method='POST' action='core/functions/vote.php' enctype='multipart/form-data'>
                  <input type='hidden' value='". $all[$i]['id'] ."' name='election_id' />
                  " . $voted . "
                </form>
                " . $err . "
            </div>
          </div>
        ";
      }

  } ?>

  <div class="row">
    <div class="card profile_card">
      <h4 class="card-header">All Elections <span id="search_div"><input type="text" id="search"><i class="fas fa-search"></i></span></h4>
      <div class="card-body">

         <?php
            if($success === 'true'){
                echo "<div class='alert alert-success' role='alert'>Your Candidate Profile was created successfully!</div>";
            }

            if($view == 'current') {
              echo "<h5><strong>Current Elections</strong> | <a href='index.php?eType=expired'>Past Elections</a></h5>";
            } else {
              echo "<h5><a href='index.php'>Current Elections</a> | <strong>Past Elections</strong></h5>";
            }

            if($html == ''){
                echo "<br /><h5>No elections found.</h5>";
            } else {
                echo $html;
            }

         ?>
       </div>
     </div>
   </div>
