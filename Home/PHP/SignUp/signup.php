<?php
require_once 'pdo.php';
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
    <title>Palestine Hotel</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>


    <style>
        label {
            font-size: large;
        }

        .form-group {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-sm">
    <div class="container">
        <a id="brand" class="navbar-brand" href="../../HTML/index.php">Palestine Hoter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navdiv">
            <span class="navbar-toggler-icon" style="color:white"></span>
        </button>

        <div class="collapse navbar-collapse" id="navdiv">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-home fa-lg"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link"><i class="fa fa-info fa-lg"></i> About</a></li>
                <li class="nav-item"><a class="nav-link"><i class="fa fa-inbox fa-lg"></i> Contact Us</a></li>
            </ul>
        </div>

        <button class="btn btn-outline-primary my-2 my-sm-0">Search</button>
    </div>
</nav>

<div class="container" style="margin-top: 20px">
    <form method="post" class="col-10">

        <?php
        if (isset($_SESSION['error_duplicated_email'])) {
            echo "<span class='offset-md-3' style='color: red;font-size: large'>" . $_SESSION['error_duplicated_email'] . "</span>";
            unset($_SESSION['error_duplicated_email']);
        }

        ?>

        <div class="form-group row align-items-center">
            <label class="col-3" for="first_name">First Name:</label>
            <input class="col-6 form-control" type="text" id="first_name" name="first_name" size="30" required>
        </div>


        <div class="form-group row align-items-center">
            <label class="col-3" for="last_name">Last Name:</label>
            <input class="col-6 form-control" type="text" id="last_name" name="last_name" size="30" required>
        </div>


        <!--        birthday-->

        <div class="form-group row align-items-center">
            <label class="col-3">Birthday:</label>
            <div class="col-9 row">


                <div class="form-check-inline row align-items-center">
                    <label class="col-5">Day</label>
                    <select class="custom-select col-7" required name="day_birthday">
                        <option value="">day</option>
                        <?php
                        for ($i = 1; $i < 32; $i++)
                            echo "<option value='$i'>$i</option>";
                        ?>
                    </select>
                </div>

                <div class="form-check-inline row align-items-center">
                    <label class="col-5">Month</label>
                    <select class="custom-select col-7" required name="month_birthday">
                        <option value="">month</option>

                        <?php
                        $arr = array("January", "February", "March", "April", "May", "June", "July", "August",
                            "September", "October", "November", "December");

                        for ($i = 1; $i < 13; $i++)
                            echo "<option value='$i'>" . $arr[$i - 1] . "</option>";
                        ?>

                    </select>
                </div>

                <div class="form-check-inline row">
                    <label class="col-5">Year</label>
                    <select class="custom-select col-7" required name="year_birthday">
                        <option value="">year</option>
                        <?php
                        for ($i = 2021; $i >= 1900; $i--)
                            echo "<option value='$i'>$i</option>";
                        ?>
                    </select>
                </div>
            </div>

        </div>


        <!--        end of BD-->

        <div class="form-group row align-items-center align-items-center">
            <label class="col-3" for="mobile">Mobile Number:</label>
            <input class="col-6 form-control" type="tel" id="mobile" name="mobile" size="30"
                   required placeholder="970599******">
        </div>

        <div class="form-group row align-items-center">
            <label class="col-3">Country:</label>
            <select class="custom-select col-6" name="country" required>
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
        </div>

        <!--        country-->


        <!--Gender-->
        <div class="form-group row align-items-center">
            <label class="col-3">Gender:</label>

            <div class="col-6">
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="male">Male
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="female">Female
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="personal">Keep it personal
                    </label>
                </div>
            </div>

        </div>
        <!--end of Gender-->


        <div class="form-group row align-items-center">
            <label class="col-3" for="city">City:</label>
            <input class="col-6 form-control" type="text" id="city" name="city" size="30" required>

        </div>


        <div class="form-group row align-items-center">
            <label class="col-3" for="user_email">Email:</label>
            <input class="col-6 form-control" type="email" id="user_email" name="user_email" placeholder="ex@gmail.com"
                   size="30" required>
        </div>


        <div class="form-group row align-items-center">
            <label class="col-3" for="user_password">Password:</label>
            <input class="col-6 form-control" type="password" id="user_password" name="user_pass" size="30"
                   required>
        </div>

        <?php
        if (isset($_SESSION['error_pass'])) {
            echo "<span class='offset-md-3' style='color: red'>" . $_SESSION['error_pass'] . "</span>";
            unset($_SESSION['error_pass']);
        }
        ?>


        <div class="form-group row align-items-center">
            <label class="col-3" for="confirm_user_password">Confirm Password:</label>
            <input class="col-6 form-control" type="password" id="confirm_user_password" name="confirm_user_pass"
                   size="30" required>
        </div>

        <div class="form-group row align-items-center">
            <div class="offset-3 col-7 row">
                <div class="col-6">
                    <input type="submit" class="btn btn-primary mb-2" name="login" value="Sign Up"
                           style="  width: 150px">
                </div>
                <div class="col-6">
                    <a class="btn btn-secondary mb-2" href="../../HTML/index.php"
                       style=" width: 100px">Cancel</a>
                </div>
            </div>

        </div>

    </form>
</div>

</body>
