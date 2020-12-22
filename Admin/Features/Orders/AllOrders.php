<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
$sql = 'select * from orders,item,person,booking where person.person_id=booking.person_id and booking.book_id=orders.book_id and item.item_id=orders.item_id';
$result = $pdo->query($sql);
?>


<div class="container animate__animated animate__fadeIn">
    <section>
        <h1 class="main-h1">Orders</h1>
        <hr class="line">
        <p class="main-content">The table below contains all information about hotel's orders of all the time..</p>
    </section>

    <div class="row forms mt-5">
        <table id="orders" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
            <tr>
                <th>Customer Name</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Order Date</th>


            </tr>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
                    <td><?php echo $row['item_name'] ?></td>
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php echo $row['order_time'] ?></td>
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
<script>
   $(document).ready(function (){
       if ($("#orders").length > 0) {
       }
        var table = $('#orders').DataTable({
            "scrollX": true,
            responsive: true
        });
    }
   );
</script>








