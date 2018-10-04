$(document).ready(function(){
  $('#registerBtn').click(function(){
    event.preventDefault();
    window.location.href="index.php?mode=register";
  })

  $('#loginBtn').click(function(){
    event.preventDefault();
    window.location.href="index.php?mode=login";
  })
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
