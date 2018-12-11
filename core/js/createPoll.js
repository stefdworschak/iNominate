function createPollHandler(){
  $('#createPollFrm').submit(function(event){
    var $q = $('#poll_question').val();
    var $opt1 = $('#opt1').val();
    var $opt2 = $('#opt2').val();
    var $range = $('#poll_range option:selected').val();
    var $exp_date = $('#poll_expirydate').val();
    var $exp_time = $('#poll_expirytime').val();

    if(!$q || !$opt1 || !$opt2 || $range == undefined || !$exp_date || !$exp_time) {
        event.preventDefault();
        if(!$q){
          $('#q_err').text('Please enter a Poll Question!');
        }
        if(!$opt1 || !$opt2){
          $('#opt1_err').text('Please enter at least Option 1 and 2!');
          $('#opt2_err').text('Please enter at least Option 1 and 2!');
        }
        if($range == undefined){
          $('#range_err').text('Please enter an Audience Range!');
        }
        if(!$exp_date){
          $('#expDate_err').text('Please enter an Expiry Date!');
        }
        if(!$exp_time){
          $('#expTime_err').text('Please enter an Expiry Time!');
        }
    }

  })
}
