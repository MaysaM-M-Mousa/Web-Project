<?php
require_once 'pdo.php';
session_start();

// validation
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
if (!isset($_SESSION['book_id'])) {
    echo '<span style="color: darkgreen;font-family: Cabin, serif;font-size: 32px;text-align: center;margin: 50% auto 100px;display: block;">There is nothing to display!</span>';
    return;
}

$sql = 'select * from orders,item where orders.item_id=item.item_id and orders.book_id=:book_id order by orders.order_time DESC';
$result = $pdo->prepare($sql);

$result->execute(array(':book_id' => $_SESSION['book_id']));


// select sum(item_price) from orders,item where orders.item_id=item.item_id and orders.book_id=143 order by orders.order_time DESC
?>
<div class="container-fluid ">
    <ul class="nav nav-tabs pt-5" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
               aria-selected="true">Orders History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
               aria-selected="false">Booking History</a>
        </li>
    </ul>
    <div class="container forms">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <section>
                    <h1 class="main-h1">Ordering History</h1>
                    <hr class="line">
                    <p class="main-content">The table below contains all information about your orders at the hotel
                        ..</p>
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
                                <td><?php echo $row['quantity'] ?></td>
                                <td><?php echo DateTime::createFromFormat('Y-m-d', $arr[0])->format('l jS F Y') . ' ' . $arr[1] ?></td>
                            </tr>

                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php
                if (!isset($_SESSION['book_id'])) {
                    echo '<span style="color: darkgreen;font-family: Cabin, serif;font-size: 32px;text-align: center;margin: 50% auto 100px">There is nothing to display!</span>';
                    return;
                }
                $currDate = date('Y-m-d');

                $sql2 = 'select * from booking,room where booking.room_id=room.room_id and booking.person_id=' . $_SESSION['person_id'] . ' and (booking.start_date>' . $currDate . ' or (booking.end_date>=' . $currDate . ' &&booking.start_date<=' . $currDate . '))';
                $result = $pdo->query($sql2);

                // select sum(item_price) from orders,item where orders.item_id=item.item_id and orders.book_id=143 order by orders.order_time DESC
                ?>
                <section>
                    <h1 class="main-h1">Active Bookings</h1>
                    <hr class="line">
                    <p class="main-content">The table below contains all active current and future bookings at the hotel
                        ..</p>
                </section>
                <div class="row forms mt-5">
                    <table id="bookings" class="table table-striped table-light " style="width:100%">
                        <thead>
                        <tr>
                            <th>Room Number</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['room_number'] ?></td>
                                <td><?php echo $row['start_date'] ?></td>
                                <td><?php echo $row['end_date'] ?></td>
                            </tr>

                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../Vendor/script/bootstrap.min.js"></script>
<script src="Scripts/jquery.dataTables.min.js"></script>
<script src="Scripts/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script>
    //  All Rooms Table init
    $(document).ready(function () {

        if ($("#orders").length) {
            var table = $('#orders').DataTable({
                responsive: true

            });
        }
    });
    $(document).ready(function () {

        if ($("#bookings").length) {
            var table = $('#bookings').DataTable({
                responsive: true

            });
        }
    });
</script>




