<?php
// VALIDATION
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}sleep(1);

if (isset($_POST['sub_cat_id'], $_POST['catChosen'])) {

    $sub_cat_id = htmlentities($_POST['sub_cat_id']);

    $sql = 'select * from sub_category left join item  on item.sub_cat_id = sub_category.sub_cat_id where sub_category.sub_cat_id=' . $sub_cat_id . ' and item.item_name is not null';
    $result = $pdo->query($sql);
}

if (isset($_POST['item_id'], $_POST['quantity'])) {
    if (!isset($_SESSION['book_id']) || $_SESSION['book_id'] === 'none') {
        echo '<span style="color: red; font-family: Cabin, serif">You are not allowed to order till you reserve and you are in hotel lands!</span>';
        return;
    } else {
        $date = date('Y-m-d H:i:s');
        $item_id = htmlentities(trim($_POST['item_id']));
        $book_id = $_SESSION['book_id'];
        $quantity = htmlentities(trim($_POST['quantity']));

        $sql = 'select end_date from booking where booking.book_id=:book_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':book_id' => $_SESSION['book_id']
        ));

        // in case that the user still signed up and his booking expires => prevent him from do actions
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['end_date'] < date('Y-m-d')) {
            echo 'test';
            return '';
        }

        $sql = 'insert into orders(book_id,item_id,order_time,quantity) values(:book_id,:item_id,:order_time,:quantity)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':book_id' => $book_id,
            ':item_id' => $item_id,
            ':order_time' => $date,
            ':quantity' => $quantity
        ));

        echo '<span style="color: darkgreen;font-family: Cabin, serif">Thank you, your order is successfully registered!</span>';
        return;
    }
}

?>
<div id="msg" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="MSGTITLE"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="model-wrapper">
                    <p class="main-content" id="MSGBODY"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!--Back Button-->
    <div id="back-btn" class="back-btn">
        <i class="fal fa-arrow-left"></i>
    </div>
    <!-- Header-->
    <div class="row">
        <div class="col-8 offset-2">
            <h2 id="headerCat" class="main-h2 mt-5"></h2>
            <hr class="line">
        </div>
    </div>

    <!--Cards-->
    <?php
    $counter = 0;
    for ($i = 0; $i < $result->rowCount() / 2; $i++) {
        echo '<div class="row cardsrow">'; ?>
        <?php for ($j = 0; $j < (($counter == $result->rowCount() && $result->rowCount() % 2 == 1) ? 1 : 2); $j++) {
            $counter++;
            $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="card card-food h-limit col-10 offset-1 col-xl-5 pr-0 ">
                <div class="container-fluid no-gutters">
                    <div class="row">
                        <img class="col-4 pr-0" src="../<?php echo $row['image']?>">
                        <div class="card-body col-8">
                            <div class="price">
                                <div class="price-text"><?php echo $row['item_price']?>$
                                    <hr class="card-line">
                                </div>
                            </div>
                            <h3 class="main-h3 card-title"><?php echo $row['item_name'] ?></h3>
                            <hr class="card-line"/>
                            <p class="card-text"><?php echo $row['item_description'] ?></p>
                            <div class="quntity">
                                <input type="number" id="quantityInput<?php echo $counter ?>" style="text-align: center" value="1" min="1">
                            </div>
                            <button class="btn btn-primary order col-12 order-btn" type="button" data-toggle="collapse"
                                    data-target="<?php echo '#collapseOrder' . $counter ?>">
                                Order
                            </button>
                            <button class="btn btn-danger" style="opacity: 0"
                                    onclick="orderItem(<?php echo $row['item_id'] ?>,document.getElementById('quantityInput<?php echo $counter ?>').value)">
                                Order Now
                            </button>
                        </div>
                    </div>
                    <div class="row collapse" id="<?php echo 'collapseOrder' . $counter ?>">


                    </div>
                </div>
            </div>
            <?php
        } ?>
        <?php echo '</div>' ?>
    <?php } ?>
    <script src="Scripts/Restaurant.js" type="text/javascript"></script>
    <script>

    </script>

</div>


