/*  ---------------------------------------------------
    Description: Admin Section Main Scripts

         1. All Rooms Table init
         2. Add Room Form Submitter
         3. DashBoard On Start
         4. Ajax Requests
         5. Reservation Ajax
         6. Restaurant Ajax
         7. ItemRequest Ajax
         8. Settings Ajax
         9. Log Out

---------------------------------------------------------  */

(function ($) {
    'use strict';


//2. Add Room Form Submitter
    $(document).ready(function () {
        $('#addRoomBtn').on("click", function () {
            $.post('Features/Room/addRoom.php', {
                'roomNumber': document.getElementById('roomNumber').value,
                'rentPerNight': document.getElementById('rentPerNight').value,
                'telNum': document.getElementById('telNum').value,
                'badCapacity': document.getElementById('badCapacity').value,
                'roomType': document.getElementById('roomType').value,
                'roomDescription': document.getElementById('roomDescription').value

            }, function (data, status) {
                if (status === 'success') {
                    document.getElementById('MSG').innerHTML = data;
                }
            })
        })
    });

})(jQuery);
//End jQuery


// AJAX for Editing Room
function EditRoom(roomID) {
    setLoader();
    $.post('Features/Room/EditRoom.php', {
        'EditRoom': 'EditRoom',
        'room_id': roomID
    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}

function submitChangingRoom(roomID) {
    $.post('Features/Room/EditRoom.php', {
        'room_id_Edit': roomID,
        'roomNumberEdit': document.getElementById('roomNumberEdit').value,
        'rentPerNightEdit': document.getElementById('rentPerNightEdit').value,
        'telNumEdit': document.getElementById('telNumEdit').value,
        'badCapacityEdit': document.getElementById('badCapacityEdit').value,
        'roomTypeEdit': document.getElementById('roomTypeEdit').value,
        'roomDescriptionEdit': document.getElementById('roomDescriptionEdit').value

    }, function (data, status) {
        if (status === 'success') {
            document.getElementById('MSG').innerHTML = data;
        }
    })
}

function allRooms() {
    setLoader();
    $.post('Features/Room/AllRooms.php', {}, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
            if ($("#rooms").length > 0) {
                var table = $('#rooms').DataTable({
                    "scrollX": true,
                    responsive: true
                });
            }
        }
    })
}
