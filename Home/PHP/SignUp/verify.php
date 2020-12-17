<?php
require_once 'pdo.php';
session_start();
//&& !isset($_POST['resend'])

// case 1 : this page is accessed by log in
if (isset($_SESSION['hash_verification']) && isset($_SESSION['user_email'])) {
    // to use it in case of clicking resend
    $_SESSION['temp_user_email'] = $_SESSION['user_email'];
    $to = $_SESSION['user_email'];
    $subject = 'Email Verification';
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
    echo 'An Email was sent to you, check it out';
    echo '<div>did not send? <a href="#" onclick="resendEmailVerification()" style="color: blue">Resend Email</a></div>';
//    echo '<div>did not send? <a href="#" onclick="resendEmailVerification()" style="color: blue">Resend Email</a></div>';

    return;

}
// in case this php file is entered without the 2 cases
if (!isset($_SESSION['hash_verification']) && !isset($_SESSION['user_email'])) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
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

<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">-->
<!--    <title>Palestine Hotel</title>-->
<!---->
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"-->
<!--          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!---->
<!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"-->
<!--            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"-->
<!--            crossorigin="anonymous"></script>-->
<!--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"-->
<!--            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"-->
<!--            crossorigin="anonymous"></script>-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"-->
<!--            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"-->
<!--            crossorigin="anonymous"></script>-->
<!---->
<!---->
<!--    <style>-->
<!--        label {-->
<!--            font-size: large;-->
<!--        }-->
<!---->
<!--        .form-group {-->
<!--            margin-top: 20px;-->
<!--            margin-bottom: 20px;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<nav class="navbar navbar-dark bg-dark navbar-expand-sm">-->
<!--    <div class="container">-->
<!--        <a id="brand" class="navbar-brand" href="../../HTML/index.php">Palestine Hoter</a>-->
<!--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navdiv">-->
<!--            <span class="navbar-toggler-icon" style="color:white"></span>-->
<!--        </button>-->
<!---->
<!--        <div class="collapse navbar-collapse" id="navdiv">-->
<!--            <ul class="navbar-nav mr-auto">-->
<!--                <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-home fa-lg"></i> Home</a></li>-->
<!--                <li class="nav-item"><a class="nav-link"><i class="fa fa-info fa-lg"></i> About</a></li>-->
<!--                <li class="nav-item"><a class="nav-link"><i class="fa fa-inbox fa-lg"></i> Contact Us</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!---->
<!--        <button class="btn btn-outline-primary my-2 my-sm-0">Search</button>-->
<!--    </div>-->
<!--</nav>-->
<!---->
<!--<div class="container">-->
<!--    <form method="post">-->
<!--        <p>A verification email has been sent to you, check your email!</p>-->
<!--        <p>did not send ?</p>-->
<!--        <input type="submit" name="resend" value="Resend Email">-->
<!--    </form>-->
<!---->
<!--</div>-->
<!---->
<!--<div class="container">-->
<!---->
<!--    --><?php
//    if (isset($_SESSION['err_msg'])) {
//        echo $_SESSION['err_msg'];
//        unset($_SESSION['err_msg']);
//    } else if (isset($_SESSION['verify_suc_msg'])) {
//        echo $_SESSION['verify_suc_msg'];
//        echo '<a href="../../../Home/PHP/SignIn/login.php">Log in </a>';
//        unset($_SESSION['verify_suc_msg']);
//    }
//    ?>
<!--</div>-->
<!---->
<!---->
<!--</body>-->
