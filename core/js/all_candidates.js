function allCandidatesHandler(){
  var $win = window.location.href;
  if($win.indexOf('index.php?view=candidates') != -1){

    $("#search").keyup(function(){
      var $search = $(this).val();
      var $name=$('.candidate_name');
      var $title=$('.election_title');
      var $dept=$('.election_department');
      var $end=$('.election_end');

      for(var i=0;i<$name.length;i++){
        if($name[i].innerText.indexOf($search) == -1 && $title[i].innerText.indexOf($search) == -1 &&
        $dept[i].innerText.indexOf($search) == -1 && $end[i].innerText.indexOf($search) == -1){
          $($name[i]).parent().parent().parent().parent().hide();
          console.log
        } else {
          $($name[i]).parent().parent().parent().parent().show();
        }
      }
    })


  }
}
