<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

$sql = 'select * from room';
$result = $pdo->query($sql);

?>


<div class="container">

    <!--    search bar-->
    <div class="row" style="position: relative">
        <div class="form-floating mb-3 col-5">
            <input type="search" class="form-control" id="searchRoomBar" placeholder="Search">
            <label for="searchRoomBar">Search</label>
        </div>
        <div class="col-2" style="position: relative">
            <button class="btn btn-primary" onclick="roomSearch()"
                    style="width: 100%;height: 40px; position:absolute; top: 50%;left: 50%;transform: translate(-50%,-50%)">
                Search
            </button>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchRoomFilter">
                    <option selected>Search Method</option>
                    <option value="roomNumber">Room Number</option>
                    <option value="roomType">Room Type</option>
                    <option value="badCapacity">Bad Capacity</option>
                    <option value="telNumber">Tel. Number</option>
                    <option value="price">Price</option>
                    <option value="description">Description</option>
                </select>
                <label for="searchRoomFilter">Method Filter</label>
            </div>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchRoomOrdering">
                    <option selected>Order By</option>
                    <option value="roomNumber">Room Number</option>
                    <option value="badCapacity">Bad Capacity</option>
                    <option value="price">Price</option>
                </select>
                <label for="searchRoomOrdering">Order By</label>
            </div>
        </div>

        <div class="form-check col-1" style="position:relative;">
            <div style="position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%)">
                <input class="form-check-input" type="checkbox" value="" id="takenRoomCB">
                <label class="form-check-label" for="takenRoomCB">
                    Taken
                </label>
            </div>

        </div>

    </div>

    <div id="searchRoomResult">

        <table class="table table-hover">

            <thead>
            <tr>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Bad Capacity</th>
                <th>Tel. Number</th>
                <th>Rent Per Night</th>
                <th>Room Description</th>
                <th>Status</th>
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
                    <td>
                        <button onclick="EditRoom(this.value)" value="<?php echo $row['room_id'] ?>">Edit</button>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

</div>


