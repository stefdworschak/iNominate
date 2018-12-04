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
    $('.card.border-secondary.mb-3').click(function(){
        $('#selected_candidate').html('');
        $('.card.border-secondary.mb-3').each(function(){
          $(this).removeClass('selected_candidate');
        })
        $(this).addClass('selected_candidate');
        var $can = $($($($(this).children()[0]).children()[0]).children()[1]).children()[0].innerText;
        var $can_id = $($($($(this).children()[0]).children()[0]).children()[1]).children()[2].innerText;
        console.log(Number($can_id));
        $('#selected_candidate').text('Selected: '+$can)
        $('#candidate_id').val($can_id);
    })

    $('#frmCandidate').submit(function(){
      console.log($('#candidate_id').val())
      if(!$('#candidate_id').val()){
        $('#selected_candidate').html('<span class="err_output" style="font-size:0.8em">Please select a candidate!</span>');
        event.preventDefault();
      }
    })
  })
</script>


<div class="row">
  <div class="card profile_card">
    <h4 class="card-header">Select A Candidate
      <span class="next_btn"><span id="selected_candidate"></span>
        <form method="POST" action="index.php?view=confirm_vote" enctype="multipart/form-data" style="display:inline;" id="frmCandidate">
          <input type="hidden" name="candidate_id" id="candidate_id" />
          <input type="hidden" name="election_id" id="election_id" value="<?php echo $election_id; ?>" />
          <button class="btn btn-primary custom-danger">Next</button>
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
