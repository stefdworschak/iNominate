function inboxHandler(){

    $('tr.inbox_message').click(function(){
      var $message_id = Number($(this).children()[5].innerText);
      if(window.location.href.indexOf("outbox") != -1){
          window.location.href='index.php?view=message&msg='+$message_id+'&readonly=1'
      } else {
          var fm = new FormData();
          fm.append('xssid',xssid);
          fm.append('message_id',$message_id);
          $.ajax({
            type:'POST',
            url:'core/functions/message_read.php',
            processData: false,
            contentType: false,
            data:fm,
          //  dataType: 'json',
            success:function(res){
              console.log(res);
              window.location.href='index.php?view=message&msg='+$message_id;
            }
          });
    }

    })

    //For message.php
    $('#replyBtn').click(function(){
      if($('#reply_div').css('display') == 'none'){
          $('#reply_div').show();
      } else{
          $('#reply_div').hide();
      }
    })


}
