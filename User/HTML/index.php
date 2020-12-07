<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>La Terra Santa &reg;</title>
    <link rel="stylesheet" href="../../Vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../Vendor/Fonts/font-awesome-4.7.0/css/all.css">
    <link rel="stylesheet" href="../../Vendor/CSS/flexslider.css">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../../Vendor/CSS/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../../Vendor/CSS/Loader.css">
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <a class="brand" href="index.php">La Terra Santa</a>
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars" style="color:#B79040;font-size: 24px;"></i>
        <span class="sr-only">Toggle Menu</span>
    </button>
</nav>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="active">
        <ul class="list-unstyled components mb-5">
            <li id="dashboard">
                <i class="far fa-home icon"></i>
                <a href="index.php"> Dashboard</a>
            </li>
            <li id="reservation">
                <i class="far fa-luggage-cart icon"></i>
                <a href="#"> Reservation</a>
            </li>
            <li id="restaurant">
                <i class="far fa-utensils-alt icon"></i>
                <a> Restaurant</a>
            </li>
            <li>
                <i class="far fa-blanket icon"></i>
                <a href="#"> Item Request</a>
            </li>
            <li>
                <i class="far fa-user-tie icon"></i>
                <a> Room dashboard</a>
            </li>
            <li id="settings">
                <i class="far fa-cog icon"></i>
                <a> Settings</a>
            </li>
            <li>
                <i class="far fa-hotel icon"></i>
                <a href="#"> Hotel Facilities</a>
            </li>
            <li id="logOut">
                <i class="far fa-door-open icon"></i>
                <a> Sign Out</a>
            </li>
        </ul>
    </nav>

    <div id="loader" class="loader-wrapper">
        <div class="globe-loader fas fa-globe-americas">
            <i class="fas fa-plane"></i>
        </div>
    </div>

    <!-- Page Content  -->
    <div id="content">
        <section class="section-invert dashboard-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-8 offset-2">
                        <h1 class="main-h1">Welcome</h1>
                        <p class="main-content">
                            Discover the exceptional luxury experience we’ve been refining since 1972. Explore a
                            collection of
                            exclusive special offers and curated getaways that will elevate your next visit to the Old
                            City.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-12 col-md-6 px-0">
                        <div class="dashboard-item">
                            <i class="far fa-hotel my-3" style="font-size: 50px"></i>
                            <h4>Reservation</h4>
                            <p>/we add how much days he still has/</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-6 px-0">
                        <div class="dashboard-item dashboard-item-odd">
                            <i class="fal fa-key my-3" style="font-size: 50px"></i>
                            <h4>Room</h4>
                            <p>Your Room Number is, refere this when ordring services</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-6 px-0">
                        <div class="dashboard-item">
                            <i class="flaticon-026-bed"></i>
                            <h4>Babysitting</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut
                                labore et dolore magna.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-6 px-0">
                        <div class="dashboard-item dashboard-item-odd">
                            <i class="flaticon-024-towel"></i>
                            <h4>Laundry</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut
                                labore et dolore magna.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-6 px-0">
                        <div class="dashboard-item">
                            <i class="flaticon-044-clock-1"></i>
                            <h4>Hire Driver</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut
                                labore et dolore magna.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-6 px-0">
                        <div class="dashboard-item dashboard-item-odd">
                            <i class="flaticon-012-cocktail"></i>
                            <h4>Bar & Drink</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut
                                labore et dolore magna.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.2/jquery.flexslider.js"></script>
<script src="../../Vendor/script/jquery.scrollUp.min.js"></script>
<script src="../../Vendor/script/jquery.slicknav.js"></script>
<script src="../../Vendor/script/popper.js"></script>
<script src="../../Vendor/script/bootstrap.min.js"></script>


<!-- Menu Toggle Script -->
<script>
    $(document).ready((function ($) {
        "use strict";
        (function () {

            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function () {
                $('.js-fullheight').css('height', $(window).height());
            });

        })();

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

        //loader
        $(document).on({
            ajaxStart: function () {
                $("#content").css("display", "none");
                $("#loader").css("display", "block");
            },
            ajaxStop: function () {
                $("#loader").css("display", "none");
                $("#content").css("display", "block");
            }
        });
        //load DashBoard On Start
        $(document).ready(function () {
            $("#content").load("../Features/Dashboard/dashboard.php");
            $("#dashboard").addClass("active");
        })

        // Dashboard ajax to head to categories.php
        $("#dashboard").click(function () {
            $("#content").load("../Features/Dashboard/dashboard.php");
            $(".components li").removeClass("active");
            $("#dashboard").addClass("active");
        })

        // Restaurant ajax to head to categories.php
        $("#restaurant").click(function () {
            $("#content").load("../Features/Restaurant/categories.php");
            $(".components li").removeClass("active");
            $("#restaurant").addClass("active");
        })


        // settings ajax to head to edit.php
        $("#settings").click(function () {
            $("#content").load("../Features/Settings/edit.php");
            $(".components li").removeClass("active");
            $("#settings").addClass("active");
        })
        // for log out icon
        $("#logOut").click(function () {
            window.location.replace("../PHP/LogOut/logout.php");
        })

    })(jQuery));

    // when categories.php is loaded, each category card has Browse btn, this function handles the event when it's clicked
    // it will invoke the cards for the particular category
    function goToCategory() {
        $("#content").load("../Features/Restaurant/category.php", "data1");
    }

    // $("#logOutIcon").click(function(){
    //     $.post("index.php", "getOut",
    //         function(data, status){
    //             alert("Data: " + data + "\nStatus: " + status);
    //         });
    // });


</script>
</body>
</html>
