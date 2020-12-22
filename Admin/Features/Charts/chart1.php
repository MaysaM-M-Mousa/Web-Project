<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}

$date = new DateTime();
$secondDate = "'" . $date->format("Y-m-d") . "'";
$date->modify("-7 day");
$firstDate = "'" . $date->format("Y-m-d") . "'";

$sql = 'select count(*) as freqs, start_date as date from booking where
        booking.start_date > ' . $firstDate . ' and booking.start_date <= ' . $secondDate . ' group by booking.start_date';

$data = $pdo->query($sql);

$result = $data->fetchAll(PDO::FETCH_OBJ);
echo json_encode($result);

?>
