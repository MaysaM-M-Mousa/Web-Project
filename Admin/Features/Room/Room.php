<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['roomNumber'], $_POST['rentPerNight'], $_POST['telNum'], $_POST['badCapacity'],
    $_POST['roomType'], $_POST['roomDescription'])) {

    $roomNumber = htmlentities($_POST['roomNumber']);
    $rentPerNight = htmlentities($_POST['rentPerNight']);
    $telNum = htmlentities($_POST['telNum']);
    $badCapacity = htmlentities($_POST['badCapacity']);
    $roomType = htmlentities($_POST['roomType']);
    $roomDescription = empty($_POST['roomDescription']) ? NULL : htmlentities($_POST['roomDescription']);

    if (!is_numeric($roomNumber) || !is_numeric($rentPerNight) || !is_numeric($telNum) || !is_numeric($badCapacity)) {
        echo '<span style="color: red">Room Number, Price, Telephone, and Capacity must be pure numbers</span>';
        return;
    }

    if (strlen($roomNumber) < 1 || strlen($rentPerNight) < 1 || strlen($telNum) < 1 || strlen($badCapacity) < 1) {
        echo '<span style="color: red">Room Number, Tel, Price, and Capacity are required!</span>';
        return;
    }

    $sql = 'insert into room (room_number,room_description,room_type, bad_capacity,tel_number,rent_per_night)
                values (:room_number,:room_description,:room_type,:bad_capacity,:tel_number,:rent_per_night)';

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':room_number' => $roomNumber,
        ':room_description' => $roomDescription,
        ':room_type' => $roomType,
        ':bad_capacity' => $badCapacity,
        'tel_number' => $telNum,
        'rent_per_night' => $rentPerNight
    ));

    echo '<span style="color: blue">Room was successfully added</span>';
    return;

}

?>

<div class="container">
    <div class="row">
        <h1>Add A Room</h1>
    </div>

    <div class="row">
        <button onclick="allRooms()" class="btn btn-warning">All Rooms</button>
    </div>

    <div class="row" style="height: 100px"></div>

    <!--    <form id="addRoomForm">-->
    <div class="row">
        <input class="col-6 form-control" type="text" name="roomNumber" id="roomNumber" placeholder="Room Number"
               required>

        <select class="custom-select col-6" required name="roomType" id="roomType">
            <option value="">Room Type</option>
            <?php
            $roomTypeArr = array('Single', 'Double', 'Triple', 'Quad', 'King', 'Suit', 'Apartment');
            for ($i = 0; $i < sizeof($roomTypeArr); $i++)
                echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
            ?>
        </select>
    </div>

    <div class="row">

        <input class="col-6 form-control" name="rentPerNight" id="rentPerNight" placeholder="Rent Per Night $"
               required>

        <select class="custom-select col-6" required name="badCapacity" id="badCapacity">
            <option value="">Bad Capacity</option>
            <?php
            for ($i = 1; $i <= 8; $i++)
                echo "<option value='$i'>$i</option>";
            ?>
        </select>

    </div>

    <div class="row">
        <input class="col-6 form-control" type="tel" id="telNum" name="telNum" placeholder="234****" required>
        <textarea class="col-6" placeholder="Room Description" id="roomDescription" rows="4" cols="20"></textarea>
    </div>

    <div class="row">
        <input onclick="submitAddingRoomForm()" type="button" class="btn btn-primary" value="Add Room">
    </div>
    <!--    </form>-->

    <div id="MSG"></div>
</div>

