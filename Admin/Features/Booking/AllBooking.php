<?php
require_once 'pdo.php';
session_start();
// VALIDATION

$sql = 'select * from booking,person,room where person.person_id=booking.person_id and room.room_id=booking.room_id';
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">

    <!--    search bar-->
    <!--    <div class="row" style="position: relative">-->
    <!--        <div class="form-floating mb-3 col-5">-->
    <!--            <input type="search" class="form-control" id="searchUserBar" placeholder="Search">-->
    <!--            <label for="searchUserBar">Search</label>-->
    <!--        </div>-->
    <!--        <div class="col-2" style="position: relative">-->
    <!--            <button class="btn btn-primary" onclick="userSearch()"-->
    <!--                    style="width: 100%;height: 40px; position:absolute; top: 50%;left: 50%;transform: translate(-50%,-50%)">-->
    <!--                Search-->
    <!--            </button>-->
    <!--        </div>-->
    <!---->
    <!--        <div class="col-2">-->
    <!--            <div class="form-floating">-->
    <!--                <select class="form-select" id="searchUserFilter">-->
    <!--                    <option selected>Search Method</option>-->
    <!--                    <option value="roomNumber">Room Number</option>-->
    <!--                    <option value="roomType">Room Type</option>-->
    <!--                    <option value="badCapacity">Bad Capacity</option>-->
    <!--                    <option value="telNumber">Tel. Number</option>-->
    <!--                    <option value="price">Price</option>-->
    <!--                    <option value="description">Description</option>-->
    <!--                </select>-->
    <!--                <label for="searchUserFilter">Method Filter</label>-->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--        <div class="col-2">-->
    <!--            <div class="form-floating">-->
    <!--                <select class="form-select" id="searchUserOrdering">-->
    <!--                    <option selected>Order By</option>-->
    <!--                    <option value="roomNumber">Room Number</option>-->
    <!--                    <option value="badCapacity">Bad Capacity</option>-->
    <!--                    <option value="price">Price</option>-->
    <!--                </select>-->
    <!--                <label for="searchUserOrdering">Order By</label>-->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--    </div>-->

    <!--    <div id="searchUserResult">-->

    <table class="table table-hover">

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
            <th>Action</th>

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
                <td><button onclick="EditBook(this.value)" value="<?php echo $row['book_id'] ?>">Edit</button></td>
            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!--</div>-->
