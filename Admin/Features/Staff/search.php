<?php
require_once 'pdo.php';

$sql = 'select first_name from person';
$stmt = $pdo->query($sql);

//$result = $stmt->fetchAll(PDO::FETCH_OBJ);
//echo json_encode($result);

$response = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $response[] = array("person_id"=>$row['person_id'],"first_name"=>$row['first_name']);
}

echo json_encode($response);

?>