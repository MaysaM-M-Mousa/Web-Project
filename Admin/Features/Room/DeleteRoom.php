<?php
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
require_once 'pdo.php';
if (isset($_POST['room_id'], $_POST['deleteRoom'])) {

    try{
        $room_id = htmlentities($_POST['room_id']);
        $sql = 'delete from room where room_id=' . $room_id;
        $result = $pdo->exec($sql);

        require_once '../Room/AllRooms.php';
        return;
    }catch (Exception $e){
        echo "<span style=\"font-family: 'Cabin', serif;transform: translate(-50%,-50%);position: absolute; top: 50%; left: 50%;;
            color:darkred; font-size:20px;\">
            You cant not delete a room that is under usage!</span>";

        return;
    }

}

?>