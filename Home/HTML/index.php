<?php
require_once 'pdo.php';
session_start();

//if (isset($_POST['resend'])) {
//    $_SESSION['hash_verification'] = md5(rand(0, 1000));
//    return;
//}
if (isset($_POST['person_email']) && isset($_POST['person_pass'])) {


    if (strlen($_POST['person_email']) < 1 || strlen($_POST['person_pass']) < 1) {
        $err_msg = 'USERNAME AND PASSWORD ARE REQUIRED';
        echo '<span style="color: darkred;font-family: \'Cabin\', serif;margin: 5px">' . $err_msg . '</span>';
        return;
    }
    $person_pass = htmlentities($_POST['person_pass']);
    $person_email = htmlentities($_POST['person_email']);

    // to use it later for verification if it's needed!
    $_SESSION['user_email'] = $person_email;
    $_SESSION['temp_user_email'] = $person_email;

    if (!strpos($person_email, "@")) {
        $err_msg = 'Invalid Email!';
        echo '<span style="color: darkred;font-family: \'Cabin\', serif;margin: 5px">' . $err_msg . '</span>';
        return;
    }

    $hashed_pass = hash("sha256", trim($person_pass, " "));
    $stmt = $pdo->query("SELECT * FROM person where person_email=" . "'" . trim($person_email, " ") . "'");

    if ($stmt->rowCount() < 1) {
        $err_msg = "You are not registered!";
        echo '<span style="color: darkred;font-family: \'Cabin\', serif;margin: 5px">' . $err_msg . '</span>';
        return;
    }


    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['active'] == 0) {
        $_SESSION['hash_verification'] = md5(rand(0, 1000));
        $err_msg = "Your account is not verified yet!";
        echo '<span style="color: darkred;font-family: \'Cabin\', serif;margin: 5px">' . $err_msg . '</span>';
        echo '<div id="verificationDiv"><a href="#" onclick="sendEmailVerification()" style="color: darkgreen;font-family: \'Cabin\', serif;margin: 5px">Send me Email</a></div>';
        return;
    }


    if ($row['person_pass'] !== $hashed_pass || $row['person_email'] !== $person_email) {
        $err_msg = "Either user name or password are wrong!";
        echo '<span style="color: darkred;font-family: \'Cabin\', serif;margin: 5px">' . $err_msg . '</span>';
        return;
    }

// if everything is okey! store person_role and person_id


    $_SESSION['person_id'] = $row['person_id'];
    $_SESSION['person_role'] = $row['person_role'];
    $_SESSION['activated'] = 1;

//     storing booking id
    $sql = 'select booking.book_id from booking,person where booking.person_id=person.person_id
            and booking.person_id=:person_id and :curr_date between booking.start_date and booking.end_date';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $_SESSION['person_id'],
        ':curr_date' => date("Y-m-d")
    ));

    $bookingResult = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['book_id'] = $stmt->rowCount() < 1 ? 'none' : $bookingResult['book_id'];
//    echo $bookingResult['book_id'];

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

    <!--Bootstrap-->
    <link rel="stylesheet" href="../../Vendor/CSS/bootstrap.min.css">
    <!--Icons-->
    <link rel="stylesheet" href="../../Vendor/Fonts/font-awesome-4.7.0/css/all.css">
    <link rel="stylesheet" href="../../Vendor/CSS/flaticon.css" type="text/css">
    <!--Slider-->
    <link rel="stylesheet" href="../../Vendor/CSS/flexslider.css">
    <!-- Photo Zoom-->
    <link rel="stylesheet" href="../../Vendor/CSS/magnific-popup.css">
    <!--Animation-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--Main Style-->
    <link rel="stylesheet" href="../../Vendor/CSS/Loader.css">
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
            <li><a class="aboutmb" >About Us</a></li>
            <li><a href="SignUp.php">Reserve</a></li>
            <li><a class="contactus">Contact</a></li>
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
        <li><i class="fa fa-phone"></i> 02-2685685</li>
        <li><i class="fa fa-envelope"></i> LaTerra@gmail.com</li>
    </ul>
</div>
<!-- Offcanvas Menu Section End -->
<!-- Modal Login Begin -->
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
            <div class="modal-footer">Still Without A Room? &nbsp;<a id="reservel" href=""">Reserve Now</a></div>
        </div>
    </div>
</div>
<!-- Modal Login End -->

<!-- Header Section Begin -->
<nav class="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <ul class="tn-left">
                    <li><i class="fas fa-user"></i><a href="#login" class="trigger-btn" data-toggle="modal"> Sign
                            in</a></li>
                    <li><i class="fa fa-phone"></i><a href="tel:123456789">02-2685685</a></li>
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
<header class="header-section">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark py-4">
        <div class="container-fluid">
            <!--  Show this only on mobile to medium screens  -->
            <a href="index.php" class="navbar-brand d-lg-none d-block my-2 ml-3"><img src="../images/logo-sm.png"
                                                                                      alt="La Terra Santa Logo"></a>
            <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item px-1 mr-1 active"><a class="nav-link px-0" id="home" href="index.php">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item px-0 mr-1"><a class="nav-link px-1" id="aboutus">About</a></li>
                    <l1 class="nav-item px-0 mr-5"><a class="nav-link px-1 trigger-btn" id="contactus" data-toggle="modal">Contact</a></l1>
                </ul>
                <!--   Show this only lg screens and up   -->
                <a href="index.php" class="navbar-brand d-none d-lg-block my-5"><img src="../images/logo-full.png"
                                                                                     alt="La Terra Santa Logo"></a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item px-0 ml-5"><a class="nav-link px-1" href="#login" class="trigger-btn" data-toggle="modal">Tell Your Story</a></li>
                    <li class="nav-item px-0 ml-2"><a class="nav-link px-1" href="#login" class="trigger-btn" data-toggle="modal">Be Part Of Us</a></li>
                </ul>
            </div>
            <button class="canvas-open btn" type="button"><span><i class="fa fa-bars"
                                                                   style="color:#B79040; font-size:28px;"></i></span>
            </button>
        </div>
    </nav>
</header>
<!-- Header End -->

<!--Content Start-->
<div id="content">
    <!--Slider start-->
    <section class="slider">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url('../images/slide_1.jpg')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="offset-1 col-10">
                                <div class="slidertext text-center animate__animated animate__fadeIn ">
                                    <h1 class="heading animate__animated animate__fadeInUp">Discover The old city</h1>
                                    <div class="subtext animate__animated animate__fadeInUp">To know Jerusalem takes a
                                        lifetime. To feel wonderfully at home
                                        takes a stay at La Terra Santa
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url('../images/slide_2.jpg')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="offset-1 col-10">
                                <div class="slidertext text-center  animate__animated animate__fadeIn">
                                    <h1 class="heading animate__animated animate__fadeInUp">Welcome to La Terra
                                        Santa</h1>
                                    <div class="subtext animate__animated animate__fadeInUp">Our Vision is to create an
                                        oasis of great conditions and cozy environment at the heart of all the big
                                        city’s
                                        enhanced pace.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url('../images/slide_3.jpg')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="offset-1 col-10">
                                <div class="slidertext text-center  animate__animated animate__fadeIn">
                                    <h1 class="heading animate__animated animate__fadeInUp">Feel home in our rooms</h1>
                                    <div class="subtext animate__animated animate__fadeInUp">a place where you can come
                                        to relax and reboot your energy before you head out to yet another day of
                                        exploring.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url('../images/slide_4.jpg')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="offset-1 col-10">
                                <div class="slidertext text-center animate__animated animate__fadeIn">
                                    <h1 class="heading animate__animated animate__fadeInUp">Taste our luxury
                                        services</h1>
                                    <div class="subtext animate__animated animate__fadeInUp">Our guests enjoy quality
                                        hospitality given by an attentive and professional staff in a very warm
                                        atmosphere.
                                        Breakfast is served in our new and colorful dining room.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url('../images/slide_5.jpg')" class="overlay">
                    <div class="container">
                        <div class="row">
                            <div class="offset-1 col-10">
                                <div class="slidertext text-center animate__animated animate__fadeIn">
                                    <h1 class="heading animate__animated animate__fadeInUp">located in the city
                                        center</h1>
                                    <div class="subtext animate__animated animate__fadeInUp">Believe us, that’s one hell
                                        of a bonus when you’re traveling Palestine. Walking proximity to all major
                                        transportation and of course the hostel itself is located just where you want to
                                        be.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </section>
    <!--Slider End-->
    <!--Booking Start-->
    <section class="cta section-invert">
        <div class="container">
            <div class="row">
                <div class="col-10 col-md-10 offset-2 offset-md-0 pt-3">
                    <h2 data-aos="fade-right" data-aos-duration="600" class="cta-heading">Reserve A Room Now <span> &mdash; and begin your journey at one of the oldest cites in the world!</span>
                    </h2>
                </div>
                <div data-aos="zoom-in" data-aos-delay="700" class="col-8 col-md-2 offset-2 offset-md-0"><a
                            href="" id="reservebtn" class="btn btn-primary">Reserve
                        now</a></div>
            </div>
        </div>
        <hr class="line">
    </section>
    <!--booking End-->
    <section class="section-invert services-section">
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-8 offset-2">
                    <h1 data-aos="fade-up"
                        class="main-h1">OUR EXCLUSIVES</h1>
                    <hr data-aos="fade-up" class="line">
                    <p data-aos="fade-up" class="main-content">
                        Discover the exceptional luxury experience we’ve been refining since 1972. Explore a collection
                        of
                        exclusive special offers and curated getaways that will elevate your next visit to the Old City.
                    </p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-4 col-sm-6 px-0">
                    <div data-aos-duration="700" data-aos="zoom-in" class="service-item firstservice">
                        <i class="flaticon-036-parking"></i>
                        <h4>Travel Plan</h4>
                        <p>Whether you’re sheltered at home or trying to figure out where you can travel right now, we’ve got you covered.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 px-0">
                    <div data-aos="zoom-in" data-aos-duration="700" data-aos-delay="300"
                         class="service-item service-item-odd ">
                        <i class="flaticon-033-dinner"></i>
                        <h4>Catering Service</h4>
                        <p>We offer a wide range of catering services, from drop-off to full-service catering, launch parties to weddings.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 px-0">
                    <div data-aos="zoom-in" data-aos-duration="700" data-aos-delay="600" class="service-item">
                        <i class="flaticon-026-bed"></i>
                        <h4>Babysitting</h4>
                        <p>We have a dedicated team who will accurately match your family with one of our screened caregivers. .</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 px-0">
                    <div data-aos="zoom-in" data-aos-duration="700" data-aos-delay="200"
                         class="service-item service-item-odd firstservice">
                        <i class="flaticon-024-towel"></i>
                        <h4>Laundry</h4>
                        <p>From sorting to washing, drying to folding - our laundry pros know how to give your clothes an optimal clean.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 px-0">
                    <div data-aos="zoom-in" data-aos-duration="700" data-aos-delay="500" class="service-item">
                        <i class="flaticon-044-clock-1"></i>
                        <h4>Hire Driver</h4>
                        <p>Whether you need to go for your weekly grocery shopping trips, pick kids from school or are looking for a relaxed ride back home or to a business meeting, we have you covered..</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 px-0">
                    <div data-aos="zoom-in" data-aos-duration="700" data-aos-delay="800"
                         class="service-item service-item-odd">
                        <i class="flaticon-012-cocktail"></i>
                        <h4>Cocktail & Drinks</h4>
                        <p>Whether you're brushing up on your home mixology menu or looking for a go-to order for your next cocktail hour, we will never steer you wrong.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Jeruslaem section-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 data-aos="fade-up" data-aos-duration="600" class="main-h1">THE ADDRESS IN JERUSALEM</h1>
                    <hr data-aos="fade-up" data-aos-duration="600" class="line">
                    <p data-aos="fade-up" data-aos-delay="50" data-aos-duration="600" class="main-content">
                        To know Jerusalem takes a lifetime. To feel wonderfully at home takes a stay at La Terra Santa.

                        Our unique address unites Old City and new, so you can skip the taxis, and stroll to many of the
                        world's
                        most
                        famous sites. With each new day, you feel less like a guest in a hotel, and more like a
                        respected
                        resident, at
                        home in the most celebrated city on earth.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--Romm Header-->
    <section class="section-invert">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 data-aos="fade-up" data-aos-duration="600" class="main-h1">ROOMS & SUITES</h1>
                    <hr data-aos="fade-up" data-aos-duration="600" class="line">
                    <p data-aos="fade-up" data-aos-delay="50" data-aos-duration="600" class="main-content">
                        Creating the most regal rooms in the city needn't be complicated. Starting with the architect,
                        and
                        ending with the linens, simply choose the best.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--Room Content-->
    <section class="section-invert">
        <div class="container-fluid">
            <div class="room-items no-gutters">
                <div class="row">
                    <div data-aos="fade-up" data-aos-duration="600" class="col-lg-3 col-md-6">
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
                                <a href="SignUp.php" class="primary-link">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="200" class="col-lg-3 col-md-6">
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
                                <a href="SignUp.php" class="primary-link">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="400" class="col-lg-3 col-md-6">
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
                                <a href="SignUp.php" class="primary-link">More Details</a>
                            </div>
                        </div>
                    </div>
                    <div data-aos="fade-up" data-aos-duration="600" data-aos-delay="600" class="col-lg-3 col-md-6">
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
                                <a href="SignUp.php" class="primary-link">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Instagram header-->
    <section class="section-invert">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 data-aos="zoom-out-up" data-aos-delay="800">#laTerraSanta</h4>
                    <h1 data-aos="fade-up" data-aos-duration="600" class="insta-h1">Instagram</h1>
                    <hr data-aos="fade-up" data-aos-duration="600" class="line">
                    <p data-aos="fade-up" data-aos-duration="600" data-aos-delay="50" class="main-content">We've been
                        helping generations enjoy luxury travel for 70 years. When you need
                        an escape,
                        get inspired by these experiences and share your own stories of living the <Span
                                style="color:#D3A517">#laTerraSanta.</span></p>
                </div>
            </div>
        </div>
    </section>
    <!--Instagram Content-->
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
</div>
<!--Content End-->

<!--Footer Start-->
<footer>
    <div class="container pt-3">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    <li class="list-inline-item"><a href="#"><i
                                    class="fab fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i
                                    class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i
                                    class="fab fa-instagram"></i></a></li>
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
<!--Footer End-->

</body>
<!-- jQuery & Bootstrap -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="../../Vendor/script/bootstrap.min.js"></script>
<!--Flexslider-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.2/jquery.flexslider.js"></script>
<!--photo PopUp-->
<script src="../../Vendor/script/jquery.magnific-popup.min.js"></script>
<!--Scroll Up-->
<script src="../../Vendor/script/jquery.scrollUp.min.js"></script>
<!--Mobile Menu-->
<script src="../../Vendor/script/jquery.slicknav.js"></script>
<!--Animation-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!--Main Script-->
<script src="../script/Main.js"></script>

</html>