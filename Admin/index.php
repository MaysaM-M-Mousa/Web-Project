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
    <link rel="stylesheet" href="../Vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Vendor/Fonts/font-awesome-4.7.0/css/all.css">
    <link rel="stylesheet" href="../Vendor/CSS/flaticon.css" type="text/css">
    <link rel="stylesheet" href="CSS/dropzone.min.css">
    <link rel="stylesheet" href="CSS/styles.css">

</head>
<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
<body>
<!--Top Nav Start-->
<nav class="navbar navbar-dark bg-dark sticky-top">
    <a class="brand" href="index.php">La Terra Santa</a>
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars" style="color:#B79040;font-size: 24px;"></i>
        <span class="sr-only">Toggle Menu</span>
    </button>
</nav>
<!--Top Nav End-->
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="active active-mobile">
        <ul class="list-unstyled components mb-5">
            <li id="dashboard">
                <i class="far fa-home icon"></i>
                <a> Dashboard</a>
            </li>
            <li id="bookingLink">
                <i class="far fa-luggage-cart icon"></i>
                <a> Booking</a>
            </li>
            <li  class="sidebar-dropdown dropright">
                <i id ="roomIcon" class="far fa-bed icon"></i>
                <a> Rooms</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li id="addRoom">Add Room</li>
                        <li id="Rooms">All Rooms</li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-dropdown">
                <i id="servicesIcon" class="far fa-utensils-alt icon"></i>
                <a>Services</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <div class="catagories">Categories</div>
                            <hr class="sub-line" style="width: 40%">
                            <div class="cat-menu">
                                <ul>
                                    <li id="AllCategoriesLink">All Categories</li>
                                    <li id="AddCategoriesLink">Add Category</li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="catagories">Sub-Categories</div>
                            <hr class="sub-line">
                            <div class="cat-menu">
                                <ul>
                                    <li id="AllSubCategoriesLink">All Sub-Categories</li>
                                    <li id="AddSubCategoriesLink">Add Sub-Category</li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="catagories">Items</div>
                            <hr class="sub-line" style="width: 25%">
                            <div class="cat-menu">
                                <ul>
                                    <li id="AllItemsLink">All Items</li>
                                    <li id="AddItemsLink">Add Item</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <i class="far fa-tshirt icon"></i>
                <a> Staff</a>
            </li>
            <li id="jobLink">
                <i class="far fa-blanket icon"></i>
                <a> Job Applications</a>
            </li>
            <li class="sidebar-dropdown">
                <i class="far fa-user-tie icon"></i>
                <a> Employees</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li id="addEmployee">Add Employee</li>
                        <li id="allEmployees">All Employees</li>
                    </ul>
                </div>
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
                <a href="../Home/PHP/SignIn/logout.php" id="signOut" style="text-decoration: none"> Sign Out</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">

    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="../Vendor/script/bootstrap.min.js"></script>
<script src="../Vendor/script/popper.js"></script>

<script src="Scripts/Main.js"></script>


<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>


</body>
</html>
