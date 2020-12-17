<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['item_id'], $_POST['deleteItem'])) {

    $item_id = htmlentities($_POST['item_id']);
    $sql = 'delete from item where item_id=' . $item_id;
    $result = $pdo->exec($sql);

    require_once 'AllItems.php';
    return;
}

?>