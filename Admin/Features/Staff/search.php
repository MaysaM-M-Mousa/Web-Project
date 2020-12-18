<?php
require_once 'pdo.php';

$name = htmlentities(trim($_POST['query']));
$sql = "select person_id,first_name,last_name from person where first_name like '%" . $name . "%'";
$stmt = $pdo->query($sql);

echo $sql;
//$result = $stmt->fetchAll(PDO::FETCH_OBJ);
//echo json_encode($result);

$data = array();
if ($stmt->rowCount() > 0) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row['first_name'];
    }
    echo json_encode($data);
}


?>