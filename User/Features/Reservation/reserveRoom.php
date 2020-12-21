<?php
require_once 'pdo.php';
session_start();

if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    echo 'You are not allowed to continue';
    return;
}

if (isset($_POST['reserveRoom'], $_POST['dateRange'], $_POST['roomType'])) {

    $dataRange = htmlentities($_POST['dateRange']);
    $roomType = htmlentities($_POST['roomType']);

    switch ($roomType) {
        case 1 :
            $roomCapacity = 'Single';
            break;
        case 2 :
            $roomCapacity = 'Double';
            break;
        case 4 :
            $roomCapacity = 'Quad';
            break;
        case 6 :
            $roomCapacity = 'King';
            break;
    }

    if (empty($dataRange)) {
        echo 'Date must be filled!';
        return;
    }

    // splitting the dates
    $dateArr = explode('-', $dataRange);
    // converting to YYYY-MM-DD format
    $startDate = date("Y-m-d", strtotime($dateArr[0]));
    $endDate = date("Y-m-d", strtotime($dateArr[1]));


    // check if there interconnected dates, if so, the booking will not be done
    $sql = '
   select * from booking where booking.person_id=14
    and 
    (
    	((:person_id > booking.start_date and :person_id < booking.end_date) and (not(:end_date > booking.start_date and 
          :end_date < booking.end_date))) 	
		or
        ((not(:person_id > booking.start_date and :person_id < booking.end_date)) and (:end_date > booking.start_date and 
          :end_date < booking.end_date)) 
        or
        ((:person_id > booking.start_date and :person_id < booking.end_date) and (:end_date > booking.start_date and :end_date 			< booking.end_date)) 
        or
        ((:person_id <= booking.start_date) and (:end_date >= booking.end_date))
        
    )
    order by booking.end_date';


    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $_SESSION['person_id'],
        ':start_date' => $startDate,
        ':end_date' => $endDate
    ));
    if ($stmt->rowCount() > 0) {
        echo "<span style=\"font-family: \'Cabin\', serif; color:darkred; font-size:20px;\">You have a crossed dates, please choose another date!</span>";
        return;
    }


    // the user does not have any تداخل في تواريخ الحجز then let him take a room
    $sql = '
select room_id,room_number from room where room.room_type=:room_capacity and room.room_id not in 
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
)order by room_id asc limit 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':start_date' => $startDate,
        ':end_date' => $endDate,
        ':room_capacity' => $roomCapacity
    ));

    //  if there is no room that matches the customer's requirements
    if ($stmt->rowCount() < 1) {
        echo 'Unfortunately, no room is available for now with what you required, you can choose another type of room if you want!';
        return;
    }

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //***************** inserting a booking id for the customer
    $sql = 'insert into booking (start_date,end_date,person_id,room_id) 
            values(:start_date,:end_date,:person_id,:room_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':start_date' => $startDate,
        ':end_date' => $endDate,
        ':person_id' => $_SESSION['person_id'],
        ':room_id' => $result['room_id']
    ));

    // getting the next value for auto_increment val -1 to store it in a session
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "testdatabase" AND TABLE_NAME = "booking"';
    $stmt = $pdo->query($sql);
    $auto_inc_result = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['book_id'] = $auto_inc_result['AUTO_INCREMENT'] - 1;

    echo 'room No. is ' . $result['room_number'];
    return;

}
?>

