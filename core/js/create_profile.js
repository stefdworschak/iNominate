function createProfileHandler() {
  $('#regCandidatePro').submit(function(event){
    clearFields();
    var $mission = $('#mission_statement').val();
    var $areas = $('#areas_of_interest').val();
    var $policies = $('#policies').val();
    var $motto = $('#motto').val();
    if(!$mission || !$areas || !$policies || !$motto) {
        event.preventDefault();
        if(!$mission) {$('#mission_err').text('Please fill in your Mission Statement!');}
        if(!$areas) {$('#areas_err').text('Please fill in your Areas of Interest!');}
        if(!$policies) {$('#policies_err').text('Please fill in your Policies!');}
        if(!$motto) {$('#motto_err').text('Please fill in your Election Motto!');}
    }
  })

  function clearFields(){
    $('#mission_err').text('');
    $('#areas_err').text('');
    $('#policies_err').text('');
    $('#motto').text('');
  }
}
