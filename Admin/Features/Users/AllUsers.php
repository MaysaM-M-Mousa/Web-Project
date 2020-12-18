<?php

//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

$sql = 'select * from person where person_role=0 and active=1';
$result = $pdo->query($sql);
?>


<div class="container">
    <section>
        <h1 class="main-h1">Customers</h1>
        <hr class="line">
        <p class="main-content">The table below contains all information about hotel's customers..</p>
    </section>

    <div class="row forms mt-5">
        <table id="customers" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>

            </tr>
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









