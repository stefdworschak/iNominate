<?php
  if($_SESSION['existing_candidate']==1){
      header('Location:index.php');
  } else{
      $_SESSION['existing_candidate']=1;
      $election_id = isset($_GET['election_id']) ? $_GET['election_id'] : 0;
      if($election_id == 0) {
          header('Location:../../index.php?err=no_election_specified');
      }
  }
 ?>

<div class="row">
  <div class="card profile_card">
    <h4 class="card-header">Create Candidate Profile <span id="search_div"><input type="text" id="search"><i class="fas fa-search"></i></span></h4>
    <div class="card-body">

      <form method='POST' action='core/functions/create_candidate_profile.php' enctype='multipart/form-data' id="regCandidatePro">
        <div class="form-group">
            <h5 class="card-title profile_subtitle">Election Motto<span class="err_output" id="motto_err"><span></h5>
            <input type="text" class="form-control" rows="1" id="motto" name="motto" />
        </div>
        <div class="form-group">
            <h5 class="card-title profile_subtitle">Mission Statement<span class="err_output" id="mission_err"><span></h5>
            <textarea class="form-control" rows="5" id="mission_statement" name="mission_statement"></textarea>
        </div>

        <div class="form-group">
            <h5 class="card-title profile_subtitle">Policies<span class="err_output" id="policies_err"><span></h5>
            <textarea class="form-control" rows="5" id="policies" name="policies"></textarea>
        </div>

        <div class="form-group">
            <h5 class="card-title profile_subtitle">Areas of Interest<span class="err_output" id="areas_err"><span></h5>
            <textarea class="form-control" rows="5" id="areas_of_interest" name="areas_of_interest"></textarea>
        </div>
        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid']; ?>" />
        <input type="hidden" name="election_id" value="<?php echo $election_id; ?>" />
        <button type="submit" class="btn btn-primary">Create Profile</button>
        <button class="btn btn-danger">Cancel</button>
      </form>

    </div>
  </div>
</div>
