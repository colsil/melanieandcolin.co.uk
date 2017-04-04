// keep track of how many room bookings have been rendered
var roomCount = $(".roomlisting").length;

function addRoomDeleteLink(roomListing) {
    var $removeButton = $('<button class="btn btn-danger">Remove Room Booking</button>');
    roomListing.append($removeButton);

    $removeButton.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        roomListing.remove();
    });
}

$(document).ready(function() {

    // Get the div that holds the collection of rooms
    $collectionHolder = $('#rooms-list');

    // add a delete link to all of the existing room listing elements
    $collectionHolder.find('.roomlisting').each(function() {
        addRoomDeleteLink($(this));
    });

    $('#add-another-room').click(function(e) {
        e.preventDefault();


        var roomList = $('#rooms-list');

        // grab the prototype template
        var newWidget = roomList.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your room
        newWidget = newWidget.replace(/__name__/g, roomCount);
        roomCount++;

        // create a new div row and add it to the list
        var newRoom = $(newWidget);
        // add a delete link to the new room listing
        addRoomDeleteLink(newRoom);

        newRoom.appendTo(roomList);
    });

});
