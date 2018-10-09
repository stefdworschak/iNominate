<?php
  if(!isset($_SESSION)) {
    header('Location:../../../index.php');
  }
?>

<div class="container">
    <div class="row">
      <div class="card profile_card">
        <h4 class="card-header">Create New Election</h4>
        <div class="card-body">

          <form>
            <div class="form-group">
              <label for="election_title">Title</label>
              <input type="text" class="form-control" id="election_title" name="election_title" placeholder="Title" maxlength="50">
            </div>

            <div class="form-group">
              <label for="election_description">Description</label>
              <textarea class="form-control" id="election_description" name="election_description" rows="3" maxlength="255"></textarea>
            </div>

            <div class="form-group">
              <label for="election_categories">Department</label>
              <select multiple class="form-control"  id="election_categories" name="election_categories">
                <option>Operations</option>
                <option>Human Resources</option>
                <option>Finance</option>
                <option>IT/Business Intelligence</option>
                <option>Project Management</option>
              </select>
            </div>

            <div class="form-group">
              <label for="election_numcandidates">Max. Candidates</label>
              <input type="number" class="form-control" id="election_numcandidates" name="election_numcandidates" value="10">
            </div>

            <div class="form-row">
              <div class="col-md-2 mb-">
                  <label for="election_expirydate">Expiry Date</label>
                  <input type="datetime" class="form-control" id="election_expirydate" name="election_expirydate">
              </div>
              <div class="col-md-2 mb-3">
                  <label for="election_expirydate">Time</label>
                  <input type="datetime" class="form-control" id="election_expirydate" name="election_expirydate">
              </div>
              <!--<div class="col-md-3 mb-3">
                  <label for="election_expirydate">Timezone</label>
                  <input type="datetime" class="form-control" id="election_expirydate" name="election_expirydate">
              </div>-->
              <div class="col-md-8 mb-3">
                  &nbsp;
              </div>
            </div>

            <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" name="election_creation" />
            <button type="submit" class="btn btn-primary">Create Election</button> &nbsp;
            <button id="registerBtn" class="btn btn-danger">Cancel</button>

          </form>

      </div>
    </div>
  </div>
</div>
