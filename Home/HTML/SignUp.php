<?php
require_once 'pdo.php';
//session_start();


if (isset($_POST['resend'])) {
    $_SESSION['hash_verification'] = md5(rand(0, 1000));
    header('Location: ../SignUp/verify.php');
    return;
}

if (isset($_POST['person_email']) && isset($_POST['person_pass'])) {

    if (strlen($_POST['person_email']) < 1 || strlen($_POST['person_pass']) < 1 || strlen($_POST['login']) < 1) {
        header("Location : login.php");
        return;
    }
    $person_pass = htmlentities($_POST['person_pass']);
    $person_email = htmlentities($_POST['person_email']);

    $_SESSION['user_email'] = $person_email;

    if (!strpos($person_email, "@")) {
        $_SESSION['error_message'] = "Email must has '@' character.";
        header("Location: login.php");
        return;
    }


    $hashed_pass = hash("sha256", trim($person_pass, " "));
    $stmt = $pdo->query("SELECT * FROM person where person_email=" . "'" . trim($person_email, " ") . "'");

    if ($stmt->rowCount() < 1) {
        $_SESSION['email_not_found_msg'] = "Either user name or password are wrong!";
        header("Location:login.php");
        return;
    }


    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['active'] == 0) {
        $_SESSION['error_verification'] = "Your account is not verified yet!";
        header("Location:login.php");
        return;
    }


    if ($row['person_pass'] !== $hashed_pass || $row['person_email'] !== $person_email) {
        $_SESSION['email_not_found_msg'] = "Either user name or password are wrong!";
        header("Location:login.php");
        return;
    }


// if everything is okey! store person_role and person_id
    $_SESSION['person_id'] = $row['person_id'];
    $_SESSION['person_role'] = $row['person_role'];
    $_SESSION['activated'] = 1;

    unset($_SESSION['user_email']);
    header("Location:../../PHP/Edit/edit.php");
    return;

//    header("Location:../../HTML/index.html");


}

?>
<?php
session_start();

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['user_email'])
    && isset($_POST['user_pass']) && isset($_POST['confirm_user_pass']) && isset($_POST['gender'])
    && isset($_POST['mobile']) && isset($_POST['day_birthday']) && isset($_POST['month_birthday'])
    && isset($_POST['year_birthday']) && isset($_POST['country']) && isset($_POST['city'])) {


    $user_pass = htmlentities($_POST['user_pass']);
    $confirm_user_pass = htmlentities($_POST['confirm_user_pass']);
    $user_email = htmlentities($_POST['user_email']);
    $first_name = htmlentities($_POST['first_name']);
    $last_name = htmlentities($_POST['last_name']);
    $gender = htmlentities($_POST['gender']);
    $mobile = htmlentities($_POST['mobile']);
    $day = htmlentities($_POST['day_birthday']);
    $month = htmlentities($_POST['month_birthday']);
    $year = htmlentities($_POST['year_birthday']);
    $country = htmlentities($_POST['country']);
    $city = htmlentities($_POST['city']);
    $person_role = 0;
    $active = 0;

    if (strlen($user_pass) < 1 || strlen($confirm_user_pass) < 1 || strlen($user_email) < 1
        || strlen($first_name) < 1 || strlen($last_name) < 1 || strlen($gender) < 1
        || strlen($mobile) < 1 || strlen($day) < 1 || strlen($month) < 1
        || strlen($year) < 1 || strlen($country) < 1 || strlen($city) < 1
        || !is_numeric($mobile) || !is_numeric($day) || !is_numeric($year) || !is_numeric($month)
    ) {
        header("Location:signup.php");
        return;
    }

    if ($user_pass !== $confirm_user_pass) {
        //flash message
        $_SESSION['error_pass'] = "Passwords are not identical!";
        header("Location: signup.php");
        return;
    }

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Email must has '@' character.";
        header("Location: signup.php");
        return;
    }


    $hashed_pass = hash("sha256", $user_pass);

    $hash_verification = md5(rand(0, 1000));// Generate random 32 character hash and assign it to a local variable.
// Example output: f4552671f8909587cf485ea990207f3b


    try {
        $sql = "insert into person (person_pass,person_email,first_name,last_name,gender,mobile,day_bd,
            month_bd,year_bd,country,city,person_role,active) values (:person_pass,:person_email,:first_name,:last_name,:gender
            ,:mobile,:day_bd,:month_bd,:year_bd,:country,:city,:person_role,:active)";
        $statement = $pdo->prepare($sql);

        $statement->execute(array(
            ":person_pass" => $hashed_pass,
            ":person_email" => $user_email,
            ":first_name" => $first_name,
            ":last_name" => $last_name,
            ":gender" => $gender,
            ":mobile" => $mobile,
            ":day_bd" => $day,
            ":month_bd" => $month,
            ":year_bd" => $year,
            ":country" => $country,
            ":city" => $city,
            ":person_role" => $person_role,
            ":active" => $active
        ));
//            ":hash_verification" => $hash_verification,
        // sending email
//        $to = $user_email;
//        $subject = 'Email Verification';
//        $headers = 'From: 1.c.f.m.m.a.m@gmail.com';
//        $email_msg = 'Thanks for signing up!
//Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
//
//------------------------
//email: ' . $user_email . '
//------------------------
//
//Please click this link to activate your account:
//http://localhost/WebProject/Home/PHP/SignUp/verify.php?email=' . $user_email . '&hash=' . $hash_verification . '';

//        mail($user_email, $subject, $email_msg, $headers);
        // saving hash and email in case of resending email
        $_SESSION['hash_verification'] = $hash_verification;
        $_SESSION['user_email'] = $user_email;
        header("Location: verify.php");

    } catch (PDOException $e) {
        $_SESSION['error_duplicated_email'] = 'You already have an account!';
        header("Location: signup.php");
        return;
    }


    //Store user_id, user_name, user_pass in a session
    // redirect to signin.php
    header("Location: verify.php");
//    header("Location:../../HTML/index.php");
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
    <link rel="stylesheet" href="../CSS/DatePicker/mobiscroll.jquery.min.css">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/signup.css">
    <link rel="stylesheet" href="../../Vendor/CSS/flaticon.css" type="text/css">
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
                <form method="post">
                    <div class="model-wrapper">
                        <?php
                        if (isset($_SESSION['error_verification'])) {
                            unset($_SESSION['error_verification']);
                            echo '<form method="post">';
                            echo '<p class="hint-text">Please Verify Your Email..</p>';
                            echo '<input class="btn btn-primary btn-block btn-lg"type="submit" name="resend" value="Resend Email" class="offset-3"> ';
                            echo '</form>';
                        }
                        ?>
                    </div>
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
                    <div class="model-wrapper">
                        <?php
                        if (isset($_SESSION['error_message'])) {
                            echo "<span class='offset-md-3' style='color: red'>" . $_SESSION['error_message'] . "</span>";
                            unset($_SESSION['error_message']);
                        } else if (isset($_SESSION['email_not_found_msg'])) {
                            echo "<span class='offset-md-3' style='color: red'>" . $_SESSION['email_not_found_msg'] . "</span>";
                            unset($_SESSION['email_not_found_msg']);
                        }
                        ?>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sign In</button>
                    </div>
                    <p class="hint-text"><a href="#">Forgot Password?</a></p>
                </form>
            </div>
            <div class="modal-footer">Still Without A Room? &nbsp;<a href="#">Reserve Now</a></div>
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

<!-- SignUp Section Begin -->
<div class="container">
    <section>
        <h1 class="main-h1">Reservation</h1>
        <hr class="line">
        <p class="main-content">
            Book your stay with us directly and enjoy the best possible rate and early check in and late check out.
            The best offer you will find, guaranteed.
        </p>
    </section>
    <div class="row justify-content-center">
        <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 text-center p-0 mt-3 mb-2">
            <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                <form name="signup" id="signup">
                    <!-- progressbar -->
                    <ul id="progressbar" class="d-none d-sm-block">
                        <li class="active" id="account"><strong>Period</strong></li>
                        <li id="room"><strong>Rooms</strong></li>
                        <li id="personal"><strong>Personal</strong></li>
                        <li id="payment"><strong>Payment</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <br>
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="row">
                            <div class="col-7">
                                <h2 class="fs-title"> Duration Of Stay:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 1 - 5</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label>
                                    From
                                    <input mbsc-input id="start" name="start" placeholder="Please Select ..." readonly/>
                                </label>
                            </div>
                            <div class="col-12 col-md-6">
                                <label>
                                    Until
                                    <input mbsc-input id="end" name="end" placeholder="Please Select ..." readonly/>
                                </label>
                                <div id="demo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <span id="errorDate" class="error"><i class="fas fa-exclamation-circle	"></i> Please Fill All Fields Here</span>
                        </div>
                        <input type="button" name="next" class="next next0 action-button" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <div class="col-7">
                                <h2 class="fs-title">Room Type:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 2 - 5</h2>
                            </div>
                        </div>
                        <section>
                            <div class="container-fluid no-gutters">
                                <div class="room-items no-gutters">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="room-item"
                                                 style="background-image: url('../images/room-b1.jpg')">
                                                <input class="room-radio" type="radio" onclick="roomSelect()"
                                                       name="room" value="single"
                                                       id="room_1" checked="checked">
                                                <div class="bg-active"></div>
                                                <div class="hr-text">
                                                    <h3>Single Room</h3>
                                                    <h2>150$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="room-item"
                                                 style="background-image: url('../images/room-b2.jpg')">
                                                <input class="room-radio" type="radio" onclick="roomSelect()"
                                                       name="room" value="double"
                                                       id="room_2">
                                                <div class="bg-active"></div>
                                                <div class="hr-text">
                                                    <h3>Double Room</h3>
                                                    <h2>200$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="room-item"
                                                 style="background-image: url('../images/room-b3.jpg')">
                                                <input class="room-radio" onclick="roomSelect()" type="radio"
                                                       name="room" value="duplex"
                                                       id="room_3">
                                                <div class="bg-active"></div>
                                                <div class="hr-text">
                                                    <h3>Duplex Room</h3>
                                                    <h2>250$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="room-item"
                                                 style="background-image: url('../images/room-b4.jpg')">
                                                <input class="room-radio" onclick="roomSelect()" type="radio"
                                                       name="room" value="studio"
                                                       id="room_4">
                                                <div class="bg-active"></div>

                                                <div class="hr-text">
                                                    <h3>Studio </h3>
                                                    <h2>350$<span>/Pernight</span></h2>
                                                    <a href="#" style="visibility: hidden" class="primary-link">More
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="mt-5">
                            <div class="section over-hide z-bigger">
                                <input class="checkbox" type="checkbox" name="general" id="general">
                                <label class="for-checkbox" for="general"></label>
                                <div class="background-color"></div>
                                <div class="section over-hide z-bigger">
                                    <div class="container pb-5">
                                        <div class="row justify-content-center pb-5">
                                            <div class="col-12 pt-1">
                                                <p class="mb-5 pb-4 fs-title">Booking Options:</p>
                                            </div>
                                            <div class="col-12 pb-5">
                                                <input class="checkbox-booking" type="checkbox" name="booking"
                                                       id="booking-1">
                                                <label class="for-checkbox-booking" for="booking-1">
                                                    <i class='far fa-coffee mr-3'></i><span
                                                            class="text">breakfast</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-2">
                                                <label class="for-checkbox-booking" for="booking-2">
                                                    <i class='far fa-egg-fried mr-3'></i><span
                                                            class="text">dinner</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-4">
                                                <label class="for-checkbox-booking" for="booking-4">
                                                    <i class='far fa-flower mr-3'></i><span class="text">garden</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-5">
                                                <label class="for-checkbox-booking" for="booking-5">
                                                    <i class='far fa-wifi mr-3'></i><span class="text">internet</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-6">
                                                <label class="for-checkbox-booking" for="booking-6">
                                                    <i class='far fa-parking mr-3'></i><span class="text">parking</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-7">
                                                <label class="for-checkbox-booking" for="booking-7">
                                                    <i class='far fa-tv mr-3'></i><span class="text">television</span>
                                                </label>

                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-8">
                                                <label class="for-checkbox-booking" for="booking-8">
                                                    <i class='far fa-book-open mr-3'></i><span class="text">books</span>
                                                </label>
                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-10">
                                                <label class="for-checkbox-booking" for="booking-10">
                                                    <i class='far fa-glass-martini mr-3'></i><span
                                                            class="text">drink</span>
                                                </label>
                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-11">
                                                <label class="for-checkbox-booking" for="booking-11">
                                                    <i class='far fa-dumbbell mr-3'></i><span class="text">gym</span>
                                                </label>
                                                <input class="checkbox-booking"
                                                       type="checkbox"
                                                       name="booking" id="booking-12">
                                                <label class="for-checkbox-booking" for="booking-12">
                                                    <i class='far fa-sign mr-3'></i><span
                                                            class="text">walking tours</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <input type="button" name="next" class="next next0 action-button" value="Next"/>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    </fieldset>
                    <fieldset class="info-person">
                        <div class="row mb-5">
                            <div class="col-7">
                                <h2 class="fs-title">Personal Information:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 3 - 5</h2>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <h2>Have You Visited Us Before?</h2>
                            <a href="#login" class="trigger-btn" data-toggle="modal">Sign In </a>
                        </div>
                        <?php
                        if (isset($_SESSION['error_duplicated_email'])) {
                            echo "<span class='offset-md-3' style='color: red;font-size: large'>" . $_SESSION['error_duplicated_email'] . "</span>";
                            unset($_SESSION['error_duplicated_email']);
                        }
                        ?>
                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3" for="first_name">First Name:</label>
                            <input class="col-12 col-md-9 form-control" type="text" id="first_name" name="first_name"
                                   size="30" required>
                            <span id="errorFName" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your First Name</span>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3" for="last_name">Last Name:</label>
                            <input class="col-12 col-md-9 form-control" type="text" id="last_name" name="last_name"
                                   size="30" required>
                            <div class="underline"></div>
                            <span id="errorLName" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your Last Name</span>
                        </div>

                        <!-- birthday-->
                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3">Birthday:</label>
                            <div class="col-12 col-md-9">
                                <div class="form-check-inline row align-items-center">
                                    <label>Day &nbsp;</label>
                                    <select class="custom-select" required name="day_birthday">
                                        <option value="">day</option>
                                        <?php
                                        for ($i = 1; $i < 32; $i++)
                                            echo "<option value='$i'>$i</option>";
                                        ?>
                                    </select>
                                </div>

                                <div class="form-check-inline row align-items-center">
                                    <label> Month&nbsp; </label>
                                    <select class="custom-select" required name="month_birthday">
                                        <option value="">month</option>

                                        --><?php
                                        $arr = array("January", "February", "March", "April", "May", "June", "July", "August",
                                            "September", "October", "November", "December");

                                        for ($i = 1; $i < 13; $i++)
                                            echo "<option value='$i'>" . $arr[$i - 1] . "</option>";
                                        ?>

                                    </select>
                                </div>

                                <div class="form-check-inline row">
                                    <label> Year&nbsp; </label>
                                    <select class="custom-select" required name="year_birthday">
                                        <option value=""> year</option>
                                        <?php
                                        for ($i = 2021; $i >= 1900; $i--)
                                            echo "<option value='$i'>$i</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <span id="errorBDate" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your Birth Date</span>
                        </div>
                        <!--  end of BD-->
                        <!--Phone NO-->
                        <div class="form-group row align-items-center align-items-center">
                            <label class="col-12 col-md-3" for="mobile">Mobile Number:</label>
                            <input class="col-12 col-md-9 form-control" type="tel" id="mobile" name="mobile" required
                                   placeholder="Ex: 970599999999">
                            <span id="errorPhone" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your Phone No</span>
                        </div>
                        <!-- end of phoneNo -->

                        <!-- country-->

                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3">Country:</label>
                            <select class="custom-select col-12 col-md-9" name="country" required>
                                <option value="">country</option>
                                <?php

                                $countries = array("Palestine", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla",
                                    "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria",
                                    "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin",
                                    "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil",
                                    "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi",
                                    "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad",
                                    "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo",
                                    "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire",
                                    "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
                                    "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea",
                                    "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France",
                                    "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon",
                                    "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe",
                                    "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands",
                                    "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia",
                                    "Iran (Islamic Republic of)", "Iraq", "Ireland", "Italy", "Jamaica", "Japan", "Jordan",
                                    "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of",
                                    "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho",
                                    "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau",
                                    "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives",
                                    "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico",
                                    "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat",
                                    "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles",
                                    "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island",
                                    "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea",
                                    "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion",
                                    "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
                                    "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia",
                                    "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia",
                                    "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain",
                                    "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname",
                                    "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic",
                                    "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo",
                                    "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan",
                                    "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates",
                                    "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan",
                                    "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)",
                                    "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                for ($i = 0; $i < sizeof($countries); $i++)
                                    echo "<option value='$countries[$i]'>$countries[$i]</option>";
                                ?>
                            </select>
                            <span id="errorCountry" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your Country</span>
                        </div>
                        <!-- End of country-->


                        <!--Gender-->
                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3">Gender:</label>
                            <div class="col-12 col-md-9 my-2">
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender" id="male" value="male">
                                    <label for="male" class="form-check-label">&nbsp; Male </label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="radio" class="form-check-input" name="gender" id="female"
                                           value="female">
                                    <label for="female" class="form-check-label">&nbsp; Female </label>
                                </div>
                                <div class="form-check-inline disabled">
                                    <input type="radio" class="form-check-input" name="gender" id="personal"
                                           value="personal">
                                    <label for="personal" class="form-check-label">&nbsp; Keep it personal </label>
                                </div>
                            </div>

                        </div>
                        <!--end of Gender-->

                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3" for="city">City:</label>
                            <input class="col-12 col-md-9 form-control" type="text" id="city" name="city" size="30"
                                   required>
                            <div class="underline"></div>
                            <span id="errorCity" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your City</span>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3" for="user_email">Email:</label>
                            <input class="col-12 col-md-9 form-control" type="email" id="user_email" name="user_email"
                                   placeholder="ex@gmail.com"
                                   size="30" required>
                            <div class="underline"></div>
                            <span id="errorEmail" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your Email Address</span>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3" for="user_password">Password:</label>
                            <input class="col-12 col-md-9 form-control" type="password" id="user_password"
                                   name="user_pass" size="30"
                                   required>
                            <span id="errorPassword" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your Password</span>
                        </div>

                        <?php
                        if (isset($_SESSION['error_pass'])) {
                            echo "<span class='offset-md-3' style='color: red'>" . $_SESSION['error_pass'] . "</span>";
                            unset($_SESSION['error_pass']);
                        }
                        ?>
                        <div class="form-group row align-items-center">
                            <label class="col-12 col-md-3" for="confirm_user_password">Confirm Password:</label>
                            <input class="col-12 col-md-9 form-control" type="password" id="confirm_user_password"
                                   name="confirm_user_pass"
                                   size="30" required>
                            <div class="underline"></div>
                            <span id="errorConfPassword" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Please Fill Your Password</span>
                            <span id="errorMatch" class="col-9 offset-3 error"><i
                                        class="fas fa-exclamation-circle	"></i> Password Mismatch ..</span>
                        </div>
                        <input type="button" id="submit1" name="next" class="next action-button" value="Next"/>
                        <input type="button" name="previous" class="previous action-button-previous input-data"
                               value="Previous"/>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <div class="col-7">
                                <h2 class="fs-title"> Payment:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 4 - 5</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="card">
                                    <div class="accordion" id="accordionPayment">
                                        <div class="card">
                                            <div class="card-header p-0" id="headingTwo">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseTwo" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>Paypal</span> <i class="fab fa-paypal"
                                                                                   STYLE="font-size: 30px;color: #1565c0;"></i>
                                                        </div>
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                 data-parent="#accordionPayment">
                                                <div class="card-body"><input type="text" class="form-control"
                                                                              placeholder="Paypal email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header p-0">
                                                <h2 class="mb-0">
                                                    <a class="btn btn-light btn-block text-left p-3 rounded-0"
                                                       data-toggle="collapse" data-target="#collapseOne"
                                                       aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span>Credit card</span>
                                                            <div class="icons">
                                                                <i class="fab fa-cc-visa"
                                                                   style="color: #0e7df4;font-size: 30px"></i>
                                                                <i class="fab fa-cc-amex"
                                                                   style="color: #000000;font-size: 30px"></i>
                                                                <i class="fab fa-cc-discover"
                                                                   style="color: #ffa736;font-size: 30px"></i>
                                                                <i class="fab fa-cc-amex"
                                                                   style="color: #0e7df4;font-size: 30px"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </h2>
                                            </div>
                                            <div id="collapseOne" class="collapse show"
                                                 aria-labelledby="headingOne" data-parent="#accordionPayment">
                                                <div class="card-body payment-card-body">
                                                    <span class="font-weight-normal card-text">Card Number</span>
                                                    <div class="input"><i class="fa fa-credit-card"></i> <input
                                                                type="text" class="cardNo form-control"
                                                                placeholder="0000 0000 0000 0000"></div>
                                                    <div class="row mt-3 mb-3">
                                                        <div class="col-md-6"><span
                                                                    class="font-weight-normal card-text">Expiry Date</span>
                                                            <div class="input cardNo"><i class="fa fa-calendar"></i>
                                                                <input type="text" class="form-control"
                                                                       placeholder="MM/YY"></div>
                                                        </div>
                                                        <div class="col-md-6"><span
                                                                    class="font-weight-normal card-text">CVC/CVV</span>
                                                            <div class="cardNo input"><i class="fa fa-lock"></i> <input
                                                                        type="text" class="form-control"
                                                                        placeholder="000"></div>
                                                        </div>
                                                    </div>
                                                    <span class="text-muted certificate-text"><i
                                                                class="fa fa-lock"></i> Your transaction is secured with SSL certificate</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <span class="fs-title mb-5 ">Summary</span>
                                <div class="card px-5">
                                    <hr class="mt-3 line">
                                    <div class="p-3 d-flex justify-content-between">
                                        <div class="d-flex flex-column"><span class="sub-titles">Total:</span></div>
                                        <span class="totalPrice">$0</span>
                                    </div>
                                    <div class="p-3">
                                        <input type="submit" name="next" id="submit" class="submit action-button"
                                               value="Check Out & Finish"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous input-data"
                               value="Previous"/>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <div class="col-7">
                                <h2 class="fs-title">Finish:</h2>
                            </div>
                            <div class="col-5">
                                <h2 class="steps">Step 5 - 5</h2>
                            </div>
                        </div>
                        <br><br>
                        <h1 class="display-3" style="color:#B79040">Thank You!</h1>
                        <br>
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-1 justify-content-center"><p class="pb-5">
                                    Thank you for choosing our hotel.
                                    <br/>
                                    <br/>

                                    Our staff is ready to make your stay unforgettable.Please feel free to contact us
                                    for any special requests you may have, so we can make all necessary arrangements
                                    before your arrival.
                                    <br/>
                                    <br/>
                                    We wish you a good trip and we are looking forward for welcoming you very soon.
                                    <br/>

                                </p>
                                <hr class="mx-5 line">
                                <p>
                                    Having trouble? <a href="">Contact us</a>
                                </p>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- SignUp Section End -->

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
<script src="../../Vendor/script/jquery.scrollUp.min.js"></script>
<script src="../../Vendor/script/jquery.slicknav.js"></script>
<script src="../script/mobiscroll.jquery.min.js"></script>


<script>
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
    $(document).ready(function () {

        let current_fs, next_fs, previous_fs; //fieldsets
        let opacity;

        $(".next").click(function () {
            if ($(this).hasClass("next0")) {
                if (!validateForm_0())
                    return;
            } else {
                let url = "SignUp.php"; // the script where you handle the form input.
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#signup").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        alert(data); // show response from the php script.
                    }
                });
                if(!validateForm_1())
                    return ;
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
    //scrll up
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
    // Date Picker

    $(document).ready(function () {
        var now = new Date(),
            week = [now, new Date(now.getFullYear(), now.getMonth(), now.getDate() + 6, 23, 59)];

        // Mobiscroll Range initialization
        $('#demo').mobiscroll().range({
            startInput: '#start',             // More info about startInput: https://docs.mobiscroll.com/4-10-7/range#opt-startInput
            endInput: '#end'                  // More info about endInput: https://docs.mobiscroll.com/4-10-7/range#opt-endInput
        });

        // Mobiscroll Range initialization
        $('#date').mobiscroll().range({
            startInput: '#startDate',         // More info about startInput: https://docs.mobiscroll.com/4-10-7/range#opt-startInput
            endInput: '#endDate',             // More info about endInput: https://docs.mobiscroll.com/4-10-7/range#opt-endInput
            controls: ['date']                // More info about controls: https://docs.mobiscroll.com/4-10-7/range#opt-controls
        });

        // Mobiscroll Range initialization
        $('#demo-non-form').mobiscroll().range({
            showSelector: false               // More info about showSelector: https://docs.mobiscroll.com/4-10-7/range#opt-showSelector
        });

        // Mobiscroll Range initialization
        $('#demo-external').mobiscroll().range({
            showOnTap: false,                 // More info about showOnTap: https://docs.mobiscroll.com/4-10-7/range#opt-showOnTap
            showOnFocus: false,               // More info about showOnFocus: https://docs.mobiscroll.com/4-10-7/range#opt-showOnFocus
            showSelector: false,              // More info about showSelector: https://docs.mobiscroll.com/4-10-7/range#opt-showSelector
            onInit: function (event, inst) {  // More info about onInit: https://docs.mobiscroll.com/4-10-7/range#event-onInit
                inst.setVal(week, true);
            }
        });

        $('#show').click(function () {
            $('#demo-external').mobiscroll('show');
            return false;
        });

    });

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

    $(document).ready(roomSelect());

    function validateForm_0() {
        let start = document.forms["signup"]["start"].value;
        let end = document.forms["signup"]["end"].value;

        if (start == "" || end == "") {
            $("#errorDate").css("display", "block");
            return false;
        } else {
            $("#errorDate").css("display", "none");
        }
        return true;
    }

    function validateForm_1() {
        let first_name = document.forms["signup"]["first_name"].value;
        let last_name = document.forms["signup"]["last_name"].value;
        let day_birthday = document.forms["signup"]["day_birthday"].value;
        let month_birthday = document.forms["signup"]["month_birthday"].value;
        let year_birthday = document.forms["signup"]["year_birthday"].value;
        let mobile = document.forms["signup"]["mobile"].value;
        let country = document.forms["signup"]["country"].value;
        let city = document.forms["signup"]["city"].value;
        let user_email = document.forms["signup"]["user_email"].value;
        let user_password = document.forms["signup"]["user_password"].value;
        let confirm_user_password = document.forms["signup"]["confirm_user_password"].value;


        //personal check
        if (first_name == "") {
            $("#errorFName").css("display", "block");
            return false;
        } else {
            $("#errorFName").css("display", "none");
        }

        if (last_name == "") {
            $("#errorLName").css("display", "block");
            return false;
        } else {
            $("#errorLName").css("display", "none");
        }
        if (day_birthday == "day" || month_birthday == "month" || year_birthday == 'year') {
            $("#errorBDate").css("display", "block");
            return false;
        } else {
            $("#errorBDate").css("display", "none");
        }
        if (mobile.toString().length < 12) {
            $("#errorPhone").css("display", "block");
            return false;
        } else {
            $("#errorPhone").css("display", "none");
        }
        if (city == "") {
            $("#errorCity").css("display", "block");
            return false;
        } else {
            $("#errorCity").css("display", "none");
        }
        if (country == "country") {
            $("#errorCountry").css("display", "block");
            return false;
        } else {
            $("#errorCountry").css("display", "none");
        }
        if (!validateEmail(user_email)) {
            $("#errorEmail").css("display", "block");
            return false;
        } else {
            $("#errorEmail").css("display", "none");
        }
        if (user_password == "") {
            $("#errorPassword").css("display", "block");
            return false;
        } else {
            $("#errorPassword").css("display", "none");
        }
        if (confirm_user_password == "") {
            $("#errorPassword").css("display", "block");
            return false;
        } else {
            $("#errorConfPassword").css("display", "none");
        }
        if (confirm_user_password != "" && confirm_user_password !== user_password) {
            $("#errorMatch").css("display", "block");
            return false;
        } else {
            $("#errorMatch").css("display", "none");
        }
        return true;
    }

    function validateEmail(email) {
        const res = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return res.test(String(email).toLowerCase());
    }

</script>
</html>