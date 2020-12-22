<?php
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
require_once 'pdo.php';

if (isset($_POST['roomNumberEdit'], $_POST['rentPerNightEdit'], $_POST['telNumEdit'], $_POST['badCapacityEdit'],
    $_POST['roomTypeEdit'], $_POST['roomDescriptionEdit'], $_POST['room_id_Edit'])) {

    $roomNumberEdit = htmlentities($_POST['roomNumberEdit']);
    $rentPerNightEdit = htmlentities($_POST['rentPerNightEdit']);
    $telNumEdit = htmlentities($_POST['telNumEdit']);
    $badCapacityEdit = htmlentities($_POST['badCapacityEdit']);
    $roomTypeEdit = htmlentities($_POST['roomTypeEdit']);
    $roomDescriptionEdit = empty($_POST['roomDescriptionEdit']) ? NULL : htmlentities($_POST['roomDescriptionEdit']);

    try {
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
    }catch (Exception $e){
        echo '<span style="color: darkred"> There is already a room with that room number!</span>';
        return;
    }


    echo '<span style="color: green">Room successfully updated!</span>';
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

<div class="container forms animate__animated animate__fadeIn">
        <div onclick="allRooms()" class="back-btn">
            <i class="fal fa-arrow-left"></i>
        </div>
    <div class="form-border-2">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Edit Room No.<?php echo $room_number ?></h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the room you want to
                    edit..</p>
            </section>
            <div class="row mx-3">
                <label for="#roomNumberEdit" class="col-12 col-md-3">Room Number:</label>
                <input class="col-12 col-md-9 form-control" type="text" name="roomNumberEdit" id="roomNumberEdit"
                       placeholder="Room Number"
                       required value="<?php echo $room_number ?>">
            </div>
            <div class="row mx-3">
                <label for="#roomTypeEdit" class="col-12 col-md-3">Room Type:</label>
                <select class="custom-select col-12 col-md-9" required name="roomTypeEdit" id="roomTypeEdit">
                    <option value="">Room Type</option>
                    <?php
                    $roomTypeArr = array('Single', 'Double', 'Quad', 'King');
                    for ($i = 0; $i < sizeof($roomTypeArr); $i++) {
                        if ($room_type == $roomTypeArr[$i])
                            echo "<option value='$roomTypeArr[$i]' selected>$roomTypeArr[$i]</option>";
                        else
                            echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row mx-3">
                <label for="#rentPerNightEdit" class="col-12 col-md-3">Rent Per Night:</label>

                <input class="col-12 col-md-9 form-control" name="rentPerNightEdit" id="rentPerNightEdit"
                       placeholder="Rent Per Night $"
                       required value="<?php echo $rent_per_night ?>">

            </div>
            <div class="row mx-3">
                <label for="#badCapacityEdit" class="col-12 col-md-3">Bed Capacity:</label>

                <select class="custom-select col-12 col-md-9" required name="badCapacityEdit" id="badCapacityEdit">
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
            <div class="row mx-3">
                <label for="#telNumEdit" class="col-12 col-md-3">Tel:</label>

                <input class="col-12 col-md-9 form-control" type="tel" id="telNumEdit" name="telNumEdit"
                       placeholder="234****" required
                       value="<?php echo $tel_number ?>">

            </div>
            <div class="row mx-3 mb-2">
                <label for="#roomDescriptionEdit" class="col-12 col-md-3">Description:</label>
                <textarea class="col-12 col-md-9" placeholder="Room Description" id="roomDescriptionEdit" rows="4"
                          cols="20"
                ><?php echo $room_description ?></textarea>
            </div>
            <div class="row mx-3">
                <div class="col-12 offset-md-3 col-md-3">
                    <input onclick="deleteRoom(<?php echo $room_id ?>)" type="button"
                           class="btn btn-danger"
                           value="Delete This Room">
                </div>
                <div class="col-12 offset-md-1 col-md-4">
                    <input  style="width: 100%" onclick="submitChangingRoom(<?php echo $room_id ?>)" type="button"
                           class="btn btn-primary" value="Save Changes">
                </div>
                <div class="col-12 error" id="MSG"></div>
            </div>
        </div>
    </div>
    <script src="Scripts/Rooms.js"></script>
</div>

