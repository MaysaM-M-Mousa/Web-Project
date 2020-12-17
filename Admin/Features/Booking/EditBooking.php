<?php
require_once 'pdo.php';
session_start();
// VALIDATION

if (isset($_POST['book_id'])) {

    $book_id = htmlentities(trim($_POST['book_id']));
    echo $book_id;
    return;

    $sql = 'select * from booking,person,room where person.person_id=booking.person_id and room.room_id=booking.room_id';
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>



