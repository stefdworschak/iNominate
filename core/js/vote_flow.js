function voteFlowHandler(){
    var $otp = $('.otp');
    $otp.keyup(function(event){
      var $code='';
      $otp.each(function(){
          $code += $(this).val();
      })
      if($(this).val().length == 1) {
        $(this).blur();
        $($otp[$code.length]).focus();
      }

    })

}
