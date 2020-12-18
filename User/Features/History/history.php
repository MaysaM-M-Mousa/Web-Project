<?php
require_once 'pdo.php';
session_start();

// validation

if (!isset($_SESSION['book_id'])) {
    echo '<span style="color: green">There is nothing to display!</span>';
    return;
}

$sql = 'select * from orders,item where orders.item_id=item.item_id and orders.book_id=:book_id order by orders.order_time DESC';
$result = $pdo->prepare($sql);

$result->execute(array(':book_id' => $_SESSION['book_id']));


// select sum(item_price) from orders,item where orders.item_id=item.item_id and orders.book_id=143 order by orders.order_time DESC
?>

<div class="container">
    <section>
        <h1 class="main-h1">Ordering History</h1>
        <hr class="line">
        <p class="main-content">The table below contains all information about your orders at the hotel ..</p>
    </section>

    <div class="row forms mt-5">
        <table id="orders" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Time</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $arr = explode(" ", $row['order_time']);
                ?>
                <tr>
                    <td><?php echo $row['image'] ?></td>
                    <td><?php echo $row['item_name'] ?></td>
                    <td><?php echo $row['item_price'] ?></td>
                    <td><?php echo $row['quantity']?></td>
                    <td><?php echo DateTime::createFromFormat('Y-m-d', $arr[0])->format('l jS F Y') . ' ' . $arr[1] ?></td>
                </tr>

                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

<script src="../Vendor/script/bootstrap.min.js"></script>
<script src="Scripts/jquery.dataTables.min.js"></script>
<script src="Scripts/dataTables.bootstrap4.min.js"></script>
<script src="Scripts/Rooms.js"></script>
<script>
    //  All Rooms Table init
    $(document).ready(function () {

        if ($("#orders").length) {
            var table = $('#orders').DataTable({
                "scrollX": true,
                responsive: true

            });
        }
    });
</script>




