$(document).ready(function(){
  var $orgs = null;
  $('#registerBtn').click(function(){
    event.preventDefault();
    window.location.href="index.php?mode=register";
  })

  $('#loginBtn').click(function(){
    event.preventDefault();
    window.location.href="index.php?mode=login";
  })

  $('#UserType').change(function(){
    $('#orgDisplay').show();
    var $sel = $('#UserType option:selected');
    if($sel.val() == 'voter') {

      var fm = new FormData()
      fm.append('xssid',xssid);
      $.ajax({
        type:'POST',
        url:'core/functions/orgs.php',
        processData: false,
        contentType: false,
        data:fm,
      //  dataType: 'json',
        success:callback
      });

      function callback(res){
        console.log(res);
        var $src = JSON.parse(res);
        $('#org').autocomplete({ source: $src });
        $orgs = res;
      }

    } else {
      $orgs = null;
    }

  });

  $('#regBtn').click(function(){
      event.preventDefault();
      var $errs = $('.err_output')
      $errs.text('');
    /*  $errs.each(function(){
        $(this).text("");
      })*/
      var $email = $('#email').val();
      var $first = $('#FirstName').val();
      var $last = $('#LastName').val();
      var $usertype = $('#UserType').val();
      var $org = $('#org').val() == undefined ? '' : $('#org').val();
      var $pwd = $('#Password').val();
      var $pwd2 = $('#Password1').val();
      //console.log($usertype)
      //console.log(!$org)
      //console.log($orgs.indexOf('') == -1)
      //console.log(!org || ($orgs != null && $orgs.indexOf($org) == -1))
      if(!$email || !$first || !$last || $usertype == 'Please Select' || !$org || !$pwd || !$pwd2){
        if(!$email) { $('#email_err').text("Please enter an email address."); }
        if(!$first) { $('#last_err').text("Please enter your first name"); }
        if(!$last) { $('#first_err').text("Please enter your last name."); }
        if($usertype == 'Please Select') { $('#usertype_err').text("Please select a user type."); }
        if(!$org) { $('#org_err').text("Please enter your organization."); }
        if(!$pwd) { $('#pwd_err').text("Please enter a password."); }
        if(!$pwd2) { $('#pwd2_err').text("Please confirm your password."); }
      } else if($pwd != $pwd2){
        console.log($pwd)
        console.log($pwd2)
          $('#pwd2_err').text("Your passwords do not match.");
      } else if($orgs != null && $orgs.indexOf($org) == -1) {
        $('#org_err').text("Please select from the list of existing companies or register your company as admin!");
      } else {
        $('#RegForm').submit();
      }
  });

  $('.my_profile_img').hover(function(){
    $('.edit_img').css('display','block');
  }).mouseout(function(){
    $('.edit_img').css('display','none');
  })

  $('.edit_img').hover(function(){
    $('.edit_img').css('display','block');
  }).mouseout(function(){
    $('.edit_img').css('display','none');
  })

  $('.edit_img').click(function(){
    window.location.href="index.php?view=upload_photo"
  });

  $('#upload_photo').change(function(ev){
    console.log($(this));
    console.log(ev);
    var reader = new FileReader();
    reader.onload = function (e) {
      var $img = $('#display_photo').html('<h5>Preview:</h5><img id="temp_photo" src="' + e.target.result + '" alt="Temporary Profile Foto" style="width:200px;height:200px;"/>');
    };
    reader.readAsDataURL($(this)[0].files[0]);
    $('#submit_photo').css('display','block');
  })

})
