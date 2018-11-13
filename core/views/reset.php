<div class="container">
  <div class="row">
    <div class="col-md-4 col-lg-4">
      &nbsp;
    </div>
    <div class="col-md-4 col-lg-4">
      <br />
        <h1> Reset password </h1>
        <!-- Source: https://getbootstrap.com/docs/4.0/components/forms/ -->
        <form method="POST" action="core/functions/reset_script.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="resetPassword1" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="resetPassword2" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
        <input type='hidden' value = <?php echo $_GET['userid']; ?> name = 'hiddenUserid'/>
      </br>
      <span class="err_output" id="reset">
        <?php
             $error = isset($_GET['err']) ? $_GET['err'] : '';
               if( $error == 'reset' ){
                 echo " The passwords do not match";
                 }
                 ?>
       <span>
          <button id="reset" class="btn btn-danger">Reset</button>
        </form>
      </div>
      <div class="col-md-4 col-lg-4">
            &nbsp;
      </div>
  </div>
</div>
