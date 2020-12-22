<?php
require_once 'pdo.php';
session_start();
//&& !isset($_POST['resend'])

// case 1 : this page is accessed by log in
if (isset($_SESSION['hash_verification']) && isset($_SESSION['user_email'])) {
    // to use it in case of clicking resend
    $_SESSION['temp_user_email'] = $_SESSION['user_email'];
    $to = $_SESSION['user_email'];
    $subject = 'La Terra Santa || Email Verification';
    $headers = 'From: 1.c.f.m.m.a.m@gmail.com';
    $email_msg = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

------------------------
email: ' . $_SESSION['user_email'] . '
------------------------

Please click this link to activate your account:
http://localhost/WebProject/Home/PHP/SignUp/verify.php?email=' . $_SESSION['user_email'] . '&hash=' . $_SESSION['hash_verification'] . '';

    mail($to, $subject, $email_msg, $headers);

    unset($_SESSION['user_email']);
    echo 'An Email was sent to your email, check it out to activate your account';
    echo '<div>did not send? <a href="#" onclick="resendEmailVerification()" style="color: blue">Resend Email</a></div>';
//    echo '<div>did not send? <a href="#" onclick="resendEmailVerification()" style="color: blue">Resend Email</a></div>';

    return;

}

// in case this php file is entered without the 2 cases
//if (!isset($_SESSION['hash_verification']) && !isset($_SESSION['user_email'])) {
//    header("Location: ../../../Home/HTML/index.php");
//    return;
//}
// this page is accessed directly after the sign up
//if (isset($_POST['resend'])) {
//
//    $to = $_SESSION['temp_user_email'];
//    $_SESSION['hash_verification'] = md5(rand(0, 1000));
//    $subject = 'Resending Email Verification';
//    $headers = 'From: 1.c.f.m.m.a.m@gmail.com';
//    $email_msg = 'Thanks for signing up!
//Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
//
//------------------------
//email: ' . $email . '
//------------------------
//
//Please click this link to activate your account:
//http://localhost/WebProject/Home/PHP/SignUp/verify.php?email=' . $_SESSION['temp_user_email'] . '&hash=' . $_SESSION['hash_verification'] . '';
//
//    mail($to, $subject, $email_msg, $headers);
//
//    header("Location: verify.php");
//    return;
//
//}
// checking email verification
if (isset($_GET['email']) && isset($_GET['hash'])) {

    echo 'aha';
    $email = htmlentities($_GET['email']);
    $hash = htmlentities($_GET['hash']);


    $sql = 'select * from person where person_email=:email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":email" => $email));

    // if the person is not registered
    if ($stmt->rowCount() < 1) {
        $_SESSION['err_msg'] = 'you did not create any account';
        header('Location: verify.php');
        return;
    }

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($_SESSION['hash_verification'] != $hash) {
        $_SESSION['err_msg'] = 'invalid hash';
        header('Location: verify.php');
        return;
    }

    // if the account is already activated
    if ($row['active'] == 1) {
        $_SESSION['err_msg'] = 'Your account is already verified!';
        header('Location: verify.php');
        return;
    }

    $sql_update = 'update person set active = :active where person_email = :email';
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute(array(
        ":active" => 1,
        ":email" => $email
    ));

    $_SESSION['verify_suc_msg'] = 'Thank you for creating an account, you can Log in';
    unset($_SESSION['hash_verification']);
    unset($_SESSION['user_email']);
    header('Location: ../../HTML/index.php');
    return;
}


?>

