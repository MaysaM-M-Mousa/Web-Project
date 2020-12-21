
<link href="../../Vendor/DatePicker/ej2-base/fabric.css" rel="stylesheet" type="text/css" />
<link href="../../Vendor/DatePicker/ej2-calendars/fabric.css" rel="stylesheet" type="text/css" /
<link href="../../Vendor/DatePicker/ej2-buttons/styles/fabric.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../Admin/CSS/styles.css">
<link rel="stylesheet" href="../CSS/signup.css">

<script src="../../Vendor/DatePicker/ej2-base/dist/global/ej2-base.min.js" type="text/javascript"></script>
<script src="../../Vendor/DatePicker/ej2-inputs/dist/global/ej2-inputs.min.js" type="text/javascript"></script>
<script src="../../Vendor/DatePicker/ej2-buttons/dist/global/ej2-buttons.min.js" type="text/javascript"></script>
<script src="../../Vendor/DatePicker/ej2-popups/dist/global/ej2-popups.min.js" type="text/javascript"></script>
<script src="../../Vendor/DatePicker/ej2-lists/dist/global/ej2-lists.min.js" type="text/javascript"></script>
<script src="../../Vendor/DatePicker/ej2-calendars/dist/global/ej2-calendars.min.js" type="text/javascript"></script>

<!--POP UP For Messagess-->
<div id="msg" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="MSGTITLE">Sign In</h3>
            </div>
            <div class="modal-body">
                <div class="model-wrapper">
                    <p class="main-content" id="MSGBODY">Sign In</p>
                </div>
            </div>
        </div>
    </div>
</div>

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
                <form name="signup" id="bookingForm">
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
                                <h2 class="steps">Step 1 - 3</h2>
                            </div>
                            <hr class="line">

                        </div>
                        <div id="date" class="row mt-5">
                            <div class="col-8 offset-2">
                                <input id="daterangepicker" name="date" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <span id="errorDate" class="error"><i class="fas fa-exclamation-circle"></i> Please Fill All Fields Here</span>
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
                        <div class="row mb-5 signin">
                            <h2>Have You Visited Us Before?<a href="#login" class="trigger-btn" data-toggle="modal"> Sign In </a>
                            </h2>
                        </div>
                        <?php
                        if (isset($_SESSION['error_duplicated_email'])) {
                            echo "<span class='offset-md-3' style='color: darkred;font-size: large'>" . $_SESSION['error_duplicated_email'] . "</span>";
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
                                    <select id="day_birthday" class="custom-select" required name="day_birthday">
                                        <option value="">day</option>
                                        <?php
                                        for ($i = 1; $i < 32; $i++)
                                            echo "<option value='$i'>$i</option>";
                                        ?>
                                    </select>
                                </div>

                                <div class="form-check-inline row align-items-center">
                                    <label> Month&nbsp; </label>
                                    <select id="month_birthday" class="custom-select" required name="month_birthday">
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
                                    <select id="year_birthday" class="custom-select" required name="year_birthday">
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
<!---->
<!--                        --><?php
//                        if (isset($_SESSION['error_pass'])) {
//                            echo "<span class='offset-md-3' style='color: red'>" . $_SESSION['error_pass'] . "</span>";
//                            unset($_SESSION['error_pass']);
//                        }
//                        ?>
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

                        <span id="resultMSG"></span>
                        <input type="submit" method="post" name="next" class="action-button" value="Next"/>
                        <input type="button" name="previous" class="previous action-button-previous input-data"
                               value="Previous"/>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<button href="#msg" id="trigermsg" class="trigger-btn" data-toggle="modal" style="opacity: 0"></button>

<!-- SignUp Section End -->

<script>
    $("form").on("submit", function (e) {
        var dataString = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "validateSignUp.php",
            data: dataString,
            success: function (data) {
                $("#MSGBODY").html(data);
                $("#MSGTITLE").html("Ops..");
                $("#trigermsg").click();

                if (data.toString().includes("Thank you")) {
                    sendEmailVerification()
                    $("#MSGTITLE").html("Thank You!");
                    countdown();
                }
            }
        });
        e.preventDefault();
    });
    // Total seconds to wait

    var seconds = 10;
    function countdown() {
        seconds = seconds - 1;
        if (seconds < 0) {
            // Chnage your redirection link here
            window.location = "index.php";
        } else {
            // Update remaining seconds
            document.getElementById("count").innerHTML = seconds;
            // Count down using javascript
            window.setTimeout("countdown()", 1000);
        }
    }

    // Run countdown function
    /*  ---------------------------------------------------
        Description: Reserve Scripts

             1. Form Control Handling (Next,previous)
             2. Date Picker
             3. Room Selector
             4. Validate Date Input

    ---------------------------------------------------------  */

    (function ($) {
// 1. Form Control Handling (Next,previous)
        $(document).ready(function () {
            let current_fs, next_fs, previous_fs; //fieldsets
            let opacity;
            $(".next").click(function () {
                if ($(this).hasClass("next0")) {
                    if (!validateForm()) {
                        return;
                    }
                } else {
                    let url = "SignUp.php"; // the script where you handle the form input.
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
        $(document).ready(roomSelect());
// 2. Date Picker
        $(function () {
            ej.base.enableRipple(window.ripple)
            var daterangepicker = new ej.calendars.DateRangePicker({
                allowEdit: false,
                min: new Date(),
                cssClass: 'date',
                placeholder: 'Visit Date',
                focus: function () {
                    daterangepicker.show();
                }
            });
            daterangepicker.appendTo('#daterangepicker');

        });

    })(jQuery);

    // 3. Room Selector
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
    // 4. Validate Date Input
    function validateForm() {
        let date=document.getElementById('daterangepicker').value;
        if (date === "") {
            $("#errorDate").css("display", "block");
            return false;
        } else {
            $("#errorDate").css("display", "none");
            return true;
        }
    }




</script>
</html>