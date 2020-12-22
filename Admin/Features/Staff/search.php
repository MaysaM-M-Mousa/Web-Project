<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}

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