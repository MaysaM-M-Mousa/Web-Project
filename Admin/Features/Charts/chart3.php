<?php
require_once 'pdo.php';


if (isset($_POST['firstDate'], $_POST['secondDate'], $_POST['method'])) {

    $firstDate = htmlentities(trim($_POST['firstDate']));
    $secondDate = htmlentities(trim($_POST['secondDate']));
    $method = htmlentities(trim($_POST['method']));
    switch ($method) {
        case "bookings":
            $sql = 'select count(*) as freqs,start_date as date from booking,person where person.person_id=booking.person_id
                    and start_date between :firstDate and :secondDate group by start_date order by start_date asc';
            break;
        case "orders":
            $sql = 'SELECT CAST(orders.order_time AS DATE) as date, COUNT(*) as freqs FROM orders 
		            where  CAST(orders.order_time AS DATE) >= :firstDate and CAST(orders.order_time AS DATE) <= :secondDate	
                    GROUP BY CAST(orders.order_time AS DATE)';
            break;
        case "rooms":
            $sql = 'select count(*) as freqs,room.room_type as date from booking,room where booking.room_id=room.room_id AND booking.start_date 
                    BETWEEN :firstDate and :secondDate group by room.room_type ORDER by room.bad_capacity';
            break;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':firstDate' => $firstDate,
        ':secondDate' => $secondDate
    ));

    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($result);
    return;

}


?>