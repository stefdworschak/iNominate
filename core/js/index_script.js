$(document).ready(function(){
  $('#registerBtn').click(function(){
    event.preventDefault();
    window.location.href="index.php?mode=register";
  })

  $('#loginBtn').click(function(){
    event.preventDefault();
    window.location.href="index.php?mode=login";
  })
})
