<?php
  ob_start();
  $message_id = isset($_GET['msg']) == '' || !isset($_GET['msg']) ? -1 : $_GET['msg'];
  if($message_id == -1){
    echo $message_id;
    header('Location:index.php?view=inbox');
  } else {
    $row=$c->getMessage($message_id, $_SESSION['userid']);
    $message = $row['message'];

    if(strpos($message, 'link="') !== false){
      preg_match_all('/(["]=?)(.*)?(?=["])/',$message, $li);
      preg_match_all('/([(]=?)(.*)?(?=[)])/',$message, $l);
      $link=$li[2][0];
      $label=$l[2][0];
      $nm=preg_replace('/\[.*\)/','<a href="'.$link.'">'.$label.'</a>',$row['message']);
    } else {
        $nm = $message;
    }

    if(sizeof($row) == 0){
      echo $message_id;
      echo $_SESSION['userid'];
      //header('Location:index.php?view=inbox');
    } else {
      $c->messageRead($message_id, $_SESSION['userid']);
    }
  }
?>
 <div class="row">
   <div class="card profile_card">
     <h4 class="card-header">Read Message</h4>
     <div class="card-body">

       <div class="row">

         <div class="col-6">

               <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><strong>Sent From</strong></span>
                </div>
                <input type="text" class="form-control message_field" value="<?php echo $row['sent_from']; ?>" disabled>
              </div>

        </div>

        <div class="col-6">

              <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text"><strong>Received At</strong></span>
               </div>
               <input type="text" class="form-control message_field" value="<?php echo $row['received_at']; ?>" disabled>
             </div>

       </div>

      </div>

      <div class="row">

          <div class="col-12">

            <div class="input-group mb-3">
             <div class="input-group-prepend">
               <span class="input-group-text"><strong>Subject</strong></span>
             </div>
             <input type="text" class="form-control message_field" value="<?php echo $row['subject']; ?>" disabled>
           </div>

          </div>

      </div>
       <div class="row">

            <div class="col-12">
                  <div class="form-group">
                  <!--  <label for="exampleFormControlTextarea1">Example textarea</label>-->
                    <div class="form-control message_field" id="messageTextfield" style="white-space: pre-wrap; min-height:150px;" disabled><?php echo $nm; ?></div>
                  </div>
            </div>

       </div>
       <div class="row message_row">
         <div class="col-12">
              <?php
                $readonly = isset($_GET['readonly']) ? 1 : 0;
                echo $readonly == 1 ? '' : '<input type="submit" class="btn btn-primary" value="Reply" id="replyBtn" />';
                ?>
         </div>
       </div>
       <div class="row message_row">
         <div class="col-12">
           <div class="form-group profile_text" id="reply_div">
             <form method="POST" action="core/functions/send_message.php" enctype="multipart/form-data">
                 <input type="hidden" value="<?php echo $_SESSION['xssid']; ?>" name="xssid" />
                 <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" name="from_id" />
                 <input type="hidden" value="<?php echo $pro['from_id']; ?>" name="to_id" />
                 <input type="hidden" value="<?php echo $message_id . $_SESSION['userid'] . $pro['from_id']; ?>" name="thread_id" />
                 <input class="form-control" type="text" placeholder="Subject" name="subject" style="width:100%; margin-bottom:10px;" />
                 <textarea class="form-control" id="contact" style="width:100%;height:100px;" name="message" placeholder="Messge" style="white-space: pre-wrap;"></textarea>
                 <input type="submit" value="Send" class="btn btn-success" />
               </form>
           </div>
         </div>
       </div>
      </div>
    </div>
  </div>
