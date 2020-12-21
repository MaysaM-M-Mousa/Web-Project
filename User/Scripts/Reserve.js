/*  ---------------------------------------------------
    Description: Reserve Scripts

         1. Form Control Handling (Next,previous)
         2. Date Picker
         3. Room Selector
         4. Validate Date Input

---------------------------------------------------------  */

(function ($) {
// 1. Form Control Handling (Next,previous)
    $(document).ready(function () {
        let current_fs, next_fs, previous_fs; //fieldsets
        let opacity;

        $(".next").click(function () {
            if ($(this).hasClass("next2")) {
                if (!reserveARoom()) {
                    return;
                }
            }
            if ($(this).hasClass("next0")) {
                if (!validateForm()) {
                    return;
                }

            } else {
                let url = "SignUp.php"; // the script where you handle the form input.
            }
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function (now) {
                    // for making fieldset appear animation
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                },
                duration: 500
            });
        });

        $(".previous").click(function () {
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({'opacity': opacity});
                },
                duration: 500
            });
        });

        $(".submit").click(function () {
            current_fs = $(this).parent().parent().parent().parent().parent();
            next_fs = $(this).parent().parent().parent().parent().parent().next();
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function (now) {
                    // for making fieldset appear animation
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({'opacity': opacity});
                },
                duration: 500
            });
            return false;
        })
    });
    $(document).ready(roomSelect());
// 2. Date Picker
    $(function () {
        ej.base.enableRipple(window.ripple)
        var daterangepicker = new ej.calendars.DateRangePicker({
            allowEdit: false,
            min: new Date(),
            cssClass: 'date',
            placeholder: 'Visit Date',
            focus: function () {
                daterangepicker.show();
            }
        });
        daterangepicker.appendTo('#daterangepicker');

    });

})(jQuery);

// 3. Room Selector
function roomSelect() {
    if ($("#room_1").is(':checked')) {
        $('#room_1').parent().addClass('selected-room');
        $('#room_1').next().next().addClass('selected');

    } else {
        $('#room_1').parent().removeClass('selected-room');
        $('#room_1').next().next().removeClass('selected');
    }
    if ($("#room_2").is(':checked')) {
        $('#room_2').parent().addClass('selected-room');
        $('#room_2').next().next().addClass('selected');

    } else {
        $('#room_2').parent().removeClass('selected-room');
        $('#room_2').next().next().removeClass('selected');
    }
    if ($("#room_3").is(':checked')) {
        $('#room_3').parent().addClass('selected-room');
        $('#room_3').next().next().addClass('selected');

    } else {
        $('#room_3').parent().removeClass('selected-room');
        $('#room_3').next().next().removeClass('selected');
    }
    if ($("#room_4").is(':checked')) {
        $('#room_4').parent().addClass('selected-room');
        $('#room_4').next().next().addClass('selected');

    } else {
        $('#room_4').parent().removeClass('selected-room');
        $('#room_4').next().next().removeClass('selected');
    }
}

// 4. Validate Date Input
function validateForm() {
    let date=document.getElementById('daterangepicker').value;
    if (date === "") {
        $("#errorDate").css("display", "block");
        return false;
    } else {
        $("#errorDate").css("display", "none");
        return true;
    }
}

function reserveARoom() {
    var flag=false;
    $.post('Features/Reservation/reserveRoom.php', {
        'reserveRoom': 'reserveRoom',
        'dateRange': document.getElementById('daterangepicker').value,
        'roomType': document.querySelector('input[name="room"]:checked').value
    }, function (data, status) {
        if (status === 'success') {
            if (data === 'You are not allowed to continue') {
                window.location.replace("../Home/PHP/SignIn/logout.php");
            } else {
                $("#MSGBODY").html(data);
                $("#MSGTITLE").html("Ops..");
                $("#trigermsg").click();
                if (data.toString().includes("room No.")) {
                    $("#roomNo").html(data);
                    flag=true;
                }

            }
        }
    })
    return flag;
}
