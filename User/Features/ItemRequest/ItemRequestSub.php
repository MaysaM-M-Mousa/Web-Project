<?php
require_once 'pdo.php';
sleep(1);

if (isset($_POST['cat_id'], $_POST['subCatChosen'])) {
    $cat_id = htmlentities($_POST['cat_id']);

    $sql = 'SELECT * FROM category,sub_category WHERE category.cat_id = sub_category.cat_id AND category.cat_id='.$cat_id;
    $result = $pdo->query($sql);

}


?>

<div class="container-fluid">

    <!--Back Button-->
    <div class="back-btn">
        <i class="fal fa-arrow-left"></i>
    </div>
    <!--Header-->
    <div class="row">
        <div class="col-8 offset-2">
            <h2 class="main-h2 mt-5">Categorie 1</h2>
            <hr class="line">
        </div>
    </div>

    <!--Cards-->
    <!-- Cards Start -->
    <div class="row">
        <?php
        $counter = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div onclick="goToItemReqItems(<?php echo $row['sub_cat_id']?>)"
                 class="card Catagories col-10 offset-1 col-xl-5 pr-0 <?php if ($counter % 2 == 0) echo 'offset-xl-1'; else echo 'ml-xl-0 offset-xl-0'; ?>">
                <div class="container-fluid no-gutters">
                    <div class="row">
                        <img class="col-md-4 col-12 pr-0" src="../<?php echo $row['image']?>"

                             alt="...">
                        <div class="card-body col-12 col-md-8">
                            <h3 class="main-h3 card-title"><?php echo $row['sub_cat_name']?></h3>
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
    <script>

    </script>
</div>


