<?php
require_once 'pdo.php';
session_start();
// TODO this file has been marged with index.php this is a note خدعتك
//if(isset($_SESSION['person_id']) && isset($_SESSION['person_role'])){
//    header("Location:../../HTML/index.php");
//    return;
//}


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

//    header("Location:../../HTML/index.php");


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

        <a class="btn btn-outline-primary my-2 my-sm-0" href="../../../User/PHP/Edit/edit.php">Edit Profile</a>
        <!--        <button class="btn btn-outline-primary my-2 my-sm-0">Edit Profile</button>-->
    </div>
</nav>

<div class="container">
    <div class="row">

        <form method="post">

            <div class="form-group row aling-items-center">
                <label class="col-3 " for="user_email">Email:</label>
                <input class="col-6 form-control" type="email" id="user_email" size="50" name="person_email"
                       placeholder="ex@gmail.com" size="50" required>
            </div>
            <div class="form-group row aling-items-center">
                <label class="col-3" for="user_pass">Password:</label>
                <input class="col-6 form-control" type="password" id="user_pass" size="50" name="person_pass" size="50"
                       required>

            </div>

            <?php

            if (isset($_SESSION['error_message'])) {
                echo "<span class='offset-md-3' style='color: red'>" . $_SESSION['error_message'] . "</span>";
                unset($_SESSION['error_message']);
            } else if (isset($_SESSION['email_not_found_msg'])) {
                echo "<span class='offset-md-3' style='color: red'>" . $_SESSION['email_not_found_msg'] . "</span>";
                unset($_SESSION['email_not_found_msg']);
            }
            ?>

            <div class="form-group row aling-items-center offset-md-3">
                <button type="submit" class="btn btn-primary mb-2" name="login" value="log">Sign In</button>
                <a class="btn btn-secondary mb-2" href="../../HTML/index.php" style="margin-left: 20px">Cancel</a>
            </div>


        </form>

        <?php
        if (isset($_SESSION['error_verification'])) {
            unset($_SESSION['error_verification']);
            echo '<form method="post">';
            echo '<input type="submit" name="resend" value="Resend Email" class="offset-3"> ';
            echo '</form>';
        }
        ?>
    </div>
</div>


</body>
</html>