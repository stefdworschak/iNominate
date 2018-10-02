<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <!-- https://pixabay.com/en/group-user-add-icon-person-2935518/ -->
    <img src="core/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    iNominate
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="index.php?view=candidates">View Candidates</a>
      <a class="nav-item nav-link" href="#">Pricing</a>
      <a class="nav-item nav-link" href="#">Disabled</a>
    </div>
    <div class="navbar-nav text-right">
        <a class="nav-item nav-link disabled text-right" href="core/functions/logout_script.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </div>
</nav>



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
