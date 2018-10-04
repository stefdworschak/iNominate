<?php
  include('includes/navbar.php');
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 col-lg-2">
    <?php
        include('left_pane.php');
    ?>

  </div>
  <div class="col-md-9 col-lg-9">

  <?php
    $view = isset($_GET['view']) ? $_GET['view'] : 'index';
    if($view == 'index'){
        include('includes/loggedin_main.php');
    } else if($view == 'candidates') {
        include('includes/all_candidates.php');
    }  else if($view == 'profile') {
        include('includes/profile.php');
    } else if($view == 'upload_photo') {
        include('includes/upload_photo.php');
    } else {
        include('includes/loggedin_main.php');
    }

   ?>
  </div>
</div>

</div>

<!-- Spacer so that the page does not end at the very right -->
<div class="col-md-2 col-lg-2">
</div>
