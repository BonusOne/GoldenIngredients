$(document).ready(function() {
    
    $('.CookiesGot').click(function(){
        $.ajax({
            type: "POST", 
            url: "/index/acceptCookies",
            data: {acceptCookies: true},
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.status+" ERR : "+textStatus+" / "+errorThrown);
            },
        }).done(function(data, textStatus, jQxhr) {
            $('.CookiesBox').css('height','0');
            $('.CookiesBox').hide('fast');
        });
    });
    
    
});