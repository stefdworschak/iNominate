<?php
  $poll_id = !isset($_GET['poll_id']) ? 0 : $_GET['poll_id'];
  if($poll_id == 0){
    header('Location:index.php');
  } else{
    $check=$c->checkPolled($poll_id, $_SESSION['userid']);
    if($check > 0){
      header('Location:index.php?view=inbox');
    } else {
      $poll=$c->fetchPoll($poll_id);
    }

  }

 ?>

 <div class="alert alert-primary" role="alert">
   <h5>Question</h5>
  <?php echo $poll['question']; ?>
</div>
<div class="alert alert-info poll_answers" role="alert">
  <h5>Possible Answers</h5>
  <form method="POST" action="core/functions/answer_poll.php" enctype="multipart/form-data" id="LoginFrm">
  <div class="custom-control custom-radio">
   <input type="radio" id="customRadio1" name="answer" class="custom-control-input" >
   <label class="custom-control-label" for="customRadio1"><?php echo $poll['opt1']; ?></label>
 </div>
 <div class="custom-control custom-radio">
  <input type="radio" id="customRadio2" name="answer" class="custom-control-input" >
  <label class="custom-control-label" for="customRadio2"><?php echo $poll['opt2']; ?></label>
</div>
 <?php if($poll['opt3'] != ''){
   echo '<div class="custom-control custom-radio">
    <input type="radio" id="customRadio3" name="answer" class="custom-control-input">
    <label class="custom-control-label" for="customRadio3">' .$poll['opt3'] .'</label>
   </div>';
 } ?>
 <?php if($poll['opt4'] != ''){
   echo '<div class="custom-control custom-radio">
    <input type="radio" id="customRadio4" name="answer" class="custom-control-input">
    <label class="custom-control-label" for="customRadio4">' .$poll['opt3'] .'</label>
   </div>';
 } ?>
 <?php if($poll['opt5'] != ''){
   echo '<div class="custom-control custom-radio">
    <input type="radio" id="customRadio5" name="answer" class="custom-control-input">
    <label class="custom-control-label" for="customRadio5">' .$poll['opt3'] .'</label>
   </div>';
 } ?>
 <input type="hidden" value="<?php echo $poll_id; ?>" name="poll_id" />

</div>
<button class="btn btn-primary">Submit</button>
</form>
