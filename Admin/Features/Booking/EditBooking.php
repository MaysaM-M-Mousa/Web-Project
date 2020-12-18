<?php
require_once 'pdo.php';
session_start();
// VALIDATION

$roomSQL = '
select room_id,room_number from room where room.room_type=:room_type and room.room_id not in 
(select room.room_id from room,booking where booking.room_id=room.room_id 
and
(
    	((:start_date BETWEEN booking.start_date and booking.end_date) and (:end_date not BETWEEN booking.start_date and
      		booking.end_date)) 	
		or 
        ((:start_date not BETWEEN booking.start_date and booking.end_date) and (:end_date BETWEEN booking.start_date and
      		booking.end_date)) 
        or 
        ((:start_date BETWEEN booking.start_date and booking.end_date) and (:end_date BETWEEN booking.start_date and
      		booking.end_date)) 
)
order by booking.end_date
)order by room_id asc';

$interSQL = '
    select * from booking where booking.person_id=:person_id
    and 
    (
    	((:start_date > booking.start_date and :start_date < booking.end_date) and (not(:end_date > booking.start_date and 
          :end_date < booking.end_date))) 	
		or
        ((not(:start_date > booking.start_date and :start_date < booking.end_date)) and (:end_date > booking.start_date and 
         :end_date < booking.end_date)) 
        or
        ((:start_date > booking.start_date and :start_date < booking.end_date) and (:end_date > booking.start_date and :end_date < booking.end_date)) 
        or 
        ((:start_date <= booking.start_date) and (:end_date >= booking.end_date)) 
    )
    order by booking.end_date';

// EDIT with all params given
if (isset($_POST['editBook'], $_POST['book_id'], $_POST['start_date'], $_POST['end_date'], $_POST['room_id'], $_POST['person_id'])) {

    $editBook_edit = htmlentities(trim($_POST['editBook']));
    $book_id_edit = htmlentities(trim($_POST['book_id']));
    $start_date_edit = htmlentities(trim($_POST['start_date']));
    $end_date_edit = htmlentities(trim($_POST['end_date']));
    $room_id_edit = htmlentities(trim($_POST['room_id']));
    $person_id_edit = htmlentities(trim($_POST['person_id']));

    if ($editBook_edit != 'editBook')
        die('Invalid Access!');

    if ($start_date_edit < date('Y-m-d'))
        die('Invalid Access!');

    if (!is_numeric($room_id_edit)) {
        echo '<span style="color: red">Please select a room!</span>';
        return;
    }

    // check if there interconnected dates for the same person, if so, the booking will not be done
    $stmt = $pdo->prepare($interSQL);
    $stmt->execute(array(
        ':person_id' => $person_id_edit,
        ':start_date' => $start_date_edit,
        ':end_date' => $end_date_edit
    ));

    if ($stmt->rowCount() > 1) {
        echo '<span style="color: red">This customer has another book in same entered date!</span>';
        return;
    }

    $sqlEdit = 'update booking set start_date=:start_date,end_date=:end_date,room_id=:room_id where book_id=:book_id';
    $stmt = $pdo->prepare($sqlEdit);
    $stmt->execute(array(
        ':start_date' => $start_date_edit,
        ':end_date' => $end_date_edit,
        ':room_id' => $room_id_edit,
        ':book_id' => $book_id_edit
    ));

    echo '<span style="color: green">Successfully Upgraded!</span>';
    return;
}


// in case the admin wants to change the booking information
if (isset($_POST['checkForRoomType'], $_POST['start_date'], $_POST['end_date'], $_POST['person_id'], $_POST['room_type'])) {

    $start_date = htmlentities(trim($_POST['start_date']));
    $end_date = htmlentities(trim($_POST['end_date']));
    $person_id = htmlentities(trim($_POST['person_id']));
    $room_type = htmlentities(trim($_POST['room_type']));

    // make sure that a type of room is selected
    if ($_POST['room_type'] == 'Room Type') {
        echo '<option>No Type is selected</option>';
        return;
    }

    // make sure that start date is less more than curr date
    if ($start_date < date('Y-m-d')) {
        echo 'not allowed!';
        return;
    }


    // check if there interconnected dates for the same person, if so, the booking will not be done
    $stmt = $pdo->prepare($interSQL);
    $stmt->execute(array(
        ':person_id' => $person_id,
        ':start_date' => $start_date,
        ':end_date' => $end_date
    ));

    if ($stmt->rowCount() > 1) {
        echo '<span style="color: red">This customer has another book in same entered date!</span>';
        return;
    }

    // the user does not have any تداخل في تواريخ الحجز then let him take a room
    // roomSQL query
    $stmt = $pdo->prepare($roomSQL);
    $stmt->execute(array(
        ':start_date' => $start_date,
        ':end_date' => $end_date,
        ':room_type' => $room_type
    ));

    //  if there is no room that matches the customer's requirements
    if ($stmt->rowCount() < 1) {
        echo '<span style="color: red">No room available for this type of rooms</span>';
        return;
    }

    echo '<option value="">Available Rooms</option>';

    // to save the curr room number and id
    if ($room_type == $_SESSION['roomTypeSession']) {

        $tempRoomNum = $_SESSION['roomNumberSession'];
        $tempRoomID = $_SESSION['roomIDSession'];
        echo "<option  value='$tempRoomID'>$tempRoomNum</option>";
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $room_id = $row['room_id'];
        $room_number = $row['room_number'];
        echo "<option  value='$room_id'>$room_number</option>";
    }
    return;

}

if (isset($_POST['book_id'])) {

    $book_id = htmlentities(trim($_POST['book_id']));

    $sql = 'select * from booking,person,room where person.person_id=booking.person_id and room.room_id=booking.room_id
            and booking.book_id=:book_id';
    $result = $pdo->prepare($sql);
    $result->execute(array(
        ':book_id' => $book_id
    ));

    $mainRow = $result->fetch(PDO::FETCH_ASSOC);

    // store roomType and roomNum is session because when roomType selection menu is clicked the curr room will be execluded
    // so i need to get it back

    $_SESSION['roomTypeSession'] = $mainRow['room_type'];
    $_SESSION['roomIDSession'] = $mainRow['room_id'];
    $_SESSION['roomNumberSession'] = $mainRow['room_number'];

    $passed = false;
    if ($mainRow['start_date'] > date('Y-m-d'))
        $passed = true;

}


?>
<!-- room type, -->
<div class="container">

    <div class="form-group row">
        <label class="col-sm-2 control-label" for="cusName">Customer Name:</label>
        <input type="text" class="col-8 form-control" id="cusName" disabled
               value="<?php echo $mainRow['first_name'] . ' ' . $mainRow['last_name'] ?>">
    </div>

    <div class="form-group row">
        <label class="col-sm-2 control-label" for="cusEmail">Customer Email:</label>
        <input type="text" class="col-8  form-control" id="cusEmail" disabled
               value="<?php echo $mainRow['person_email'] ?>">
    </div>

    <div class="form-group row">
        <label class="col-2 control-label" for="mobile">Mobile:</label>
        <input type="text" class="col-8 form-control" id="mobile" disabled
               value="<?php echo $mainRow['mobile'] ?>">
    </div>

    <div class="form-group row">
        <label for="startDateEdit" class="col-2 col-form-label">Start Date:</label>
        <input class="form-control col-8" type="date" value="<?php echo $mainRow['start_date'] ?>" id="startDateEdit"
            <?php echo $passed ? '' : 'disabled' ?>>
    </div>

    <div class="form-group row">
        <label for="endDateEdit" class="col-2 col-form-label">End Date:</label>
        <input class="form-control col-8" type="date" value="<?php echo $mainRow['end_date'] ?>" id="endDateEdit"
            <?php echo $passed ? '' : 'disabled' ?>>
    </div>

    <div class="form-group row">
        <label class="col-2" for="roomType">Room Type: </label>
        <select onchange="EditBooking(this.value,<?php echo $mainRow['person_id'] ?>)" class="custom-select col-8"
                required
                name="roomType"
                id="roomType" <?php echo $passed ? '' : 'disabled' ?>>
            <option value="Room Type">Room Type</option>
            <?php
            $roomTypeArr = array('Single', 'Double', 'Quad', 'King');
            for ($i = 0; $i < sizeof($roomTypeArr); $i++)
                if ($roomTypeArr[$i] === $mainRow['room_type'])
                    echo "<option selected value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
                else
                    echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
            ?>
        </select>
    </div>

    <div class="form-group row">
        <label class="col-2" for="roomNumber">Room Number: </label>
        <select class="custom-select col-8" required id="roomNumberFB" name="roomNumberFB"
            <?php echo $passed ? '' : 'disabled' ?>>
            <?php
            $stmt = $pdo->prepare($roomSQL);
            $stmt->execute(array(
                ':start_date' => $mainRow['start_date'],
                ':end_date' => $mainRow['end_date'],
                ':room_type' => $mainRow['room_type']
            ));

            //store roomNum and roomID
            $currRoomID = $mainRow['room_id'];
            $currRoomNumber = $mainRow['room_number'];

            echo '<option value="">Available Rooms</option>';
            echo "<option selected value='$currRoomID'>$currRoomNumber</option>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $room_id = $row['room_id'];
                $room_number = $row['room_number'];
                echo "<option value='$room_id'>$room_number</option>";
            }
            ?>
        </select>
    </div>

    <div class="row">

        <button class="btn btn-danger"
                onclick="deleteBook(<?php echo $mainRow['book_id'] . ',' . "'" . $mainRow['start_date'] . "'" ?>)"
            <?php echo $passed ? '' : 'disabled' ?>>Delete This Book
        </button>
        <button class="btn btn-primary"
                onclick="submitChangingBooking(<?php echo $mainRow['book_id'] . ',' . $mainRow['person_id'] ?>)"
            <?php echo $passed ? '' : 'disabled' ?>>Update Changes
        </button>

    </div>

    <div class="row" id="editBookingResult">

    </div>
</div>

<!-- if the booking starts in the curr day then you cant edit anything-->
<!-- convert the room number to select menu-->
<!-- when he clicks on the room type then all available rooms will be displayed in the room number select menu-->



