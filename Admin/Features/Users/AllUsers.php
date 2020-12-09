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

    <!--    search bar-->
    <div class="row" style="position: relative">
        <div class="form-floating mb-3 col-5">
            <input type="search" class="form-control" id="searchUserBar" placeholder="Search">
            <label for="searchUserBar">Search</label>
        </div>
        <div class="col-2" style="position: relative">
            <button class="btn btn-primary" onclick="userSearch()"
                    style="width: 100%;height: 40px; position:absolute; top: 50%;left: 50%;transform: translate(-50%,-50%)">
                Search
            </button>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchUserFilter">
                    <option selected>Search Method</option>
                    <option value="roomNumber">Room Number</option>
                    <option value="roomType">Room Type</option>
                    <option value="badCapacity">Bad Capacity</option>
                    <option value="telNumber">Tel. Number</option>
                    <option value="price">Price</option>
                    <option value="description">Description</option>
                </select>
                <label for="searchUserFilter">Method Filter</label>
            </div>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchUserOrdering">
                    <option selected>Order By</option>
                    <option value="roomNumber">Room Number</option>
                    <option value="badCapacity">Bad Capacity</option>
                    <option value="price">Price</option>
                </select>
                <label for="searchUserOrdering">Order By</label>
            </div>
        </div>

<!--        commented for now-->

<!--        <div class="form-check col-1" style="position:relative;">-->
<!--            <div style="position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%)">-->
<!--                <input class="form-check-input" type="checkbox" value="" id="takenRoomCB">-->
<!--                <label class="form-check-label" for="takenRoomCB">-->
<!--                    Taken-->
<!--                </label>-->
<!--            </div>-->
<!--        </div>-->
    </div>

    <div id="searchUserResult">

        <table class="table table-hover">

            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>City</th>

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





