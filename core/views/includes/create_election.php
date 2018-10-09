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

          <form method="POST" action="core/functions/create_election.php" enctype="multipart/form-data" id="CreateElectionForm">
            <div class="form-group">
              <label for="election_title">Title</label>
              <input type="text" class="form-control" id="election_title" name="election_title" placeholder="Title" maxlength="50">
            </div>

            <div class="form-group">
              <label for="election_description">Description</label>
              <textarea class="form-control" id="election_description" name="election_description" rows="3" maxlength="255"></textarea>
            </div>

            <div class="form-group">
              <label for="election_department">Department</label>
              <select multiple class="form-control"  id="election_department" name="election_department">
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
              <div class="col-md-3 mb-">
                  <label for="election_expirydate">Expiry Date</label>
                  <input type="date" class="form-control" id="election_expirydate" name="election_expirydate">
              </div>
              <div class="col-md-2 mb-3">
                  <label for="election_expirytime">Time</label>
                  <input type="time" class="form-control" id="election_expirytime" name="election_expirytime">
              </div>
              <!--<div class="col-md-3 mb-3">
                  <label for="election_expirydate">Timezone</label>
                  <input type="datetime" class="form-control" id="election_expirydate" name="election_expirydate">
              </div>-->
              <div class="col-md-7 mb-3">
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
