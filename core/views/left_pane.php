<?php
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
        <h5 class="card-title"><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="">My Profile</a></li>
        <li class="list-group-item">Dapibus ac facilisis in</li>
        <li class="list-group-item">Vestibulum at eros</li>
      </ul>
      <div class="card-body">
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
