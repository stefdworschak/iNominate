<?php
  ob_start();
  $img_link = $_SESSION['img_link'];
  if($img_link == ''){
    $img_link = 'core/img/portrait.png';
  }
?>


    <!-- https://getbootstrap.com/docs/4.0/components/card/ -->
      <div class="card" style="width: 100%;">
      <img class="card-img-top my_profile_img" src="<?php echo $img_link; ?>" alt="Card image cap">
      <i class="fas fa-edit edit_img"></i>
      <div class="card-body">
        <h5 class="card-title left-pane_name"><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h5>
        <i><?php echo $_SESSION['org']; ?></i>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="index.php?view=Acc_Details">My Account</a></li>
        <li class="list-group-item deactivated">Candidate Profile</li>
      </ul>
      <div class="card-body">
        <a href="#" class="card-link">Favourites</a> | <a href="#" class="card-link">News Feed</a>
      </div>
      <div class="card-body">

      </div>
    </div>
