<?php
require_once 'pdo.php';
session_start();

if (isset($_POST['resend'])) {
    $_SESSION['hash_verification'] = md5(rand(0, 1000));
    header('Location: ../SignUp/verify.php');
    return;
}

//if (isset($_POST['person_email']) && isset($_POST['person_pass'])) {
//
//    if (strlen($_POST['person_email']) < 1 || strlen($_POST['person_pass']) < 1 || strlen($_POST['login']) < 1) {
//        header("Location : login.php");
//        return;
//    }
//    $person_pass = htmlentities($_POST['person_pass']);
//    $person_email = htmlentities($_POST['person_email']);
//
//    $_SESSION['user_email'] = $person_email;
//
//    if (!strpos($person_email, "@")) {
//        $_SESSION['error_message'] = "Email must has '@' character.";
//        header("Location: login.php");
//        return;
//    }
//
//    $hashed_pass = hash("sha256", trim($person_pass, " "));
//    $stmt = $pdo->query("SELECT * FROM person where person_email=" . "'" . trim($person_email, " ") . "'");
//
//    if ($stmt->rowCount() < 1) {
//        $_SESSION['email_not_found_msg'] = "Either user name or password are wrong!";
//        header("Location:login.php");
//        return;
//    }
//
//
//    $row = $stmt->fetch(PDO::FETCH_ASSOC);
//
//    if ($row['active'] == 0) {
//        $_SESSION['error_verification'] = "Your account is not verified yet!";
//        header("Location:login.php");
//        return;
//    }
//
//
//    if ($row['person_pass'] !== $hashed_pass || $row['person_email'] !== $person_email) {
//        $_SESSION['email_not_found_msg'] = "Either user name or password are wrong!";
//        header("Location:login.php");
//        return;
//    }
//
//
//// if everything is okey! store person_role and person_id
//    $_SESSION['person_id'] = $row['person_id'];
//    $_SESSION['person_role'] = $row['person_role'];
//    $_SESSION['activated'] = 1;
//
//    unset($_SESSION['user_email']);
//    header("Location:../../PHP/Edit/edit.php");
//    return;
//
////    header("Location:../../HTML/index.html");
//
//
//}

?>
<?php
//TODO: validtiion look up

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
        echo '<span>All Fields Are Required!</span>';
        return;
    }

    if ($user_pass !== $confirm_user_pass) {
        echo '<span>Passwords are not identical!</span>';
        return;
    }

    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo '<span>Email must has @ character.</span>';
        return;
    }


    $hashed_pass = hash("sha256", $user_pass);

    $hash_verification = md5(rand(0, 1000));// Generate random 32 character hash and assign it to a local variable.
// Example output: f4552671f8909587cf485ea990207f3b
    $_SESSION['hash_verification'] = $hash_verification;

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


//        $_SESSION['hash_verification'] = $hash_verification;
//        $_SESSION['user_email'] = $user_email;
//        header("Location: verify.php");

        $to = $user_email;
        $subject = 'La Terra Santa || Email Verification';
        $headers = 'From: 1.c.f.m.m.a.m@gmail.com';
        $email_msg = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

------------------------
email: ' . $user_email . '
------------------------

Please click this link to activate your account:
http://localhost/WebProject/Home/PHP/SignUp/verify.php?email=' . $user_email . '&hash=' . $hash_verification . '';

        mail($to, $subject, $email_msg, $headers);

        echo "<span style=\"color: darkgreen; font-family: 'Cabin', serif\">Thank you for signing up!, a verification email was sent to you,
                                         please verify your account to continue.  you will be redirected to home page in <span id=\"count\">10</span> Seconds </span>";
        return;
    } catch (PDOException $e) {

        echo '<span style="color: darkred">You already have an account!</span>';
        return;
    }

}


?>