<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
            integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
            integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
            crossorigin="anonymous"></script>
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
            <li class="active">
                <i class="far fa-home icon"></i>
                <a> Dashboard</a>
            </li>
            <li>
                <i class="far fa-luggage-cart icon"></i>
                <a> Booking</a>
            </li>
            <li id="roomLink">
                <i class="far fa-luggage-cart icon"></i>
                <a> Rooms</a>
            </li>
            <li>
                <i class="far fa-utensils-alt icon"></i>
                <a> Restaurant</a>
            </li>
            <li>
                <i class="far fa-tshirt icon"></i>
                <a> Staff</a>
            </li>
            <li id="jobLink">
                <i class="far fa-blanket icon"></i>
                <a> Job Applications</a>
            </li>
            <li>
                <i class="far fa-user-tie icon"></i>
                <a> Room dashboard</a>
            </li>
            <li id="contactLink">
                <i class="far fa-cog icon"></i>
                <a> Reviews/Contacts</a>
            </li>
            <li id="customerLink">
                <i class="far fa-hotel icon"></i>
                <a> Customers</a>
            </li>
            <li id="logOutItem">
                <i class="far fa-door-open icon"></i>
                <a href="../PHP/LogOut/logout.php" id="signOut" style="text-decoration: none"> Sign Out</a>
            </li>
        </ul>
    </nav>

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

        var fullHeight = function () {

            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function () {
                $('.js-fullheight').css('height', $(window).height());
            });

        };
        fullHeight();

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

        // for log out icon
        $("#logOutItem").click(function () {
            sidebarCollapse
            window.location.replace("../PHP/LogOut/logout.php");
        })


        // restaurant ajax to head to categories.php
        // $("#resIcon").click(function () {
        //     $("#content").load("../Features/Restaurant/categories.php");
        // })
        //
        // $("#resLink").click(function () {
        //     $("#content").load("../Features/Restaurant/categories.php");
        // })
        //
        // // settings ajax to head to edit.php
        // $("#settingsIcon").click(function(){
        //     $("#content").load("../Features/Settings/edit.php");
        // })
        //
        // $("#settingsLink").click(function(){
        //     $("#content").load("../Features/Settings/edit.php");
        // })

        $("#roomLink").click(function () {
            $('#content').load('../Features/Room/room.php');
        })


    })(jQuery));

    // when categories.php is loaded, each category card has Browse btn, this function handles the event when it's clicked
    // it will invoke the cards for the particular category
    // function goToCategory() {
    //     $("#content").load("../Features/Restaurant/category.php", "data1");
    // }

    // AJAX for Adding Room Feature
    function submitAddingRoomForm() {
        $.post('../Features/Room/Room.php', {
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
    }

    function allRooms() {
        $.post('../Features/Room/AllRooms.php', {}, function (data, status) {
            if (status === 'success') {
                document.getElementById('content').innerHTML = data;
            }
        })
    }


    // AJAX for Editing Room
    function EditRoom(roomID) {
        $.post('../Features/Room/EditRoom.php', {
            'EditRoom': 'EditRoom',
            'room_id': roomID
        }, function (data, status) {
            if (status === 'success') {
                document.getElementById('content').innerHTML = data;
            }
        })
    }

    function submitChangingRoom(roomID) {
        $.post('../Features/Room/EditRoom.php', {
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

    function deleteRoom(room_id) {
        document.getElementById('content').innerHTML =
            '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
            '" src="../images/VZvw.gif">';

        $.post('../Features/Room/DeleteRoom.php', {
            'deleteRoom': 'deleteRoom',
            'room_id': room_id
        }, function (data, status) {
            document.getElementById('content').innerHTML = data;
        })
    }

    function roomSearch() {
        document.getElementById('searchRoomResult').innerHTML =
            '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
            '" src="../images/VZvw.gif">';

        var searchBar = document.getElementById('searchRoomBar').value;
        var filter = document.getElementById('searchRoomFilter').value;
        var orderBy = document.getElementById('searchRoomOrdering').value;
        var takenFlag = document.getElementById('takenRoomCB').checked;

        $.get('../Features/Room/SearchRoom.php', {
            'searchBar': searchBar,
            'filter': filter,
            'order_by': orderBy,
            'taken': takenFlag
        }, function (data, status) {
            if (status === 'success') {
                document.getElementById('searchRoomResult').innerHTML = data;
            }
        })
    }

    // AJAX for Contacts Feature
    $("#contactLink").click(function () {
        $.post('../Features/Contacts/Contacts.php',
            {}, function (data, status) {
                if (status === 'success') {
                    document.getElementById('content').innerHTML = data;
                }
            })
    })

    function sendEmailBTN(contact_id, counter) {
        var divID = 'MSG' + counter;
        var emailMSG = 'email_message' + counter;
        var emailSender = 'emailSender' + counter;
        var statusID = 'status' + counter;
        document.getElementById(statusID).innerHTML = '<img width="35px" height="30px"  src="../images/VZvw.gif">';
        console.log(divID);
        $.post('../Features/Contacts/Contacts.php', {
            'sendReplyEmail': 'sendReplyEmail',
            'emailSender': document.getElementById(emailSender).innerText,
            'email_message': document.getElementById(emailMSG).value,
            'contact_id': contact_id
        }, function (data, status) {
            if (status === 'success') {
                document.getElementById(divID).innerHTML = data;
                document.getElementById(statusID).innerHTML = '<i class="fa fa-check"></i> Replied';
            }
        })
    }

    function contactSearch() {
        // centering the GIF in the center till response
        document.getElementById('searchContactResult').innerHTML =
            '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
            '" src="../images/VZvw.gif">';

        var searchBar = document.getElementById('searchContactBar').value;
        var filter = document.getElementById('searchContactFilter').value;
        var orderBy = document.getElementById('searchContactOrdering').value;
        var repliedFlag = document.getElementById('repliedContactCB').checked;
        $.get('../Features/Contacts/SearchContacts.php?searchBar=' + searchBar + '&filter=' + filter + '&order_by=' + orderBy + '&replied=' + repliedFlag,
            function (data, status) {
                if (status === 'success') {
                    document.getElementById('searchContactResult').innerHTML = data;
                }
            })
    }

    function deleteContactCard(contact_id, counter) {
        var mainDivID = 'cardContactDiv' + counter;
        document.getElementById(mainDivID).style.display = 'none';
        $.post('../Features/Contacts/Contacts.php', {
            'deleteContact': 'deleteContact',
            'contact_id': contact_id
        })

    }

    // AJAX for Job Applications
    $("#jobLink").click(function () {
        $("#content").load('../Features/JobApplications/JobApps.php');
    })

    function sendEmailJobBTN(form_id, counter) {
        var divID = 'MSG' + counter;
        var emailMSG = 'email_message' + counter;
        var emailSender = 'emailSender' + counter;
        var statusID = 'status' + counter;
        document.getElementById(statusID).innerHTML = '<img width="35px" height="30px"  src="../images/VZvw.gif">';
        $.post('../Features/JobApplications/JobApps.php', {
            'sendReplyJobEmail': 'sendReplyJobEmail',
            'emailSender': document.getElementById(emailSender).innerText,
            'email_message': document.getElementById(emailMSG).value,
            'form_id': form_id
        }, function (data, status) {
            if (status === 'success') {
                document.getElementById(divID).innerHTML = data;
                document.getElementById(statusID).innerHTML = '<i class="fa fa-check"></i> Replied';
            }
        })
    }

    function jobSearch() {
        document.getElementById('searchJobResult').innerHTML =
            '<img width="55px" height="50px" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)' +
            '" src="../images/VZvw.gif">';

        var searchBar = document.getElementById('searchJobBar').value;
        var filter = document.getElementById('searchAppsFilter').value;
        var orderBy = document.getElementById('searchAppsOrdering').value;
        var repliedFlag = document.getElementById('repliedAppCB').checked;
        $.get('../Features/JobApplications/SearchJobApps.php', {
                'searchBar': searchBar,
                'filter': filter,
                'order_by': orderBy,
                'replied': repliedFlag
            }
            , function (data, status) {
                if (status === 'success') {
                    document.getElementById('searchJobResult').innerHTML = data;
                }
            })
    }

    function deleteJobCard(form_id, counter) {
        var mainDivID = 'cardJobDiv' + counter;
        document.getElementById(mainDivID).style.display = 'none';
        $.post('../Features/JobApplications/JobApps.php', {
            'deleteForm': 'deleteForm',
            'form_id': form_id
        })
    }

    // AJAX for customer item

    $("#customerLink").click(function (){
        $("#content").load('../Features/Users/AllUsers.php');
    })

</script>
</body>
</html>

