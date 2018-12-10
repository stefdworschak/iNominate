function selectCandidates(){
      $('#selected_candidate').html('');
      /*$('.card.border-secondary.mb-3').each(function(){
        $(this).removeClass('selected_candidate');
      })*/
      $(this).addClass('selected_candidate');
      var $can = $($($($(this).children()[0]).children()[0]).children()[1]).children()[0].innerText;
      var $can_id = $($($($(this).children()[0]).children()[0]).children()[1]).children()[2].innerText;
      var $multi = $($($($($(this).children()[0]).children()[1]).children()[1]).children()[0]);
      console.log(Number($can_id));
      //$('#selected_candidate').text('Selected: '+$can)
      if($('#candidate_id').val() == ''){
          $('#candidate_id').val($can_id);
          $multi.show();
          $multi.text('1');
          $(this).off();
      } else if($('#candidate_id').val() != '' && $('#candidate_id2').val() == ''){
          $('#candidate_id2').val($can_id);
          $multi.show();
          $multi.text('2');
          $(this).off();
      } else if($('#candidate_id').val() != '' && $('#candidate_id2').val() != '' && $('#candidate_id3').val() == ''){
          $('#candidate_id3').val($can_id);
          $multi.show();
          $multi.text('3');
          $('#next').prop('disabled',false);
          $('.card.border-secondary.mb-3').off();
      } else {
        $('#selected_candidate').html('<span class="err_output" style="font-size:0.8em">You have already chosed all of your votes!</span>');
      }
      $('#clearCandidates').css('display','inline');

}

function selectCandidateHandler(){
  $('.card.border-secondary.mb-3').click(selectCandidates);

  $('#clearCandidates').click(function(){
    $('.card.border-secondary.mb-3').click(selectCandidates);
    $('#candidate_id').val('');
    $('#candidate_id2').val('');
    $('#candidate_id3').val('');
    $('.card.border-secondary.mb-3').each(function(){
      $(this).removeClass('selected_candidate');
    })
    $('.multiplicator').hide();
    $('.multiplicator').text('');
    $('#next').prop('disabled',true);
  })
  $('#frmCandidate').submit(function(event){
    console.log($('#candidate_id').val())
    if(!$('#candidate_id').val()){
      $('#selected_candidate').html('<span class="err_output" style="font-size:0.8em">Please select a candidate!</span>');
      event.preventDefault();
    }
  })
}
