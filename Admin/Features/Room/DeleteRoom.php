<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';
sleep(1);
if (isset($_POST['room_id'], $_POST['deleteRoom'])) {

    $room_id = htmlentities($_POST['room_id']);
    $sql = 'delete from room where room_id=' . $room_id;
    $result = $pdo->exec($sql);

    require_once '../Room/AllRooms.php';
    return;
}

?>