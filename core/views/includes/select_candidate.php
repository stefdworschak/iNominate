<?php

  $election_id = isset($_POST['election_id']) ? $_POST['election_id'] : 0;
  $html="";
  if($election_id == 0) {
      header('Location:index.php?view=elections');
  } else {
      $candidates=$c->getElectionCandidates($election_id);
      //print_r($candidates);
      for($i=0; $i<sizeof($candidates); $i++){
          $img = $candidates[$i]['img_link'] == '' ? 'core/img/portrait.png' : $candidates[$i]['img_link'];
          $html .= "
            <div class='card border-secondary mb-3' style='width:100%;'>
            <div class='card-body text-secondary'>
              <!--<img src='" . $img . "' style='width:100px;float:left; margin-right:10px; border:1px solid darkgray; border-radius:5px;' />
              <h5 class='card-title'>" . $candidates[$i]['candidate_name'] . "</h5>
              <p class='card-text'><i>" . $candidates[$i]['motto'] . "</i></p>
              <div style='clear:both;margin-top:25px;'>
                <button class='btn primary'>See Profile</button>
              </div>-->
              <div class='row'>
                <div class='col-md-2'>
                  <img src='" . $img . "' style='width:100px;float:left; margin-right:10px; border:1px solid darkgray; border-radius:5px;' />
                </div>
                <div class='col-md-10'>
                  <h5 class='card-title'>" . $candidates[$i]['candidate_name'] . "</h5>
                  <p class='card-text'><i>" . $candidates[$i]['motto'] . "</i></p>
                  <span style='display:none;'>" . $candidates[$i]['user_id'] . "</span>
                </div>
              </div>
              <div class='row' style='margin-top:5px;'>
                <div class='col-md-2'>
                <a href='index.php?view=profile&id='" . $candidates[$i]['profile_id'] . " class='btn btn-primary'>See Profile</a>
                </div>
                <div class='col-md-10'>
                <div class='text-right multiplicator'></div>
                </div>
              </div>
            </div>
            </div>
          ";
      }
  }


?>
<script>
  $(document).ready(function(){

  })
</script>


<div class="row">
  <div class="card profile_card">
    <h4 class="card-header">Select A Candidate
      <span class="next_btn"><span id="selected_candidate"></span>
        <button class="btn btn-primary" id="clearCandidates" style="display:none;">x</button>
        <form method="POST" action="index.php?view=confirm_vote" enctype="multipart/form-data" style="display:inline;" id="frmCandidate">
          <input type="hidden" name="candidate_id" id="candidate_id" />
          <input type="hidden" name="candidate_id2" id="candidate_id2" />
          <input type="hidden" name="candidate_id3" id="candidate_id3" />
          <input type="hidden" name="election_id" id="election_id" value="<?php echo $election_id; ?>" />
          <button class="btn btn-primary custom-danger" disabled id="next">Next</button>
        </form>
      </span>
    </h4>
    <div class="card-body">

      <?php
        echo $html;
       ?>

    </div>
  </div>
</div>
