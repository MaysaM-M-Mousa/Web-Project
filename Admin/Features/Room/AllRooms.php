<?php
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
require_once 'pdo.php';

$sql = 'select * from room';
$result = $pdo->query($sql);

?>


<div class="container animate__animated animate__fadeIn">
    <section>
        <h1 class="main-h1">Rooms</h1>
        <hr class="line">
        <p class="main-content">The table below contains all information about hotel's rooms with ability to modify them..</p>
    </section>

    <div class="row forms mt-5">
        <table id="rooms" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Bad Capacity</th>
                <th>Tel. Number</th>
                <th>Rent Per Night</th>
                <th>Room Description</th>
                <th>Status</th>
                <th class="edit_r">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row['room_number'] ?></td>
                    <td><?php echo $row['room_type'] ?></td>
                    <td><?php echo $row['bad_capacity'] ?></td>
                    <td><?php echo $row['tel_number'] ?></td>
                    <td><?php echo $row['rent_per_night'] ?></td>
                    <td><?php echo $row['room_description'] ?></td>
                    <td><?php echo $row['status'] == 0 ? 'Available' : 'Taken' ?></td>
                    <td class="edit_r">
                        <button onclick="EditRoom(this.value)" value="<?php echo $row['room_id'] ?>" class="edit-table fas fa-edit"></button>
                    </td>
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

        if ($("#rooms").length) {
            var table = $('#rooms').DataTable({
                "scrollX": true,
                responsive: true

            });
        }
    });
</script>




