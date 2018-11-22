<?php
    ob_start();
    $messages=$c->allSent($_SESSION['userid']);
    $outbox ="";
?>

 <div class="row">
   <div class="card profile_card">
     <h4 class="card-header"><a href="index.php?view=inbox" class="inbox_link">Inbox</a> | Sent<span id="search_div"><input type="text" id="inbox_search"><i class="fas fa-search"></i></span></h4>
     <div class="card-body">
       <table class="table table-hover">
         <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">Sent To</th>
             <th scope="col">Message</th>
             <th scope="col">Received</th>
             <!--Status can be enabled for premium account  like linkedin-->
             <th scope="col">Status</th>
           </tr>
         </thead>
         <tbody>
          <?php
               for($i=0;$i<sizeof($messages);$i++){
                 $status = $messages[$i]['status'] == 0 ? 'Unread' : 'Read';
                 $status_class = $status == 'Unread' ? 'inbox_unread' : 'inbox_read';
                 $classes = 'inbox_message ' . $status_class;
                 $outbox .= "
                   <tr class='inbox_message inbox_read'>
                     <td>" . ($i+1) ."</td>
                     <td>" . $messages[$i]['sent_to'] ."</td>
                     <td>" . substr($messages[$i]['subject'],0,255) . "</td>
                     <td>" . $messages[$i]['received_at'] . "</td>
                     <td>N/A</td>
                     <td style='display:none;'>" . $messages[$i]['message_id'] ."</td>
                   </tr>
                 ";
               }
               echo $outbox;
           ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
