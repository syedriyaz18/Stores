$(function () {
    var stickyRibbonTop = $('#stickyribbon').offset().top;

    $(window).scroll(function () {
        if ($(window).scrollTop() > stickyRibbonTop) {
            $('#stickyribbon').css({ position: 'fixed', top: '0px' });
        } else {
            $('#stickyribbon').css({ position: 'static', top: '0px' });
        }
    });
});