<div class="container">
  <div class="row">
    <div class="col-md-4 col-lg-4">
      &nbsp;
    </div>
    <div class="col-md-4 col-lg-4">
      <br />
        <h1>Please Login below</h1>
        <!-- Source: https://getbootstrap.com/docs/4.0/components/forms/ -->
        <form method="POST" action="core/functions/login_script.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="emailaddress" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div>
          <a href="index.php?mode=forgot">Forgot Password</a>&nbsp;
        </div>
      </br>
          <button type="submit" class="btn btn-primary">Sign In</button>&nbsp;
          <button id="registerBtn" class="btn btn-danger">Register</button>
        </form>
      </div>
      <div class="col-md-4 col-lg-4">
            &nbsp;
      </div>
  </div>
</div>
