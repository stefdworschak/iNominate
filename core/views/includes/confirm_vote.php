<?php
  if(!$_POST){
    header('Location:index.php?view=elections');
  } else {
    $otp=generateOTP(4, $ENVIROMENT_PATH, $EMAIL_VAR);

    if($otp[1] > time()){
      print_r($otp);
    }
    $candidate_id = isset($_POST['candidate_id']) ? $_POST['candidate_id'] : 0;
    $candidate_id2 = isset($_POST['candidate_id2']) ? $_POST['candidate_id2'] : 0;
    $candidate_id3 = isset($_POST['candidate_id3']) ? $_POST['candidate_id3'] : 0;
    $election_id = isset($_POST['election_id']) ? $_POST['election_id'] : 0;
    if($candidate_id == 0 || $election_id == 0){
        header('Location:index.php?view=elections');
    }
  }

?>

<div class="row">
  <div class="card profile_card">
    <h4 class="card-header">Voting Confirmation </h4>
    <div class="card-body text-center">

        <h5>We have sent a One-Time Password to the email address registered to your account. <br />
        Please enter the code now to verify your identity and confirm your vote.</h5>
        <br />
        <input type="text" class="otp" maxlength="4" /><input type="text" class="otp" maxlength="1" /><input type="text" class="otp" maxlength="1" /><input type="text" class="otp" maxlength="1" />
        <br /><br />
        <form method="POST" action="core/functions/vote.php" enctype="multipart/form-data" style="display:inline;">
            <input type="hidden" name="candidate_id" value="<?php echo $candidate_id; ?>" />
            <input type="hidden" name="candidate_id2" value="<?php echo $candidate_id2; ?>" />
            <input type="hidden" name="candidate_id3" value="<?php echo $candidate_id3; ?>" />
            <input type="hidden" name="election_id" value="<?php echo $election_id; ?>" />
            <button type="submit" class="btn btn-danger custom-danger">Validate</button>
        </form>
        <br /><br />
        <a href="#">Resend One-Time password</a>


      </div>
   </div>
</div>
