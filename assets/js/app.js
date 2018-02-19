var $ = require('jquery');

window.Popper = require('popper.js').default;

require('bootstrap');

$(document).ready(function() {
    // loading image on homepage load
    setTimeout(function(){
        $('#homepage .loader').fadeOut('slow', function () {
        });
    },2000);
});
