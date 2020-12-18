<?php
require_once 'pdo.php';

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

