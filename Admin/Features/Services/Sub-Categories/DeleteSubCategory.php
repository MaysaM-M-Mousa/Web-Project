<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['sub_cat_id'], $_POST['deleteSubCategory'])) {

    $sub_cat_id = htmlentities($_POST['sub_cat_id']);
    $sql = 'delete from sub_category where sub_cat_id=' . $sub_cat_id;
    $result = $pdo->exec($sql);

    require_once 'AllSubCategories.php';
    return;
}

?>