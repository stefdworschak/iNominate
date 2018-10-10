function electionHandler(){

  $('#createEleBtn').click(function(){
    event.preventDefault();

  })

  $('#cancelEleBtn').click(function(){
    event.preventDefault();
    window.location.href = "index.php?view=admin_panel";
  })

}
