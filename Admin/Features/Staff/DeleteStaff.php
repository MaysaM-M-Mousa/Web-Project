<?php

require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
if (isset($_POST['employee_id'], $_POST['deleteStaff'],$_POST['image'])) {

    $empID = htmlentities($_POST['employee_id']);
    $image = htmlentities(trim($_POST['image']));

    $path = "../../.." . $image;
    unlink($path);

    $sql = 'delete from employee where employee_id=' . $empID;
    $result = $pdo->exec($sql);

    require_once 'AllStaff.php';
    return;

}

?>