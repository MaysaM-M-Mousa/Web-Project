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
        echo '<i class="fad fa-exclamation-circle" style="color: darkred;font-style:normal; font-family: \'Font Awesome 5 Pro\';" ></i>';
        echo '<span style="color: darkred"> Room Number, Price, Telephone, and Capacity must be pure numbers</span>';
        return;
    }

    if (strlen($roomNumber) < 1 || strlen($rentPerNight) < 1 || strlen($telNum) < 1 || strlen($badCapacity) < 1) {
        echo '<i class="fad fa-exclamation-circle" style="color: darkred;font-style:normal; font-family: \'Font Awesome 5 Pro\';" ></i>';
        echo '<span style="color: darkred"> Room Number, Tel, Price, and Capacity are required!</span>';
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

    echo '<span style="color:darkgreen; font-family: \"Cabin\", serif;">Room was successfully added</span>';
    return;
//TODO: special case:: when the room is registered, reject.
}

?>

<div class="container forms">
    <div class="form-border-2  my-5">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Add A Room</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the room you want to
                    register..</p>
            </section>


            <div class="row mx-3 mt-3">
                <label class="col-12 col-md-3" for="#roomNumber">Room Number: </label>
                <input class="col-12 col-md-9 form-control" type="text" name="roomNumber" id="roomNumber"
                       placeholder="Room Number"
                       required>
            </div>
            <dix class="row mx-3">
                <label class="col-12 col-md-3" for="#roomType">Room Type: </label>
                <select class="custom-select col-12 col-md-9" required name="roomType" id="roomType">
                    <option value="">Room Type</option>
                    <?php
                    $roomTypeArr = array('Single', 'Double', 'Triple', 'Quad', 'King', 'Suit', 'Apartment');
                    for ($i = 0; $i < sizeof($roomTypeArr); $i++)
                        echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
                    ?>
                </select>
            </dix>
            <div class="row mx-3">
                <label class="col-12 col-md-3" for="#rentPerNight">Rent: </label>
                <input class="col-12 col-md-9 form-control" name="rentPerNight" id="rentPerNight"
                       placeholder="Rent Per Night $"
                       required>
            </div>
            <div class="row mx-3">
                <label class="col-12 col-md-3" for="#badCapacity">Bed Capacity: </label>
                <select class="custom-selectcol-12 col-md-9" required name="badCapacity" id="badCapacity">
                    <option value="">Select</option>
                    <?php
                    for ($i = 1; $i <= 8; $i++)
                        echo "<option value='$i'>$i</option>";
                    ?>
                </select>
            </div>
            <div class="row mx-3">
                <label class="col-12 col-md-3" for="#telNum">TEl: </label>
                <input class="col-12 col-md-9 form-control" type="tel" id="telNum" name="telNum" placeholder="XXXXX"
                       required>
            </div>
            <div class="row mx-3">
                <label class="col-12 col-md-3" for="#telNum">Room Description: </label>
                <textarea class="col-12 col-md-9" placeholder="Room Description" id="roomDescription" rows="4"
                          cols="20"></textarea>
            </div>
            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-3">Photo:</label>
                <div class="col-12 col-md-9 px-0 pb-4">
                    <!-- Uploader Dropzone -->
                    <form action="Features/Room/upload.php" id="zdrop" class="fileuploader text-center" target="upload_target">
                        <div id="upload-label">
                            <i class="fad fa-cloud-upload material-icons"></i>
                            <span class="tittle d-none d-sm-block">Click the Button or Drop Files Here</span>
                        </div>
                    </form>
                    <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>

                    <div class="preview-container">
                        <div class="collection card" id="previews">
                            <div class="collection-item clearhack valign-wrapper item-template"
                                 id="zdrop-template">
                                <div class="left pv zdrop-info" data-dz-thumbnail>
                                    <div>
                                        <span data-dz-name></span> <span data-dz-size></span>
                                    </div>
                                    <div class="progress">
                                        <div class="determinate" style="width:0" data-dz-uploadprogress></div>
                                    </div>
                                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                </div>

                                <div class="secondary-content actions">
                                    <a href="#!" data-dz-remove
                                       class="btn-floating ph red white-text waves-effect waves-light"><i
                                                class="material-icons white-text">clear</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <input id="addRoomBtn" type="button" class="btn btn-primary" value="Add Room">
                <div class="col-12" id="MSG"></div>
            </div>
        </div>
    </div>
    <script src="Scripts/dropzone.min.js"></script>
    <script src="Scripts/Rooms.js"></script>
</div>

