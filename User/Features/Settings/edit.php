<?php
require_once 'pdo.php';
session_start();

/*if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location:../../../Home/HTML/index.php");
    return;
}*/

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['gender']) && isset($_POST['mobile'])
    && isset($_POST['day_birthday']) && isset($_POST['month_birthday'])
    && isset($_POST['year_birthday']) && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['update'])
    && $_POST['update'] == 'updatePI') {

    $first_name = htmlentities($_POST['first_name']);
    $last_name = htmlentities($_POST['last_name']);
    $gender = htmlentities($_POST['gender']);
    $mobile = htmlentities($_POST['mobile']);
    $day = htmlentities($_POST['day_birthday']);
    $month = htmlentities($_POST['month_birthday']);
    $year = htmlentities($_POST['year_birthday']);
    $country = htmlentities($_POST['country']);
    $city = htmlentities($_POST['city']);

    if (strlen($first_name) < 1 || strlen($last_name) < 1 || strlen($gender) < 1
        || strlen($mobile) < 1 || strlen($day) < 1 || strlen($month) < 1
        || strlen($year) < 1 || strlen($country) < 1 || strlen($city) < 1
        || !is_numeric($day) || !is_numeric($year) || !is_numeric($month)
    ) {
        $msg = 'All Fields are required';
        echo '<span style="color: red">' . $msg . '</span>';
        return;
    }

    if (!is_numeric($mobile)) {
        $msg = 'Mobile must be a number';
        echo '<span style="color: red">' . $msg . '</span>';
        return;
    }
    if (strlen($mobile) < 10) {
        $msg = 'Minimum Width is 10';
        echo '<span style="color: red">' . $msg . '</span>';
        return;
    }

    try {
        $sqlstmt = "UPDATE person SET first_name=:first_name,last_name=:last_name,gender=:gender,mobile=:mobile
                    ,day_bd=:day_bd,month_bd=:month_bd,year_bd=:year_bd,country=:country,city=:city
                    where person_id=" . $_SESSION['person_id'];
        $statement = $pdo->prepare($sqlstmt);

        $statement->execute(array(
            ":first_name" => $first_name,
            ":last_name" => $last_name,
            ":gender" => $gender,
            ":mobile" => $mobile,
            ":day_bd" => $day,
            ":month_bd" => $month,
            ":year_bd" => $year,
            ":country" => $country,
            ":city" => $city
        ));
        $msg = "Your information was successfully updated";
        echo '<span style="color: green">' . $msg . '</span>';
        return;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

} // to edit information in case of post request

// to change password
if (isset($_POST['update']) && $_POST['update'] == 'updatePass'
    && isset($_POST['user_pass']) && isset($_POST['confirm_user_pass']) && isset($_POST['old_user_pass'])) {

    $user_pass = htmlentities($_POST['user_pass']);
    $confirm_user_pass = htmlentities($_POST['confirm_user_pass']);
    $old_user_pass = htmlentities($_POST['old_user_pass']);

    if (strlen($user_pass) < 1 || strlen($confirm_user_pass) < 1 || strlen($old_user_pass) < 1) {
        $msg = 'All Fields are required';
        echo '<span style="color: red">' . $msg . '</span>';
        return;
    }

    $pass_stmt = "select person_pass from person where person_id=" . $_SESSION['person_id'];
    $pass_result = $pdo->query($pass_stmt);
    $pass_row = $pass_result->fetch(PDO::FETCH_ASSOC);

    if ($pass_row['person_pass'] !== hash('sha256', $old_user_pass)) {
        $msg = "Incorrect password!";
        echo '<span style="color: red">' . $msg . '</span>';
        return;
    }

    if ($user_pass !== $confirm_user_pass) {
        $msg = "Passwords are not identical!";
        echo '<span style="color: red">' . $msg . '</span>';
        return;
    }

    $hashed_pass = hash("sha256", $user_pass);

    try {
        $sqlstmt = "UPDATE person SET person_pass=:person_pass where person_id=" . $_SESSION['person_id'];

        $statement = $pdo->prepare($sqlstmt);

        $statement->execute(array(":person_pass" => $hashed_pass));
        $msg = "Your information was successfully updated";
        echo '<span style="color: green">' . $msg . '</span>';
        return;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

if (isset($_POST['apply']) && $_POST['apply'] == 'applyForAJob' && isset($_POST['apply'])
    && $_POST['apply'] == 'applyForAJob' && isset($_POST['education']) && isset($_POST['major']) &&
    isset($_POST['language']) && isset($_POST['skills']) && isset($_POST['job_type']) && isset($_POST['position'])
    && isset($_POST['about'])) {


    $education = htmlentities($_POST['education']);
    $major = htmlentities($_POST['major']);
    $language = htmlentities($_POST['language']);
    $skills = htmlentities($_POST['skills']);
    $job_type = htmlentities($_POST['job_type']);
    $position = htmlentities($_POST['position']);
    $about = htmlentities(trim($_POST['about'], " "));
    $person_id = htmlentities($_SESSION['person_id']);

    if (strlen($education) < 1 || strlen($major) < 1 || strlen($language) < 1 || strlen($skills) < 1 || strlen($job_type) < 1 ||
        strlen($position) < 1 || strlen($about) < 1 || strlen($about > 1500)) {
        $msg = 'All Fields Are Required!';
        echo '<span style="color: red">' . $msg . '</span>';
        return;
    }

    try {
        $sql = "insert into forms (education,major,skills,languages,job_type,position,about,person_id) values
    (:education,:major,:skills,:languages,:job_type,:position,:about,:person_id)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute(array(
            ":education" => $education,
            ":major" => $major,
            ":languages" => $language,
            ":skills" => $skills,
            ":job_type" => $job_type,
            ":position" => $position,
            ":about" => $about,
            ":person_id" => $person_id
        ));
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    $msg = 'Your application is successfully sent!';
    echo '<span style="color: green">' . $msg . '</span>';
    return;

}


// here i need to select data of the user and upload it to the form
$sql = "select * from person where person_id=" . $_SESSION['person_id'];
$result = $pdo->query($sql);

// to check it's in the database
if ($result->rowCount() < 1) {
    header("Location: ../../HTML/index.php");
    return;
}
$row = $result->fetch(PDO::FETCH_ASSOC);

$person_email_form = $row['person_email'];
$first_name_form = $row['first_name'];
$last_name_form = $row['last_name'];
$mobile_form = $row['mobile'];
$gender_form = $row['gender'];
$day_form = $row['day_bd'];
$month_form = $row['month_bd'];
$year_form = $row['year_bd'];
$country_form = $row['country'];
$city_form = $row['city'];
$person_role_form = $row['person_role'];

?>

<div class="container">
    <!--    Header-->
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="main-h1">Settings</h1>
            <hr class="line">
        </div>
    </div>

    <div class="accordion card-forms" id="accordionExample">
        <!--Edit personal info start-->
        <div class="card card-settings">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn card-btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Personal Information
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['error_duplicated_email'])) {
                        echo "<span class='offset-md-3' style='color:darkred;font-size: large'>'" . $_SESSION['error_duplicated_email'] . "</span>";
                        unset($_SESSION['error_duplicated_email']);
                    }
                    ?>
                    <!--Name Start-->
                    <div class="form-group row align-items-center">
                        <label class="col-12 col-md-3" for="first_name">First Name:</label>
                        <input class="col-12 col-md-9 form-control" type="text" id="first_name" name="first_name"
                               required
                               value="<?php echo $first_name_form ?>">
                    </div>

                    <div class="form-group row align-items-center">
                        <label class="col-12 col-md-3" for="last_name">Last Name:</label>
                        <input class="col-12 col-md-9 form-control" type="text" id="last_name" name="last_name"
                               required
                               value="<?php echo $last_name_form ?>">
                    </div>
                    <!--Name End-->

                    <!--birthday Start-->
                    <div class="form-group row align-items-center">
                        <label class="col-3">Birthday:</label>
                        <!-- Day-->
                        <div class="pl-0 align-items-center col-3">
                            <label>Day</label>
                            <select class="custom-select" id="day" required name="day_birthday">
                                <option selected>day</option>
                                <?php
                                for ($i = 1; $i < 32; $i++)
                                    if ($day_form == $i)
                                        echo "<option selected value='$i'>$i</option>";
                                    else
                                        echo "<option value='$i'>$i</option>";
                                ?>
                            </select>
                        </div>
                        <!--Month-->
                        <div class="pl-0 align-items-center col-3">
                            <label>Month</label>
                            <select class="custom-select select" id="month" required name="month_birthday">
                                <option selected>month</option>

                                <?php
                                $arr = array("January", "February", "March", "April", "May", "June", "July", "August",
                                    "September", "October", "November", "December");

                                for ($i = 1; $i < 13; $i++)
                                    if ($month_form == $i)
                                        echo "<option selected value='$i'>" . $arr[$i - 1] . "</option>";
                                    else
                                        echo "<option value='$i'>" . $arr[$i - 1] . "</option>";
                                ?>
                            </select>
                        </div>
                        <!--Year-->
                        <div class="pl-0 align-items-center col-3">
                            <label class="">Year</label>
                            <select class="custom-select" id="year" required name="year_birthday">
                                <option selected>year</option>
                                <?php
                                for ($i = 2000; $i >= 1900; $i--)
                                    if ($year_form == $i)
                                        echo "<option selected value='$i'>$i</option>";
                                    else
                                        echo "<option value='$i'>$i</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--End of BD-->
                    <!--phone-->
                    <div class="form-group row align-items-center align-items-center">

                        <label class="col-12 col-md-3" for="mobile">Mobile Number:</label>
                        <input class="col-12 col-md-9 form-control" type="tel" id="mobile" name="mobile"
                               required placeholder="970599999999" value="<?php echo $mobile_form ?>">
                    </div>
                    <!--                    Country-->
                    <div class="form-group row align-items-center">
                        <label class="col-12 col-md-3">Country:</label>
                        <select class="custom-select col-12 col-md-9" id="country" name="country" required>
                            <option selected>country</option>
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
                                if ($country_form == $countries[$i])
                                    echo "<option selected value='$countries[$i]'>$countries[$i]</option>";
                                else
                                    echo "<option value='$countries[$i]'>$countries[$i]</option>";

                            ?>
                        </select>
                    </div>
                    <!--  End country-->
                    <!--Gender-->
                    <div class="form-group row justify-content-start">
                        <label class="col-12 col-md-3">Gender:</label>
                        <div class="pl-0 col-4 col-md-3 form-check form-check-inline mr-0 align-items-baseline">
                            <label class="form-check-label">Male</label>
                            <input type="radio" class="form-check-input" id="maleG" name="gender" value="male"
                                <?php echo $gender_form === 'male' ? "checked" : "" ?>>
                        </div>
                        <div class="pl-0 col-4 col-md-3 form-check form-check-inline mr-0 align-items-baseline">
                            <label class="form-check-label">Female</label>
                            <input type="radio" class="form-check-input" id="femaleG" name="gender"
                                   value="female"
                                <?php echo $gender_form === 'female' ? "checked" : "" ?>>
                        </div>
                        <div class="pl-0 col-4 col-md-3 form-check form-check-inline mr-0 align-items-baseline">
                            <label class="form-check-label">Keep it personal</label>
                            <input type="radio" class="form-check-input" id="personalG" name="gender"
                                   value="personal"
                                <?php echo $gender_form === 'personal' ? "checked" : "" ?>>
                        </div>
                    </div>
                    <!--end of Gender-->
                    <!-- City-->
                    <div class="form-group row align-items-center">
                        <label class="col-12 col-md-3" for="city">City:</label>
                        <input class="col-12 col-md-9 form-control" type="text" id="city" name="city" required
                               value="<?php echo $city_form ?>">
                    </div>
                    <!--Email-->
                    <div class="form-group row align-items-center">
                        <label class="col-12 col-md-3" for="user_email">Email:</label>
                        <input class="col-12 col-md-9 form-control" type="email" id="user_email" name="user_email"
                               placeholder="ex@gmail.com"
                               disabled required value="<?php echo $person_email_form ?>">
                    </div>
                    <!--buttons-->
                    <div class="form-group row">
                        <div class="col-12 text-center ">
                            <input type="submit" class="btn btn-primary mb-2 ml-auto mr-auto " name="updatePersonalInfo"
                                   value="Save Changes" id="updatePIBTN">
                        </div>
                    </div>
                </div>
                <div id="piMSG">
                </div>
                <!--</form>-->
            </div>
        </div>
        <!-- Edit personal info End-->
        <div class="card card-settings">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn card-btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Change Password
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="form-group row align-items-center">
                        <label class="col-5" for="old_user_password">Current Password:</label>
                        <input class="col-6 form-control" type="password" id="old_user_password" name="old_user_pass"
                               required>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-5" for="user_password">New Password:</label>
                        <input class="col-6 form-control" type="password" id="user_password" name="user_pass" size="30"
                               required>
                    </div>
                    <div class="form-group row align-items-center">
                        <label class="col-5" for="confirm_user_password">Confirm New Password:</label>
                        <input class="col-6 form-control" type="password" id="confirm_user_password"
                               name="confirm_user_pass" size="30" required>
                    </div>


                    <div class="form-group row align-items-center">
                        <div class="offset-4 col-3">
                            <input id="changePassBTN" class="btn btn-primary mb-2" name="updatePass"
                                   value="Save Changes"
                                   style="width: 150px">
                        </div>
                    </div>
                    <div id="passMSG" class="row"></div>
                </div>
            </div>
        </div>
        <div class="card card-settings">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn card-btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Apply for a Job
                    </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row">
                        <!--first part of the form-->
                        <div class="col-12 col-xl-6">
                            <div class="form-group row align-items-center row">
                                <label class="col-3 innerLabel" for="education">Education:</label>
                                <div class="row col-9">
                                    <label class="col-12 " style="font-size: small">What is your highest education?
                                        <span style="color: red; font-size: large">*</span>
                                    </label>
                                    <select class="custom-select col-12" id="education" name="education" required>
                                        <option value="">education</option>
                                        <?php
                                        $arr = array("Primary school", "Highschool", "Vocational training", "Diploma",
                                            "Baccalaureate", "Master");

                                        for ($i = 0; $i < sizeof($arr); $i++)
                                            echo "<option value='$i'>" . $arr[$i] . "</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12 align-items-center row">
                                <label class="col-3 innerLabel" for="major">Major:</label>
                                <div class="row col-9">
                                    <label class="col-12 " style="font-size: small">What is your major?</label>
                                    <input class="col-12 form-control" type="text" id="major" name="major" size="30">
                                </div>
                            </div>
                            <div class="form-group col-12 align-items-center row">
                                <label class="col-3 innerLabel" for="language">Languages:</label>
                                <div class="row col-9">
                                    <label class="col-12 " style="font-size: small">Languages you speak?
                                        <span style="color: red; font-size: large">*</span>
                                    </label>
                                    <input class="col-12 form-control" type="text" id="language" name="language"
                                           size="30" required>
                                </div>
                            </div>
                            <div class="form-group col-12 align-items-center row">
                                <label class="col-3 innerLabel" for="skills">Skills:</label>
                                <div class="row col-9">
                                    <label class="col-12 " style="font-size: small">Write skills you earned
                                        <span style="color: red; font-size: large">*</span>
                                    </label>
                                    <input class="col-12 form-control" type="text" id="skills" name="skills" size="30"
                                           required>
                                </div>
                            </div>
                            <div class="form-group col-12 align-items-center row">
                                <label class="col-3 innerLabel" for="skills">Job Type:</label>

                                <div class="row col-9">

                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="job_type" value="0">Full
                                            Time
                                        </label>
                                    </div>
                                    <div class="form-check-inline" style="margin-left: 40px">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="job_type" value="1">Part
                                            Time
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--second part of the form-->
                        <div class="col-12 col-xl-6">
                            <div class="form-group row align-items-center">
                                <label class="col-3 innerLabel" for="position">Position:</label>
                                <div class="row col-9">
                                    <label class="col-12 " style="font-size: small">You are applying to be a?
                                        <span style="color: red; font-size: large">*</span>
                                    </label>
                                    <select class="custom-select col-12" id="position" name="position" required>
                                        <option value="">position</option>
                                        <?php
                                        $arr = array("Security", "Chef", "Waiter");
                                        for ($i = 0; $i < sizeof($arr); $i++)
                                            echo "<option value='$i'>" . $arr[$i] . "</option>";
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12 align-items-center row">
                                <label class="col-3 innerLabel" for="about">About you:</label>
                                <div class="row col-9">
                                    <label class="col-12 ">
                                        Tell us about yourself, if you have a previous experience, training, and
                                        certificates
                                        you earned.<span class="error">*</span>
                                    </label>
                                    <textarea class="col-12 form-control" type="text" id="about" name="about" rows="9"
                                              maxlength="1500"
                                              required placeholder="type here">
                                    </textarea>
                                </div>
                            </div>
                            <div class="row col-12 ">
                                <input id="applyJobBTN" class="btn btn-primary mb-2" value="Apply Now">
                            </div>
                        </div>
                        <div id="applyResult"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-settings">
            <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn card-btn btn-link btn-block text-left collapsed" type="button"
                            data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Contact Us
                    </button>
                </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>


<script>


    $("#updatePIBTN").on('click', function () {
        // get the chosen gender
        var checked_gender = document.querySelector('input[name = "gender"]:checked');

        $.post('../Features/Settings/edit.php', {
            'update': 'updatePI',
            'first_name': document.getElementById("first_name").value,
            'last_name': document.getElementById("last_name").value,

            'gender': checked_gender.value,
            'mobile': document.getElementById("mobile").value,

            'day_birthday': document.getElementById("day").value,
            'month_birthday': document.getElementById("month").value,
            'year_birthday': document.getElementById("year").value,

            'country': document.getElementById("country").value,

            'city': document.getElementById("city").value

        }, function (data, status) {
            if (status == 'success') {
                document.getElementById('piMSG').innerHTML = data;
            }
        })
    });

    // AJAX for changing password
    $("#changePassBTN").click(function () {

        $.post('../Features/Settings/edit.php', {
            'update': 'updatePass',
            'user_pass': document.getElementById('user_password').value,
            'confirm_user_pass': document.getElementById('confirm_user_password').value,
            'old_user_pass': document.getElementById('old_user_password').value
        }, function (data, status) {
            if (status == 'success') {
                document.getElementById('passMSG').innerHTML = data;
            }
        })
    })

    // AJAX for applying a job
    $("#applyJobBTN").click(function () {
        var checked_job_type = document.querySelector('input[name = "job_type"]:checked');
        $.post('../Features/Settings/edit.php', {
            'apply': 'applyForAJob',
            'education': document.getElementById('education').value,
            'major': document.getElementById('major').value,
            'language': document.getElementById('language').value,
            'skills': document.getElementById('skills').value,
            'job_type': checked_job_type.value,
            'position': document.getElementById('position').value,
            'about': document.getElementById('about').value
        }, function (data, status) {
            if (status == 'success') {
                if (data == 'Your application is successfully sent!') {
                    document.getElementById('applyResult').innerHTML = data;
                    onwaiting()
                }
                document.getElementById('applyResult').innerHTML = data;
            }
        })
    })
</script>
