var $ = require('jquery');

window.Popper = require('popper.js').default;

require('bootstrap');

var $imageHolder;
var $videoHolder;

$(document).ready(function() {
    $imageHolder = $('div#trick_form_images');
    $videoHolder = $('div#trick_form_videos');

    var index = $imageHolder.find(':input').length;
    var indexVideo = $videoHolder.find(':input').length;

    $('#add_image').click(function(e) {
        addImage($imageHolder);

        e.preventDefault();
        return false;
    });
    $('#add_video').click(function(e) {
        addVideo($videoHolder);

        e.preventDefault();
        return false;
    });

    if (index === 0) {
        addImage($imageHolder);
    } else {
        $imageHolder.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    if (indexVideo === 0) {
        addVideo($videoHolder);
    } else {
        $videoHolder.children('div').each(function() {
            addDeleteLink($(this));
        });
    }

    function addImage($imageHolder) {
        var template = $imageHolder.attr('data-prototype')
            .replace(/__name__label__/g, 'Image n°' + (index+1))
            .replace(/__name__/g,        index)
        ;

        var $prototype = $(template);

        addDeleteLink($prototype);

        $imageHolder.append($prototype);

        index++;
    }
    function addVideo($videoHolder) {
        var template = $videoHolder.attr('data-prototype')
            .replace(/__name__label__/g, 'Video n°' + (indexVideo+1))
            .replace(/__name__/g,        indexVideo)
        ;

        var $prototype = $(template);

        addDeleteLink($prototype);

        $videoHolder.append($prototype);

        indexVideo++;
    }

    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#" class="btn btn-sm btn-danger">Delete</a>');

        $prototype.append($deleteLink);

        $deleteLink.click(function(e) {
            $prototype.remove();

            e.preventDefault();
            return false;
        });
    }
});
