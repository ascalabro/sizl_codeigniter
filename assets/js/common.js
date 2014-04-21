$(document).ready(function() {
    
    $(".login_form").submit(function() { 
        $('<input />').attr('type', 'hidden').attr('name', "hidden_key").attr('value', "702bd0ce49e52aef1c06329184a7dd2c").appendTo(this);
        return true;
    }).val("");
    
    
});