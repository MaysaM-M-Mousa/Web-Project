<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['cat_id'], $_POST['deleteCategory'])) {

    $cat_id = htmlentities($_POST['cat_id']);
    $sql = 'delete from category where cat_id=' . $cat_id;
    $result = $pdo->exec($sql);

    require_once 'AllCategories.php';
    return;
}

?>
