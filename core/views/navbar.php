<?php
$messages=$c->numMessages($_SESSION['userid']);
?>

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
      <a class="nav-item nav-link active" href="index.php?view=elections">Elections <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="index.php?view=candidates">Candidates</a>
      <!--<a class="nav-item nav-link" href="#">View Elections</a>-->
      <!--<a class="nav-item nav-link" href="#">Company Structure</a>-->
      <a class="nav-item nav-link" href="index.php?view=inbox">Inbox <span class="badge inbox"><?php echo $messages; ?></span></a>
      <?php
        if($_SESSION['position'] != null) {
          echo "<a class='nav-item nav-link' href='index.php?view=create_poll'>Admin Panel</a>";
        }
      ?>
      <?php
        if($_SESSION['user_type'] == 'admin') {
          echo "<a class='nav-item nav-link' href='index.php?view=admin_panel'>Admin Panel</a>";
        }
      ?>
    </div>
    <div class="navbar-nav text-right">
        <a class="nav-item nav-link disabled text-right" href="core/functions/logout_script.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </div>
</nav>
