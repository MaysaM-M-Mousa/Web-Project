<?php
// VALIDATION
require 'pdo.php';
sleep(1);

$sql = "select sub_category.description,sub_category.sub_cat_id,sub_category.sub_cat_name,sub_category.image from sub_category left join category on sub_category.cat_id=category.cat_id where category.category_name='Food' and category.category_name is not null";
$result = $pdo->query($sql);

?>

<div class="container-fluid">
    <!--    Header start-->
    <div class="row">
        <div class="col-8 offset-2">
            <h1 class="main-h1">Restaurant</h1>
            <hr class="line">
            <p class="main-content">
                At La Terra Santa, we serve a tasting menu that highlights the best produce we can source
                from across the Country, with ideas and inspirations from around the world.
            </p>
        </div>
    </div>
    <!-- Header end-->
    <!--Slider Start-->
    <div class="row mt-2">
        <section class="slider col-12 col-md-10 offset-md-1">
            <div class="flexslider">
                <ul class="slides">
                    <li style="background-image: url('images/restaurnat-1.jpg')"></li>
                    <li style="background-image: url('images/restaurnat-2.jpg')"></li>
                    <li style="background-image: url('images/restaurant-3.jpg')"></li>
                </ul>
            </div>
        </section>
        <div class="col-8 offset-2">
            <h2 class="main-h2 mt-5">Categories</h2>
            <hr class="line">
        </div>
    </div>
    <!--     Slider End   -->
    <!-- Cards Start -->
    <div class="row">
        <?php
        $i=0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            ?>
            <div onclick="goToCategory(<?php echo $row['sub_cat_id'] ?>)"
                 class="card Catagories col-10 offset-1 col-xl-5 pr-0 <?php if ($i % 2 == 0) echo 'offset-xl-1'; else echo 'ml-xl-0 offset-xl-0'; ?>">
                <div class="container-fluid no-gutters">
                    <div class="row">
                        <img class="col-md-4 col-12 pr-0" src="../<?php echo $row['image']?>"

                             alt="...">
                        <div class="card-body col-12 col-md-8">
                            <h3 class="main-h3 card-title"><?php echo $row['sub_cat_name'] ?></h3>
                            <hr class="card-line">
                            <p class="card-text"><?php echo $row['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
        ?>
    </div>
    <!--Card end-->
    <script src="Scripts/Restaurant.js" type="text/javascript"></script>
</div>
