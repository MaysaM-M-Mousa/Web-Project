<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>La Terra Santa &reg;</title>
    <link rel="stylesheet" href="../../../Vendor/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../../Vendor/Fonts/font-awesome-4.7.0/css/all.css">
    <link rel="stylesheet" href="../../../Vendor/CSS/flexslider.css">
    <link rel="stylesheet" href="../../CSS/styles.css">
    <link rel="stylesheet" href="../../../Vendor/CSS/flaticon.css" type="text/css">

</head>
<body>

<div class="container">


    <div class="row" style="width: 100%">
<!--        TODO: insert 2 photos here for the restaurant ... -->
        <div class="col-6" style="border: 1px red solid; width: 100%; height: 200px">
            <p>insert photo here</p>
        </div>

        <div class="col-6" style="border: 1px red solid; width: 100%; height: 200px">
            <p>insert photo here</p>

        </div>
    </div>

    <div class="row justify-content-center" style="width: 100%">
        <h1>Categories</h1>
    </div>
    <a href="../../../Home/images/insta-1.jpg"></a>

    <?php

    for ($i = 0; $i < 3; $i++) {
//        TODO: style the cards here ....
        echo '<div class="row">';
        echo '<div class="card mb-3">';
        echo '<img src="../../Home/images/insta-1.jpg" style="width: 100%; height: 180px" class="card-img-top" alt="...">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Category 1</h5>';
        echo '<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>';
        echo '<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>';
        echo '<button class="btn btn-primary" onclick="goToCategory()">Browse</button>';
        echo '</div></div></div>';

    }
    ?>
<!-- TODO: u can read the comment div below to understand it easily :)-->
<!--    <div class="row">-->
<!---->
<!--        <div class="card mb-3">-->
<!--            <img src="../../Home/images/insta-1.jpg" style="width: 100%; height: 180px" class="card-img-top" alt="...">-->
<!--            <div class="card-body">-->
<!--                <h5 class="card-title">Category 1</h5>-->
<!--                <p class="card-text">This is a wider card with supporting text below as a natural-->
<!--                    lead-in to additional content. This content is a little bit longer.</p>-->
<!--                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
<!--                <div class="justify-content-center" style="width: 100%">-->
<!--                    <button class="btn btn-primary">Browse</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

</div>

</body>



</html>
