<div class="container">
  <div class="row">
    <div class="col-md-4 col-lg-4">
      &nbsp;
    </div>
    <div class="col-md-4 col-lg-4">
      <br />
        <h1>Register</h1>
        <!-- Source: https://getbootstrap.com/docs/4.0/components/forms/ -->
        <form method="POST" action="core/functions/register_script.php" enctype="multipart/form-data" id="RegForm">
          <div class="form-group">
            <label for="email">Email address<span class="err_output" id="email_err"><span></label>
            <input type="email" class="form-control" name="emailaddress" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
          </div>
          <div class="form-group">
            <label for="FirstName">First Name<span class="err_output" id="first_err"><span></label>
            <input type="text" class="form-control" name="first_name" id="FirstName" aria-describedby="emailHelp" placeholder="First Name">
          </div>
          <div class="form-group">
            <label for="LastName">Last Name<span class="err_output" id="last_err"><span></label>
            <input type="text" class="form-control" name="last_name" id="LastName" aria-describedby="emailHelp" placeholder="Last Name">
          </div>
          <div class="form-group">
            <label for="UserType">User Type<span class="err_output" id="usertype_err"><span></label>
            <br />
            <select id="UserType" name="user_type">
                <option>Please Select</option>
                <option value="voter">User</option>
                <option value="admin">Admin</option>
            </select>
          </div>
          <div class="form-group" id="orgDisplay">
            <label for="org">Organisation Name<span class="err_output" id="org_err"><span></label>
            <input type="text" class="form-control" name="org" id="org" placeholder="Organisation Name">
          </div>
          <div class="form-group" id="deptDisplay">
            <label for="department">Department<span class="err_output" id="department_err"><span></label>
            <select multiple class="form-control"  id="department" name="department">
              <option>Operations</option>
              <option>Human Resources</option>
              <option>Finance</option>
              <option>IT/Business Intelligence</option>
              <option>Project Management</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Password">Password<span class="err_output" id="pwd_err"><span></label>
            <input type="password" name="password" class="form-control" id="Password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="Password1">Repeat Password<span class="err_output" id="pwd2_err"><span></label>
            <input type="password" name="password1" class="form-control" id="Password1" placeholder="Repeat Password">
          </div>
          <button type="submit" id="regBtn" class="btn btn-primary">Register</button>&nbsp;
          <button id="loginBtn" class="btn btn-danger">Sign In</button>
          <div style="display:inline;" id="err_output"></div>
        </form>
        <br />
      </div>
      <div class="col-md-4 col-lg-4">
            &nbsp;
      </div>
  </div>
</div>
