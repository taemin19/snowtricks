var $ = require('jquery');

window.Popper = require('popper.js').default;

require('bootstrap');

$(document).ready(function() {
    // loading image on homepage load
    setTimeout(function(){
        $('#homepage .loader').fadeOut('slow', function () {
        });
    },2000);

    // smooth scrolling to anchor
    $('.scroll-to').on('click', function(e) {
        e.preventDefault();
        var section = $(this).attr('href');
        var speed = 750;
        $('html, body').animate( { scrollTop: $(section).offset().top }, speed );
        return false;
    });

    // scroll top button
    $(window).scroll(function() {
        // if user scrolls down - show scroll to top button
        if ($(this).scrollTop() > 200) {
            $('.scroll-top').fadeIn();
        } else {
            $('.scroll-top').fadeOut();
        }

    });

    $('.scroll-top').click(function() {
        $('html, body').animate( { scrollTop: 0 }, 800);
        return false;
    });

    // remove flash message
    setTimeout(function(){
        $('.messages').fadeOut('slow', function () {
        });
    },4000);
});
