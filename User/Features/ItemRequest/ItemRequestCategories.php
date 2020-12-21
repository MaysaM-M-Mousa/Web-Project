<?php
require 'pdo.php';
sleep(1);

$sql = "select * from category where category_name != 'food'";
$result = $pdo->query($sql);

?>

<div class="container-fluid">
    <!--    Header start-->
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="main-h1">Item Request</h1>
            <hr class="line">
            <p class="main-content">
                Our Always-On-Duty staff are Happy to serve You what ever you need the moment you order it, making you
                feel Home-comfort is our pressure.
            </p>
        </div>
    </div>
    <!-- Header end-->

    <!-- Cards Start -->
    <div class="row">
        <?php
        $counter = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div onclick="goToItemReqSub(<?php echo $row['cat_id']?>,'<?php echo $row['category_name']?>')"
                 class="card Catagories col-10 offset-1 col-xl-5 pr-0 <?php if ($counter % 2 == 0) echo 'offset-xl-1'; else echo 'ml-xl-0 offset-xl-0'; ?>">
                <div class="container-fluid no-gutters">
                    <div class="row">
                        <img class="col-md-4 col-12 pr-0" src="../<?php echo $row['image']?>" alt="...">
                        <div class="card-body col-12 col-md-8">
                            <h3 class="main-h3 card-title"><?php echo $row['category_name']?></h3>
                            <hr class="card-line">
                            <p class="card-text"><?php echo $row['description']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $counter++;
        }
        ?>
    </div>
    <!--Card end-->
    <script src="Scripts/ItemRequest.js" type="text/javascript"></script>
</div>
