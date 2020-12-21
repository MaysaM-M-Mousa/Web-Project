<?php
//session_start();
//echo $_SESSION['book_id'];
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--    TODO: Reserve Form errors Style -->
    <!--    TODO: Apply For Jop Style -->
    <!--    TODO: Cards Order Style -->
    <!--    TODO: HF Data + Style -->
    <!--    TODO: item to subcat Button -->
    <!--    TODO: Add Animation -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>La Terra Santa &reg;</title>

    <link rel="stylesheet" href="../Vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../Vendor/Fonts/font-awesome-4.7.0/css/all.css">
    <link rel="stylesheet" href="CSS/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../Vendor/CSS/flexslider.css">
    <link href="../Vendor/DatePicker/ej2-base/fabric.css" rel="stylesheet" type="text/css"/>
    <link href="../Vendor/DatePicker/ej2-calendars/fabric.css" rel="stylesheet" type="text/css"/>
    <link href="../Vendor/DatePicker/ej2-buttons/styles/fabric.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../Vendor/CSS/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../Vendor/CSS/Loader.css">
    <link rel="stylesheet" href="CSS/styles.css">
    <!-- jQuery Modal -->

</head>
<body>



<!--Top Nav Start-->
<nav class="navbar navbar-dark bg-dark">
    <div class="header">
        <a class="brand" href="index.php">La Terra Santa</a>
        <div class="sepr"></div>
        <div class="sepl"></div>
        <h6>Hotel</h6>
    </div>
    <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <i class="fa fa-bars" style="color:#B79040;font-size: 24px;"></i>
        <span class="sr-only">Toggle Menu</span>
    </button>
</nav>
<!--Top Nav End-->
<!--Content Wrapper Start-->
<div class="wrapper d-flex align-items-stretch">
    <!-- Side Menu Start-->
    <nav id="sidebar">
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
            <li id=itemRequest>
                <i class="far fa-blanket icon"></i>
                <a href="#"> Services</a>
            </li>

            <li id="settings">
                <i class="far fa-cog icon"></i>
                <a> Settings</a>
            </li>
            <li id="HF">
                <i class="far fa-hotel icon"></i>
                <a> Hotel Facilities</a>
            </li>
            <li id="history">
                <i class="far fa-clock icon"></i>
                <a> History</a>
            </li>
            <li id="logOut">
                <i class="far fa-door-open icon"></i>
                <a> Sign Out</a>
            </li>
        </ul>
    </nav>
    <!-- Side Menu End-->

    <!-- AJAX Loader Start-->
    <div id="loader" class="loader-wrapper">
        <div class="globe-loader fas fa-globe-americas">
            <i class="fas fa-plane"></i>
        </div>
    </div>
    <!-- AJAX Loader End-->

    <!-- Main Content Start-->
    <div id="content"></div>
    <!-- Main Content End-->

    <button href="#msg" id="trigermsg" class="trigger-btn" data-toggle="modal" style="opacity: 0"></button>

</div>
<!--Content Wrapper End-->

<!-- Scripts -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.2/jquery.flexslider.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

<script src="../Vendor/script/jquery.slicknav.js"></script>
<script src="../Vendor/script/popper.js"></script>
<script src="../Vendor/script/bootstrap.min.js"></script>
<script src="Scripts/Main.js"></script>
</body>
</html>
<script src=""></script>
