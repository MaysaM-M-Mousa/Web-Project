<?php
session_start();
require_once 'pdo.php';
if (isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {

    $fullName = htmlentities($_POST['fullName']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    if (strlen($fullName) < 1 || strlen($email) < 1 || strlen($subject) < 1 || strlen($message) < 1) {
        header("Location: contact.php");
        return;
    }

    try {
        $sql = "insert into contacts (full_name,email,subject,message) values
            (:full_name,:email,:subject,:message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":full_name" => $fullName,
            ":email" => $email,
            ":subject" => $subject,
            ":message" => $message
        ));

        $_SESSION['suc_msg'] = "Your feedback is successfully sent!, Thanks for contacting us.";
        header("Location: contact.php");
        return;
    }catch (Exception $e){
        echo $e->getMessage();
    }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Welcome To The Club!</title>

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
        * {
            box-sizing: border-box;
        }

        form input {
            margin-top: 5px;
            margin-bottom: 5px;
        }

    </style>

</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-sm">
    <div class="container">
        <a id="brand" class="navbar-brand" href="#">Palestine Hoter</a>
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
        <a role="button" class="btn btn-outline-primary my-6 my-sm-0" href="../SignUp/signup.php">Sign Up</a>
        <a role="button" class="btn btn-outline-primary my-4 my-sm-0" href="../SignIn/login.php">Sign In</a>
        <a role="button" class="btn btn-outline-primary my-2 my-sm-0" href="../../../User/PHP/ApplyJob/applyjob.php">Apply
            for a job</a>
        <a role="button" class="btn btn-outline-primary my-0 my-sm-0" href="../../PHP/ContactUs/contact.php">Contact
            Us</a>


        <!--        <button class="btn btn-outline-primary my-2 my-sm-0"><a href="../../Home/PHP/SignUp/signup.php">Search</a></button>-->

    </div>
</nav>

<header class="jumbotron">
    <div class="container">
        <div class="row row-header">
            <div class="col-sm-6">
                <h1>Contact With Us</h1>
            </div>
            <div class="col-12 col-sm-6">
                <div class="row align-item-center justify-content-center">

                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">


    <div class="row">
        <?php
        if (isset($_SESSION['suc_msg'])) {
            echo "<span class='offset-md-3' style='color: green;font-size: large'>" . $_SESSION['suc_msg'] . "</span>";
            unset($_SESSION['suc_msg']);
        }
        ?>

        <form method="post" class="offset-1 col-10">
            <div class="form-group row col-12">
                <input class="col-6 form-control" type="text" name="fullName" placeholder="Full Name" required>

                <input class="col-6 form-control" type="email" name="email" placeholder="Email" required>

            </div>
            <div class="form-group row col-12">
                <input class="form-control col-12" type="text" name="subject" placeholder="Subject">

            </div>
            <div class="form-group row col-12">
                <textarea class="col-12 form-control" type="text" id="message" name="message" rows="10" maxlength="3000"
                          required placeholder="Your message">
                </textarea>
            </div>
            <div class="form-group">
                <input class="btn btn-primary mb-2" type="submit" name="send" value="Send"
                       style="width: 100px; float: right">
            </div>
        </form>
    </div>

</div>

<footer class="footer" id="ff" style="background-color: #999999">
    <div class="container">
        <div class="row">

            <div class="col-3 col-sm-3 offset-1">
                <h4>Links</h4>
                <ul class="list-unstyled" style="margin-left:10px">
                    <li>Home</li>
                    <li>About</li>
                    <li>Contact</li>
                </ul>
            </div>

            <div class="col-6 col-sm-4">
                <h4>Contact Us</h4>
                <p>121, Clear Water Bay Road
                    <br>Clear Water Bay, Kowloon
                    <br>Clear Water Bay, Kowloon
                    <br>HONG KONG
                    <br>Tel.: +852 1234 5678
                    <br>Fax: +852 8765 4321
                    <br>Email: confusion@food.net
                </p>
            </div>

            <div class="col-12 col-sm-4 align-self-center">
                <p align="center">Google+ Facebook LinkedIn Twitter YouTube <br>Mail</p>
            </div>


        </div>

        <div class="row justify-content-center">
            <div class="col-auto">
                <p>© Copyright 2018 Ristorante Con Fusion</p>
            </div>
        </div>

    </div>
</footer>

<script src="../../JavaScript/contactus.js"></script>
</body>
</html>