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

$sql = 'SELECT CAST(orders.order_time AS DATE) as date, COUNT(*) as freqs FROM orders 
		where  CAST(orders.order_time AS DATE) >' . $firstDate . ' and CAST(orders.order_time AS DATE) <=' . $secondDate . '	
        GROUP BY CAST(orders.order_time AS DATE)';

$data = $pdo->query($sql);

$result = $data->fetchAll(PDO::FETCH_OBJ);
echo json_encode($result);
?>

