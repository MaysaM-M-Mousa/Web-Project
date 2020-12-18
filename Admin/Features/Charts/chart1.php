<?php
require_once 'pdo.php';

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
