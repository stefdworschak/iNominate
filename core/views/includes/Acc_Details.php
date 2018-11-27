<?php
  ob_start();
  $img_link = $_SESSION['img_link'];
  if($img_link == ''){
    $img_link = 'core/img/portrait.png';
  }
?>


    <!-- https://getbootstrap.com/docs/4.0/components/card/ -->
    <div class="container">
      <div class="row">
        <div class="col-sm-2">
          &nbsp;
        </div>
        <div class="col-sm-8">
          <br />
            <h1>My Account</h1>
            <!-- Source: https://getbootstrap.com/docs/4.0/components/forms/ -->
            <form class="form-inline" method="POST" action="core/functions/Acc_Details_script.php" enctype="multipart/form-data">
              <div class="form-group mb-2">
                <label for="Name" class="sr-only">Email</label>
                <input type="text" readonly class="form-control-plaintext" id="Name" value="Name : ">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="firstname" class="sr-only">name</label>
                <input type="text" name = "firstname" class="form-control" id="firstname" placeholder="<?php echo $_SESSION['first_name']; ?>">
              </div>
              <div class="form-group mb-2">
                <label for="last" class="sr-only">Email</label>
                <input type="text" readonly class="form-control-plaintext" id="last" value=" ">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="lastname" class="sr-only">name</label>
                <input type="text" name = "lastname" class="form-control" id="lastname" placeholder="<?php echo $_SESSION['last_name']; ?>">
              </div>
              <button type="submit" class="btn btn-primary mb-2">Change</button>
            </form>

            <form class="form-inline" method="POST" action="core/functions/Acc_Details_script.php" enctype="multipart/form-data">
              <div class="form-group mb-2">
                <label for="Email" class="sr-only">Email</label>
                <input type="text" readonly class="form-control-plaintext" id="Email" value="Email">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="Email1" class="sr-only">Email1</label>
                <input type="text" name="e_mail" class="form-control" id="Email" placeholder="<?php echo $_SESSION['email_address']; ?>">
              </div>
              <button type="submit" class="btn btn-primary mb-2">Change</button>
            </form>

            <form class="form-inline" method="POST" action="core/functions/reset_script.php" enctype="multipart/form-data">
              <div class="form-group mb-2">
                <label for="Password" class="sr-only">password</label>
                <input type="text" readonly class="form-control-plaintext" id="Name" value="Password ">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="password1" class="sr-only">name</label>
                <input type="password" name="resetPassword1" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              <div class="form-group mb-2">
                <label for="last" class="sr-only">Email</label>
                <input type="text" readonly class="form-control-plaintext" id="last" value=" ">
              </div>
              <div class="form-group mx-sm-3 mb-2">
                <label for="password2" class="sr-only">name</label>
                <input type="password" name="resetPassword2" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
              </div>
                      <input type='hidden' value = <?php echo $_SESSION['userid']; ?> name = 'hiddenUserid'/>
                      <input type='hidden' value = "account" name = 'validate'/>
              <button type="submit" class="btn btn-primary mb-2">Change</button>
              <span class="err_output" id="change">
                <?php
                     $error = isset($_GET['err']) ? $_GET['err'] : '';
                       if( $error == 'change' ){
                         echo " The passwords do not match";
                         }
                         ?>
               <span>
            </form>
          </div>
          <div class="col-sm-2">
                &nbsp;
          </div>
      </div>
    </div>
