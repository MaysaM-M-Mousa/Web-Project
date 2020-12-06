<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

// it's a get request!

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

    <div class="row justify-content-center">
        <div class="rol-12">
            <h1>Category 1</h1>
        </div>
    </div>

    <?php
    for ($i = 0; $i < 3; $i++) {

        echo '<div class="card-deck row" style="margin: 20px 0">';
        for ($j = 0; $j < 3; $j++) {
            echo '<div class="card">';
            echo '<img src="../../Home/images/insta-1.jpg" class="card-img-top" alt="...">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Card title</h5>';
            echo '<p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>';
            echo '<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>';
            echo '<button class="btn btn-primary">Order Now</button>';
            echo '</div></div>';
        }
        echo '</div>';
    }


    ?>


    <!--            this is the main card, it's easier to understand-->

    <!--    <div class="card-deck">-->
    <!--        <div class="card">-->
    <!--            <img src="..." class="card-img-top" alt="...">-->
    <!--            <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
    <!--                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="card">-->
    <!--            <img src="..." class="card-img-top" alt="...">-->
    <!--            <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>-->
    <!--                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="card">-->
    <!--            <img src="..." class="card-img-top" alt="...">-->
    <!--            <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>-->
    <!--                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

</div>

</body>
</html>

