<?php
require_once 'pdo.php';
session_start();
// VALIDATION

$sql = 'select * from booking,person,room where person.person_id=booking.person_id and room.room_id=booking.room_id';
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

?>
<div class="container">
    <section>
        <h1 class="main-h1">Bookings</h1>
        <hr class="line">
        <p class="main-content">The table below contains all information about Rooms Booking with ability to modify them ..</p>
    </section>

    <div class="row forms mt-5">
        <table id="bookings" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Room Number</th>
                <th>Room Type</th>
                <th class="edit_r">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
                    <td><?php echo $row['person_email'] ?></td>
                    <td><?php echo $row['mobile'] ?></td>
                    <td><?php echo $row['city'] ?></td>
                    <td><?php echo $row['start_date'] ?></td>
                    <td><?php echo $row['end_date'] ?></td>
                    <td><?php echo $row['room_number'] ?></td>
                    <td><?php echo $row['room_type'] ?></td>
                    <td class="edit_r"><button onclick="EditBook(this.value)" value="<?php echo $row['book_id'] ?>">Edit</button></td>
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


