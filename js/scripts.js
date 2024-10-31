jQuery(document).ready(function($){
    $('.popup-link').click(function() {
        var newwindow = window.open($(this).prop('href'), '', 'height=500,width=500');
        if (window.focus) {
            newwindow.focus();
        }
        return false;
    });

    $('.newtab').click(function() {
        $(this).target = "_blank";
        window.open($(this).prop('href'));
        return false;
    });
});