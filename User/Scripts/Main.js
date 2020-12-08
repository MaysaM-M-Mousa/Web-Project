/*  ---------------------------------------------------
    Description: User Section Scripts

         1. SideBar Start
         2. Ajax loader
         3. DashBoard On Start
         4. Ajax Requests
         5. Reservation Ajax
         6. Restaurant Ajax
         7. ItemRequest Ajax
         8. Settings Ajax
         9. Log Out

---------------------------------------------------------  */
'use strict';

(function ($) {

// 1. SideBar Start
    $(document).ready(function () {
        (function ($) {

            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function () {
                $('.js-fullheight').css('height', $(window).height());
            });

        })($);
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });


// 2. Ajax loader
        $(document).on({
            ajaxStart: function () {
                $("#content").css("display", "none");
                $("#loader").css("display", "block");
            },
            ajaxStop: function () {
                $('#sidebar').removeClass('active');
                $("#loader").css("display", "none");
                $("#content").css("display", "block");
            }
        });
//3. Load DashBoard On Start
        $(document).ready(function () {
            $("#content").load("Features/Dashboard/dashboard.php");
            $("#dashboard").addClass("active");
        })

//4. Dashboard ajax
        $("#dashboard").click(function () {
            $("#content").load("Features/Dashboard/dashboard.php");
            $(".components li").removeClass("active");
            $("#dashboard").addClass("active");
        })
//5. Reservation Ajax
        $("#reservation").click(function () {
            $("#content").load("Features/Reservation/Reserve.php");
            $(".components li").removeClass("active");
            $("#reservation").addClass("active");
        })

//6. Restaurant Ajax
        $("#restaurant").click(function () {
            $("#content").load("Features/Restaurant/RestaurantCategories.php");
            $(".components li").removeClass("active");
            $("#restaurant").addClass("active");
        })
//7. ItemRequest Ajax
        $("#itemRequest").click(function () {
            $("#content").load("Features/ItemRequest/ItemRequestCategories.php");
            $(".components li").removeClass("active");
            $("#itemRequest").addClass("active");
        })

//8. Settings Ajax
        $("#settings").click(function () {
            $("#content").load("Features/Settings/edit.php");
            $(".components li").removeClass("active");
            $("#settings").addClass("active");
        })
//9. Log Out
        $("#logOut").click(function () {
            window.location.replace("PHP/LogOut/logout.php");
        })

    });

})(jQuery);
//End jQuery

