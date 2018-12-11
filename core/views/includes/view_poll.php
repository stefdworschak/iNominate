<?php
  $poll_id = !isset($_GET['poll_id']) ? 0 : $_GET['poll_id'];
  if($poll_id == 0){
    header('Location:index.php');
  } else{
    $poll=$c->fetchPoll($poll_id);
  }

 ?>

 <div class="alert alert-primary" role="alert">
   <h5>Question</h5>
  <?php echo $poll['question']; ?>
</div>
<div class="alert alert-info" role="alert">
  <h5>Possible Answers</h5>
  
  <div class="custom-control custom-radio">
   <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
   <label class="custom-control-label" for="customRadio1"><?php echo $poll['opt1']; ?></label>
 </div>
 <div class="custom-control custom-radio">
  <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
  <label class="custom-control-label" for="customRadio1"><?php echo $poll['opt2']; ?></label>
 </div>
 <div class="custom-control custom-radio">
  <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
  <label class="custom-control-label" for="customRadio1"><?php echo $poll['opt3']; ?></label>
 </div>
 <div class="custom-control custom-radio">
  <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
  <label class="custom-control-label" for="customRadio1"><?php echo $poll['opt4']; ?></label>
 </div>
 <div class="custom-control custom-radio">
  <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
  <label class="custom-control-label" for="customRadio1"><?php echo $poll['opt5']; ?></label>
 </div>

</div>
<br />
