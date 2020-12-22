/*  ---------------------------------------------------
    Description: Home  Scripts

           1.on scroll animation Initializing
           2. flexslider Initializing
           3.Scroll Up plugin Initializing
           4.Mobile Nav Initializing
           5. magnificPopup Initializing
           6. Login AJAX
           7. email verify

---------------------------------------------------------  */

(function ($) {
//1.on scroll animation Initializing
    AOS.init();
//2. flexslider Initializing
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "fade",
            prevText: "",
            nextText: "",
            slideshow: true

        });
    });
//3.Scroll Up plugin Initializing
    $(document).ready(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            topDistance: '300', // Distance from top before showing element (px)
            topSpeed: 200, // Speed back to top (ms)
            animation: 'fade', // Fade, slide, none
            animationInSpeed: 1000, // Animation in speed (ms)
            animationOutSpeed: 1000, // Animation out speed (ms)
            scrollText: '<i class="far fa-angle-double-up mt-2" style="font-size:2rem"></i>', // Text for element
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
    });
//4.Mobile Nav Initializing
    $(document).ready(function () {
        $(".mobile-menu").slicknav({
            prependTo: '#mobile-menu-wrap',
            allowParentLinks: true
        });
        $(".canvas-open").on('click', function () {
            $(".offcanvas-menu-wrapper").addClass("show-offcanvas-menu-wrapper");
            $(".offcanvas-menu-overlay").addClass("active");
        });

        $(".canvas-close, .offcanvas-menu-overlay").on('click', function () {
            $(".offcanvas-menu-wrapper").removeClass("show-offcanvas-menu-wrapper");
            $(".offcanvas-menu-overlay").removeClass("active");
        });

        $(".mobile-menu").slicknav({
            prependTo: '#mobile-menu-wrap',
            allowParentLinks: true
        });
    });

//5. magnificPopup Initializing
    $(document).ready(function () {
        $('.image-popup').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [1, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: false,
                duration: 300 // don't foget to change the duration also in CSS
            }
        });
    });
// 6. Login AJAX
    $(document).ready(function () {
        $("#loginBTN").on('click', function () {
            $.post('index.php', {
                'person_email': document.getElementById("user_email").value,
                'person_pass': document.getElementById("user_pass").value
            }, function (data, status) {
                if (data === 'You are allowed to log in') {
                    window.location.replace("../../User/index.php");
                } else if (data === 'You are allowed to log in 2') {
                    window.location.replace("../../Admin/index.php");
                    // alert(data);
                } else {
                    document.getElementById('emailNF').innerHTML = data;
                }
            })
        })
    });
    // About us Load for customer item

    $(document).ready(function () {
        $("#aboutus,.aboutmb").on("click", function () {
            document.getElementById('content').innerHTML =
                '<div class="lds-roller text-center mx-auto" style="margin: 20% 0;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
            $.ajax({
                type: 'POST',
                url: 'about.html',
                success:
                    function (data) {
                        setTimeout(function () {
                            $(".active").removeClass("active");
                            $("#aboutus").parent().addClass("active");
                            $("#content").html(data);
                        }, 600);
                    }
            })
        })
    })
    $(document).ready(function () {
        $("#contactus,.contactus").on("click", function () {
            document.getElementById('content').innerHTML =
                '<div class="lds-roller text-center mx-auto" style="margin: 20% 0;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
            $.ajax({
                type: 'POST',
                url: 'contactus.php',
                success:
                    function (data) {
                        setTimeout(function () {
                            $(".active").removeClass("active");
                            $("#contactus").parent().addClass("active");
                            $("#content").html(data);
                        }, 600);
                    }
            })
        })
    });


})(jQuery);

// 7. email verify
function sendEmailVerification() {
    $.post('../PHP/SignUp/verify.php', {'resend': 'resendEmail'}, function (data, status) {
        document.getElementById('verificationDiv').innerHTML = data;
        return data;
    });
}

//sign up page ajax
function signup() {
    document.getElementById('content').innerHTML =
        '<div class="lds-roller text-center mx-auto" style="margin: 20% 0;"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
    $.ajax({
        type: 'POST',
        url: 'SignUp.php',
        success:
            function (data) {
                $("#login .close").click()
                setTimeout(function () {
                    $("#content").html(data);
                }, 600);
            }
    })
    return false;

}
