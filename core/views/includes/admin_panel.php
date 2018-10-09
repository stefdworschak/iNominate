<?php
  if(!isset($_SESSION)) {
    header('Location:../../../index.php');
  }
?>

<div class="container">
    <div class="row">
      <div class="card profile_card">
        <h4 class="card-header">Admin Panel</h4>
        <div class="card-body">
          <a href="index.php?view=create_election" class="btn btn-primary btn-md">Create New Election</a>
          <br /><br />


          <h5 class="card-title profile_subtitle">Ongoing Elections</h5>
          <!--<p class="card-text profile_text">With supporting text below as a natural lead-in to additional content.</p>-->
          <div class="card main_card">
            <h5 class="card-header">Title</h5>
            <div class="card-body">
              <!--<h5 class="card-title"></h5>-->
              <p class="card-text">
                Number of Candidates: xxx <br>
                Election expiry date: dd/mm/yyyy <br>
              </p>
              <a href="#" class="btn btn-warning btn-sm">Edit</a>
            </div>
          </div>



          <h5 class="card-title profile_subtitle">Past Elections</h5>
          <p class="card-text profile_text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
      </div>
    </div>
</div>
