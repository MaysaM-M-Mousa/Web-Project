<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['roomNumberEdit'], $_POST['rentPerNightEdit'], $_POST['telNumEdit'], $_POST['badCapacityEdit'],
    $_POST['roomTypeEdit'], $_POST['roomDescriptionEdit'], $_POST['room_id_Edit'])) {

    $roomNumberEdit = htmlentities($_POST['roomNumberEdit']);
    $rentPerNightEdit = htmlentities($_POST['rentPerNightEdit']);
    $telNumEdit = htmlentities($_POST['telNumEdit']);
    $badCapacityEdit = htmlentities($_POST['badCapacityEdit']);
    $roomTypeEdit = htmlentities($_POST['roomTypeEdit']);
    $roomDescriptionEdit = empty($_POST['roomDescriptionEdit']) ? NULL : htmlentities($_POST['roomDescriptionEdit']);

    $sqlEdit = 'update room set room_number=:room_number_edit,room_description=:room_description_edit,
                    room_type=:room_type_edit,bad_capacity=:bad_capacity_edit,tel_number=:tel_number_edit,
                    rent_per_night=:rent_per_night_edit
    where room_id=' . htmlentities($_POST['room_id_Edit']);

    $resultEdit = $pdo->prepare($sqlEdit);

    $resultEdit->execute(array(
        ":room_number_edit" => $roomNumberEdit,
        ":room_description_edit" => $roomDescriptionEdit,
        ":room_type_edit" => $roomTypeEdit,
        ":bad_capacity_edit" => $badCapacityEdit,
        ":tel_number_edit" => $telNumEdit,
        ":rent_per_night_edit" => $rentPerNightEdit
    ));

    echo '<span style="color: blue">Room successfully updated!</span>';
    return;
}


if (isset($_POST['room_id'])) {
    $sql = 'select * from room where room_id=' . htmlentities($_POST['room_id']);
    $result = $pdo->query($sql);

    if ($result->rowCount() < 1)
        return;

    $row = $result->fetch(PDO::FETCH_ASSOC);

    $room_id = $row['room_id'];
    $room_number = $row['room_number'];
    $room_description = $row['room_description'];
    $room_type = $row['room_type'];
    $bad_capacity = $row['bad_capacity'];
    $tel_number = $row['tel_number'];
    $rent_per_night = $row['rent_per_night'];

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
        <input class="col-6 form-control" type="text" name="roomNumberEdit" id="roomNumberEdit"
               placeholder="Room Number"
               required value="<?php echo $room_number ?>">

        <select class="custom-select col-6" required name="roomTypeEdit" id="roomTypeEdit">
            <option value="">Room Type</option>
            <?php
            $roomTypeArr = array('Single', 'Double', 'Triple', 'Quad', 'King', 'Suit', 'Apartment');
            for ($i = 0; $i < sizeof($roomTypeArr); $i++) {
                if ($room_type == $roomTypeArr[$i])
                    echo "<option value='$roomTypeArr[$i]' selected>$roomTypeArr[$i]</option>";
                else
                    echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
            }
            ?>
        </select>
    </div>

    <div class="row">

        <input class="col-6 form-control" name="rentPerNightEdit" id="rentPerNightEdit" placeholder="Rent Per Night $"
               required value="<?php echo $rent_per_night ?>">

        <select class="custom-select col-6" required name="badCapacityEdit" id="badCapacityEdit">
            <option value="">Bad Capacity</option>
            <?php
            for ($i = 1; $i <= 8; $i++)
                if ($bad_capacity == $i)
                    echo "<option value='$i' selected>$i</option>";
                else
                    echo "<option value='$i'>$i</option>";
            ?>
        </select>

    </div>

    <div class="row">
        <input class="col-6 form-control" type="tel" id="telNumEdit" name="telNumEdit" placeholder="234****" required
               value="<?php echo $tel_number ?>">
        <textarea class="col-6" placeholder="Room Description" id="roomDescriptionEdit" rows="4" cols="20"
        ><?php echo $room_description ?></textarea>
    </div>

    <div class="row">
        <div class="col-6">
            <input style="width: 100%" onclick="deleteRoom(<?php echo $room_id ?>)" type="button" class="btn btn-danger"
                   value="Delete This Room">
        </div>
        <div class="col-6">
            <input style="width: 100%" onclick="submitChangingRoom(<?php echo $room_id ?>)" type="button"
                   class="btn btn-primary" value="Save Changes">
        </div>

    </div>
    <!--    </form>-->

    <div id="MSG"></div>
</div>

