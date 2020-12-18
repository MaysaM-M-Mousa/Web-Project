<?php
session_start();
require_once 'pdo.php';

if (isset($_POST['deleteBook'], $_POST['book_id'], $_POST['start_date'])) {

    $book_id = htmlentities(trim($_POST['book_id']));
    $start_date = htmlentities(trim($_POST['start_date']));
    $deleteBook = htmlentities(trim($_POST['deleteBook']));

    if ($deleteBook != 'deleteBook')
        die('This date has expired!');

    if ($start_date < date('Y-m-d'))
        die('This date has expired!');

    $sql = 'delete from booking where booking.book_id=:book_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':book_id' => $book_id
    ));

    require_once 'AllBooking.php';
    return;
}