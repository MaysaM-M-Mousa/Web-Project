<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}

$sql = 'select * from employee,person where person.person_id=employee.person_id ';
$result = $pdo->query($sql);


?>
<div class="container animate__animated animate__fadeIn">
    <section>
        <h1 class="main-h1">Employees</h1>
        <hr class="line">
        <p class="main-content">The table below contains all information about hotel's Staff with ability to modify them..</p>
    </section>

    <div class="row forms mt-5">
        <table id="employees" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
                <th>Image</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Start Date</th>
                <th>Salary</th>
                <th class="edit_r">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><img style="width: 50px;height: 50px" src="../<?php echo $row['image']?>"></td>
                    <td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
                    <td><?php echo $row['position'] ?></td>
                    <td><?php echo $row['start_date'] ?></td>
                    <td><?php echo $row['salary'] ?></td>
                    <td class="edit_r">
                        <button onclick="EditEmployee(this.value)" value="<?php echo $row['employee_id']?>" class="edit-table fas fa-edit"></button>
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

        if ($("#employees").length) {
            var table = $('#employees').DataTable({
                "scrollX": true,
                responsive: true

            });
        }
    });
</script>


