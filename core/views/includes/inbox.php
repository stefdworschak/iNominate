<?php
    ob_start();
    $messages=$c->allMessages($_SESSION['userid']);
    $inbox ="";
?>

 <div class="row">
   <div class="card profile_card">
     <h4 class="card-header">Inbox | <a href="index.php?view=outbox" class="inbox_link">Sent</a> <span id="search_div"><input type="text" id="inbox_search"><i class="fas fa-search"></i></span></h4>
     <div class="card-body">
       <table class="table table-hover">
         <thead>
           <tr>
             <th scope="col">#</th>
             <th scope="col">From</th>
             <th scope="col">Message</th>
             <th scope="col">Received</th>
             <th scope="col">Status</th>
           </tr>
         </thead>
         <tbody>
          <?php
               for($i=0;$i<sizeof($messages);$i++){
                 $status = $messages[$i]['status'] == 0 ? 'Unread' : 'Read';
                 $status_class = $status == 'Unread' ? 'inbox_unread' : 'inbox_read';
                 $classes = 'inbox_message ' . $status_class;
                 $inbox .= "
                   <tr class='" . $classes ."'>
                     <td>" . ($i+1) ."</td>
                     <td>" . $messages[$i]['sent_from'] ."</td>
                     <td>" . substr($messages[$i]['subject'],0,255) . "</td>
                     <td>" . $messages[$i]['received_at'] . "</td>
                     <td>" . $status ."</td>
                     <td style='display:none;'>" . $messages[$i]['message_id'] ."</td>
                   </tr>
                 ";
               }
               echo $inbox;
           ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
