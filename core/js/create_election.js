function electionHandler(){

  $('#createEleBtn').click(function(event){
    event.preventDefault();
    var $errs = $('.err_output')
    $errs.text('');

    var $title = $('#election_title').val();
    var $desc = $('#election_description').val();
    var $dept = $('#election_department option:selected').val();
    var $cand = $('#election_numcandidates').val();
    var $roles = $('#election_numroles').val();
    var $date = $('#election_expirydate').val();
    var $time = $('#election_expirytime').val();

    console.log($roles);
    console.log($cand);

    var $now = new Date().getTime();
    var $exDate = new Date($date + ' ' + $time).getTime();

    if(!$title || !$desc || !$cand || $dept == undefined || !$date || !$time || !$roles) {

      if(!$title){
        $('#title_err').text('Please enter a Title!');
      }
      if(!$desc){
        $('#description_err').text('Please enter an Description!');
      }
      if(!$dept){
        $('#department_err').text('Please select a Department!');
      }
      if(!$cand){
        $('#numcandidates_err').text('Please enter the maxi. Number of Candidates!');
      }
      if(!$date){
        $('#expDate_err').text('Please enter an Expiry Date!');
      }
      if(!$time){
        $('#expTime_err').text('Please enter an Expiry Time!');
      }
      if(!$roles){
        $('#numroles_err').text('Please enter how many Roles are available!');
      }

    } else if($title.length > 50) {
      $('#title_err').text('The title is too long! Only 50 characters allowed.');
    } else if($desc.length > 255) {
      $('#description_err').text('The title is too long! Only 255 characters allowed.');
    } else if(Number($cand) < Number($roles)) {
      $('#numroles_err').text('The number of roles cannot be bigger than the candidates.');
    } else if($exDate < $now){
      $('#expTime_err').text('You cannot choose a date/time the past.');
    } else {
      $('#CreateElectionForm').submit();
      //alert("successfully created");
    }

  })

  $('#cancelEleBtn').click(function(event){
    event.preventDefault();
    window.location.href = "index.php?view=admin_panel";
  })

}
