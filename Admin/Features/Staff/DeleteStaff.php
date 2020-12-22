<?php

require_once 'pdo.php';

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