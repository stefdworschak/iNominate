<?php
  include('navbar.php');
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
    <?php
        include('left_pane.php');
    ?>

  </div>
  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 col-xl-9">

  <?php
    $view = isset($_GET['view']) ? $_GET['view'] : 'index';
    if($view == 'index'){
        include('includes/all_elections.php');
        //include('includes/loggedin_main.php');
    } else if($view == 'candidates') {
        include('includes/all_candidates.php');
    }  else if($view == 'profile') {
        include('includes/profile.php');
    } else if($view == 'upload_photo') {
        include('includes/upload_photo.php');
    } else if($view == 'admin_panel') {
        include('includes/admin_panel.php');
    } else if($view == 'create_election') {
        include('includes/create_election.php');
    }  else if($view == 'inbox') {
        include('includes/inbox.php');
    } else if($view == 'outbox') {
        include('includes/outbox.php');
    } else if($view == 'message') {
        include('includes/message.php');
    } else if($view == 'Acc_Details') {
        include('includes/Acc_Details.php');
    } else if($view == 'create_candidate'){
        include('includes/create_candidate_profile.php');
    } else if($view == 'elections'){
        include('includes/all_elections.php');
    } else if($view == 'confirm_vote') {
        include('includes/confirm_vote.php');
    } else if($view == 'select_candidate') {
        include('includes/select_candidate.php');
    } else {
        include('includes/all_elections.php');
        //include('includes/loggedin_main.php');
    }

   ?>
  </div>
</div>

</div>

<!-- Spacer so that the page does not end at the very right -->
<div class="col-xs-12 col-sm-0 col-md-0 col-lg-0 col-xl-1">
</div>
