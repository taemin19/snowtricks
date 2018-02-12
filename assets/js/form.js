var $imageHolder;
var $videoHolder;

var $addImageLink = $('<a href="#" class="btn btn-sm btn-outline-info" role="button"><i class="fa fa-plus pr-2" aria-hidden="true"></i>Add Image</a>');
var $addVideoLink = $('<a href="#" class="btn btn-sm btn-outline-info" role="button"><i class="fa fa-plus pr-2" aria-hidden="true"></i>Add Video</a>');
var $newImageLink = $('<li></li>').append($addImageLink);
var $newVideoLink = $('<li></li>').append($addVideoLink);

$(document).ready(function() {
    // Get the ul that holds the collection of images/videos
    $imageHolder = $('ul.images');
    $videoHolder = $('ul.videos');

    // add a delete link to all of the existing image/video form li elements
    $imageHolder.find('li').each(function() {
        addImageFormDeleteLink($(this));
    });
    $videoHolder.find('li').each(function() {
        addVideoFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $imageHolder.append($newImageLink);
    $videoHolder.append($newVideoLink);

    // count the current form inputs, use that as the new
    // index when inserting a new item
    $imageHolder.data('index', $imageHolder.find(':input').length);
    $videoHolder.data('index', $videoHolder.find(':input').length);

    $addImageLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new image form
        addImageForm($imageHolder, $newImageLink);
    });
    $addVideoLink.on('click', function(e) {
        e.preventDefault();

        addVideoForm($videoHolder, $newVideoLink);
    });

    function addImageForm($imageHolder, $newImageLink) {
        // Get the data-prototype explained earlier
        var prototype = $imageHolder.data('prototype');

        // get the new index
        var index = $imageHolder.data('index');

        var newForm = prototype;
        // if 'label' => false didn't set in images field in TrickType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items
        // newForm = newForm.replace(/__name__label__/g, index);

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items
        newForm = newForm.replace(/__name__/g, index);

        // increase the index with one for the next item
        $imageHolder.data('index', index + 1);

        // Display the form in the page in an li, before the "Add image" link li
        var $newFormLi = $('<li></li>').append(newForm);
        $newImageLink.before($newFormLi);

        // add a delete link to the new form
        addImageFormDeleteLink($newFormLi);
    }
    function addVideoForm($videoHolder, $newVideoLink) {
        var prototype = $videoHolder.data('prototype');

        var index = $videoHolder.data('index');

        var newForm = prototype;

        newForm = newForm.replace(/__name__/g, index);

        $videoHolder.data('index', index + 1);

        var $newFormLi = $('<li></li>').append(newForm);
        $newVideoLink.before($newFormLi);

        addVideoFormDeleteLink($newFormLi);
    }

    function addImageFormDeleteLink($imageFormLi) {
        var $removeFormA = $('<a href="#" class="btn btn-sm btn-outline-danger mb-3">Delete</a>');
        $imageFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // remove the li for the image form
            $imageFormLi.remove();
        });
    }
    function addVideoFormDeleteLink($videoFormLi) {
        var $removeFormA = $('<a href="#" class="btn btn-sm btn-outline-danger mb-3"><i class="fa fa-trash pr-2" aria-hidden="true"></i>Delete</a>');
        $videoFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            e.preventDefault();

            $videoFormLi.remove();
        });
    }
});