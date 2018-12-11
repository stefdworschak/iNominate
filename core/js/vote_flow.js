function voteFlowHandler(){
    var $otp = $('.otp');
    $otp.keyup(function(event){
    //  event.preventDefault();
      if($otp.val().length == 4){
        $otp.blur();
      }
    })
    $otp.on('paste',function(event){
      if($otp.val().length == 4){
        $otp.blur();
      }
    })

}
