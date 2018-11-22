function profileHandler(){
    var $contact_btn = $('#contact_btn');
    $contact_btn.click(function(){
        if($('#contact_div').css('display') == 'none'){
            $('#contact_div').show();
        } else {
            $('#contact_div').hide();
        }

    })
}
