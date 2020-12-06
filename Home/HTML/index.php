<?php
require_once 'pdo.php';
session_start();

if (isset($_POST['resend'])) {
    $_SESSION['hash_verification'] = md5(rand(0, 1000));
    header('Location: ../SignUp/verify.php');
    return;
}

if (isset($_POST['person_email']) && isset($_POST['person_pass'])) {


    if (strlen($_POST['person_email']) < 1 || strlen($_POST['person_pass']) < 1) {
        $err_msg = 'USERNAME AND PASSWORD ARE REQUIRED';
        echo '<span style="color: red">' . $err_msg . '</span>';
        return;
    }
    $person_pass = htmlentities($_POST['person_pass']);
    $person_email = htmlentities($_POST['person_email']);

    $_SESSION['user_email'] = $person_email;

    if (!strpos($person_email, "@")) {
        $err_msg = 'Invalid Email!';
        echo '<span style="color: red">' . $err_msg . '</span>';
        return;
    }

    $hashed_pass = hash("sha256", trim($person_pass, " "));
    $stmt = $pdo->query("SELECT * FROM person where person_email=" . "'" . trim($person_email, " ") . "'");

    if ($stmt->rowCount() < 1) {
        $err_msg = "You are not registered!";
        echo '<span style="color: red">' . $err_msg . '</span>';
        return;
    }


    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['active'] == 0) {
        $err_msg =  "Your account is not verified yet!";
        echo '<span style="color: red">' . $err_msg . '</span>';
        return;
    }


    if ($row['person_pass'] !== $hashed_pass || $row['person_email'] !== $person_email) {
        $err_msg = "Either user name or password are wrong!";
        echo '<span style="color: red">' . $err_msg . '</span>';
        return;
    }

// if everything is okey! store person_role and person_id
    $_SESSION['person_id'] = $row['person_id'];
    $_SESSION['person_role'] = $row['person_role'];
    $_SESSION['activated'] = 1;

    unset($_SESSION['user_email']);
    echo 'You are allowed to log in';
    return;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>La Terra Santa &reg;</title>
    <link rel="stylesheet" href="../../Vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../Vendor/Fonts/font-awesome-4.7.0/css/all.css">
    <link rel="stylesheet" href="../../Vendor/CSS/flexslider.css">
    <link rel="stylesheet" href="../../Vendor/CSS/magnific-popup.css">
    <link rel="stylesheet" href="../../Vendor/CSS/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../CSS/styles.css">

</head>

<body>
<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="fa fa-arrow-left"></i>
    </div>
    <nav class="mainmenu mobile-menu">
        <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="./rooms.html">Rooms</a></li>
            <li><a href="./about-us.html">About Us</a></li>
            <li><a href="./pages.html">Pages</a></li>
            <li><a href="./blog.html">News</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="top-social">

        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-tripadvisor"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
    </div>
    <ul class="top-widget">
        <li><i class="fa fa-phone"></i> 45 54454545</li>
        <li><i class="fa fa-envelope"></i> maysam@gmail.com</li>
    </ul>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Modal Login -->
<div id="login" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sign In</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <!--                <form>-->

                <div class="model-wrapper">
                    <div class="input-data">
                        <input type="text" class="form-control" name="person_email" id="user_email"
                               required="required">
                        <label>Name</label>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="model-wrapper">
                    <div class="input-data">
                        <input type="password" class="form-control" name="person_pass" id="user_pass"
                               required="required">
                        <label>Password</label>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="model-wrapper" id="emailNF">

                </div>
                <div class="form-group">
                    <button id="loginBTN" class="btn btn-primary btn-block btn-lg">Sign
                        In
                    </button>
                </div>
                <p class="hint-text"><a href="#">Forgot Password?</a></p>
                <!--                </form>-->
            </div>
            <div class="modal-footer">Still Without A Room? &nbsp;<a href="signup.php">Reserve Now</a></div>
        </div>
    </div>
</div>
<!-- Header Section Begin -->
<header class="header-section">
    <nav class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="tn-left">
                        <li><i class="fas fa-user"></i><a href="#login" class="trigger-btn" data-toggle="modal"> Sign
                                in</a></li>
                        <li><i class="fa fa-phone"></i><a href="tel:123456789">123456789</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-tripadvisor"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark py-4">
        <div class="container-fluid">
            <!--  Show this only on mobile to medium screens  -->
            <a href="index.php" class="navbar-brand d-lg-none d-block my-2 ml-3"><img src="../images/logo-sm.png"
                                                                                      alt="La Terra Santa Logo"></a>
            <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item px-1 mr-1 active"><a class="nav-link px-0" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item px-0 mr-1"><a class="nav-link px-1" href="./about.html">About</a></li>
                    <l1 class="nav-item px-0 mr-5"><a class="nav-link px-1" href="#">Contact</a></l1>
                </ul>
                <!--   Show this only lg screens and up   -->
                <a href="index.php" class="navbar-brand d-none d-lg-block my-5"><img src="../images/logo-full.png"
                                                                                     alt="La Terra Santa Logo"></a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item px-0 ml-5"><a class="nav-link px-1" href="#">Tell Your Story</a></li>
                    <li class="nav-item px-0 ml-2"><a class="nav-link px-1" href="#">Be Part Of Us</a></li>
                </ul>
            </div>
            <button class="canvas-open btn" type="button"><span><i class="fa fa-bars"
                                                                   style="color:#B79040; font-size:28px;"></i></span>
            </button>
        </div>
    </nav>
</header>
<!-- Header End -->

<section class="slider">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url('../images/slide_1.jpg')" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="offset-2 col-8">
                            <div class="slidertext text-center">
                                <h1 class="heading">Discover The old city</h1>
                                <div class="subtext">To know Jerusalem takes a lifetime. To feel wonderfully at home
                                    takes a stay at the David Citadel
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url('../images/slide_2.jpg')" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="offset-2 col-8">
                            <div class="slidertext text-center">
                                <h1 class="heading">Welcome Ya Ro7 2lbe</h1>
                                <div class="subtext">Far far away, behind the word
                                    mountains, far from the countries Vokalia and Consonantia, there live the blind
                                    texts.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url('../images/slide_3.jpg')" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="offset-2 col-8">
                            <div class="slidertext text-center">
                                <h1 class="heading">Welcome to Atlantis</h1>
                                <div class="subtext">Far far away, behind the word
                                    mountains, far from the countries Vokalia and Consonantia, there live the blind
                                    texts.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url('../images/slide_4.jpg')" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="offset-2 col-8">
                            <div class="slidertext text-center">
                                <h1 class="heading">Welcome to Atlantis</h1>
                                <div class="subtext">Far far away, behind the word
                                    mountains, far from the countries Vokalia and Consonantia, there live the blind
                                    texts.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li style="background-image: url('../images/slide_5.jpg')" class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="offset-2 col-8">
                            <div class="slidertext text-center">
                                <h1 class="heading">Welcome to Atlantis</h1>
                                <div class="subtext">Far far away, behind the word
                                    mountains, far from the countries Vokalia and Consonantia, there live the blind
                                    texts.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</section>

<section class="cta section-invert">
    <div class="container">
        <div class="row">
            <div class="col-10 col-md-10 offset-2 offset-md-0 pt-3">
                <h2 class="cta-heading">Reserve A Room Now <span> &mdash; and begin your journey at one of the oldest cites in the world!</span>
                </h2>
            </div>
            <div class="col-8 col-md-2 offset-2 offset-md-0"><a href="signup.php" class="btn btn-primary">Reserve
                    now</a></div>
        </div>
    </div>
    <hr class="line">
</section>

<section class="section-invert services-section">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-8 offset-2">
                <h1 class="main-h1">OUR EXCLUSIVES</h1>
                <hr class="line">
                <p class="main-content">
                    Discover the exceptional luxury experience we’ve been refining since 1972. Explore a collection of
                    exclusive special offers and curated getaways that will elevate your next visit to the Old City.
                </p>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-6 px-0">
                <div class="service-item">
                    <i class="flaticon-036-parking"></i>
                    <h4>Travel Plan</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 px-0">
                <div class="service-item service-item-odd">
                    <i class="flaticon-033-dinner"></i>
                    <h4>Catering Service</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 px-0">
                <div class="service-item">
                    <i class="flaticon-026-bed"></i>
                    <h4>Babysitting</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 px-0">
                <div class="service-item service-item-odd">
                    <i class="flaticon-024-towel"></i>
                    <h4>Laundry</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 px-0">
                <div class="service-item">
                    <i class="flaticon-044-clock-1"></i>
                    <h4>Hire Driver</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna.</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 px-0">
                <div class="service-item service-item-odd">
                    <i class="flaticon-012-cocktail"></i>
                    <h4>Bar & Drink</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="main-h1">THE ADDRESS IN JERUSALEM</h1>
                <hr class="line">
                <p class="main-content">
                    To know Jerusalem takes a lifetime. To feel wonderfully at home takes a stay at La Terra Santa.

                    Our unique address unites Old City and new, so you can skip the taxis, and stroll to many of the
                    world's
                    most
                    famous sites. With each new day, you feel less like a guest in a hotel, and more like a respected
                    resident, at
                    home in the most celebrated city on earth.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="section-invert">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="main-h1">ROOMS & SUITES</h1>
                <hr class="line">
                <p class="main-content">
                    Creating the most regal rooms in the city needn't be complicated. Starting with the architect, and
                    ending with the linens, simply choose the best.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="section-invert">
    <div class="container-fluid">
        <div class="room-items no-gutters">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="room-item" style="background-image: url('../images/room-b1.jpg')">
                        <div class="hr-text">
                            <h3>Single Room</h3>
                            <h2>150$<span>/Pernight</span></h2>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>30 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Max persion 5</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>King Beds</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-link">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="room-item" style="background-image: url('../images/room-b2.jpg')">
                        <div class="hr-text">
                            <h3>Double Room</h3>
                            <h2>200$<span>/Pernight</span></h2>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>30 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>Single Person</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>Single Bed</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-link">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="room-item" style="background-image: url('../images/room-b3.jpg')">
                        <div class="hr-text">
                            <h3>Duplex Room</h3>
                            <h2>250$<span>/Pernight</span></h2>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>45 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>3 People</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>King Beds</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-link">More Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="room-item" style="background-image: url('../images/room-b4.jpg')">
                        <div class="hr-text">
                            <h3>Studio </h3>
                            <h2>350$<span>/Pernight</span></h2>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="r-o">Size:</td>
                                    <td>100 ft</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Capacity:</td>
                                    <td>5 People</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Bed:</td>
                                    <td>2 King Beds, 1 Single Bed</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Services:</td>
                                    <td>Wifi, Television, Bathroom,...</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#" class="primary-link">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-invert">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4>#laTerraSanta</h4>
                <h1 class="insta-h1">Instagram</h1>
                <hr class="line">
                <p class="main-content">We've been helping generations enjoy luxury travel for 70 years. When you need
                    an escape,
                    get inspired by these experiences and share your own stories of living the <Span
                            style="color:#D3A517">#laTerraSanta.</span></p>
            </div>
        </div>
    </div>
</section>
<section class="instagram section-invert">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-sm-12 col-md">
                <a href="../images/insta-1.jpg" class="insta-img image-popup"
                   style="background-image: url(../images/insta-1.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="fab fa-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md">
                <a href="../images/insta-2.jpg" class="insta-img image-popup"
                   style="background-image: url(../images/insta-2.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="fab fa-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md">
                <a href="../images/insta-3.jpg" class="insta-img image-popup"
                   style="background-image: url(../images/insta-3.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="fab fa-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md ">
                <a href="../images/insta-4.jpg" class="insta-img image-popup"
                   style="background-image: url(../images/insta-4.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="fab fa-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md">
                <a href="../images/insta-5.jpg" class="insta-img image-popup"
                   style="background-image: url(../images/insta-5.jpg);">
                    <div class="icon d-flex justify-content-center">
                        <span class="fab fa-instagram align-self-center"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>


<footer>
    <div class="container pt-3">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Quick links</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Home</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>About</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>FAQ</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Get
                            Started</a></li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Videos</a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Quick links</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Home</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>About</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>FAQ</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Get
                            Started</a></li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Videos</a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Quick links</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Home</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>About</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>FAQ</a>
                    </li>
                    <li><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-angle-double-right"></i>Get
                            Started</a></li>
                    <li><a href="https://wwwe.sunlimetech.com" title="Design and developed by"><i
                                    class="fa fa-angle-double-right"></i>Imprint</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    <li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i
                                    class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i
                                    class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i
                                    class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center">
                <p class="h6">La Terra Santa <span>©2020 All rights reserved</span></p>
            </div>
            <hr>
        </div>
    </div>
</footer>
</body>
<!-- jQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.2/jquery.flexslider.js"></script>
<script src="../../Vendor/script/bootstrap.min.js"></script>
<script src="../../Vendor/script/jquery.magnific-popup.min.js"></script>
<script src="../../Vendor/script/jquery.scrollUp.min.js"></script>
<script src="../../Vendor/script/jquery.slicknav.js"></script>


<script>
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "fade",
            prevText: "",
            nextText: "",
            slideshow: true
        });
    });
    $(window).load(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            topDistance: '300', // Distance from top before showing element (px)
            topSpeed: 300, // Speed back to top (ms)
            animation: 'fade', // Fade, slide, none
            animationInSpeed: 200, // Animation in speed (ms)
            animationOutSpeed: 200, // Animation out speed (ms)
            scrollText: '<i class="fas fa-angle-double-up mt-2" style="font-size:2rem"></i>', // Text for element
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
        $(".mobile-menu").slicknav({
            prependTo: '#mobile-menu-wrap',
            allowParentLinks: true
        });
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

    // Login AJAX
    $("#loginBTN").on('click', function () {
        $.post('index.php', {
            'person_email': document.getElementById("user_email").value,
            'person_pass': document.getElementById("user_pass").value
        }, function (data, status) {
                if(data ==='You are allowed to log in'){
                    window.location.replace("../../User/HTML/index.php");
                }else {
                    document.getElementById('emailNF').innerHTML = data;
                }
        })
    })
</script>
</html>