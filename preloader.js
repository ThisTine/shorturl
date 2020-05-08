$(document).ready(function () {
    setTimeout(function(){
        $('#preloader').fadeOut('slow');
    },300);
    $("#menu").click(function(e){
        e.preventDefault();
        var href = $(this).attr("href");
        $('#preloader').fadeIn('slow');
        setTimeout(function(){
            window.open(href,"_self");
        },500);
    });
});