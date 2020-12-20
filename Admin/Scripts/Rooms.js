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

    // $(document).ready(function () {
    //     if ($("#zdrop").length > 0) {
    //         var previewNode = document.querySelector("#zdrop-template");
    //         previewNode.id = "";
    //         var previewTemplate = previewNode.parentNode.innerHTML;
    //         previewNode.parentNode.removeChild(previewNode);
    //
    //
    //         var zdrop = new Dropzone("#zdrop", {
    //             url: 'Features/Room/addRoom.php',
    //             maxFiles: 1,
    //             maxFilesize: 30,
    //             previewTemplate: previewTemplate,
    //             previewsContainer: "#previews",
    //             acceptedFiles: ".jpeg,.jpg,.png",
    //             clickable: "#upload-label",
    //         });
    //
    //         zdrop.on("addedfile", function (file) {
    //             $('.preview-container').css('visibility', 'visible');
    //         });
    //
    //         zdrop.on("totaluploadprogress", function (progress) {
    //             var progr = document.querySelector(".progress .determinate");
    //             if (progr === undefined || progr === null)
    //                 return;
    //
    //             progr.style.width = progress + "%";
    //         });
    //
    //         zdrop.on('dragenter', function () {
    //             $('.fileuploader').addClass("active");
    //         });
    //
    //         zdrop.on('dragleave', function () {
    //             $('.fileuploader').removeClass("active");
    //         });
    //
    //         zdrop.on('drop', function () {
    //             $('.fileuploader').removeClass("active");
    //         });
    //     }
    // })
})(jQuery);
//End jQuery


// AJAX for Editing Room
function EditRoom(roomID) {

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
    $.post('Features/Room/AllRooms.php', {}, function (data, status) {
        if (status === 'success') {
            document.getElementById('content').innerHTML = data;
        }
    })
}
