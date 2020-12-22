<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../../Home/HTML/index.php");
    return;
}
if (isset($_POST['sub_cat_id'], $_POST['deleteSubCategory'],$_POST['image'])) {

    try{
        $sub_cat_id = htmlentities($_POST['sub_cat_id']);
        $image = htmlentities(trim($_POST['image']));

        $path = "../../../.." . $image;
        unlink($path);

        $sql = 'delete from sub_category where sub_cat_id=' . $sub_cat_id;
        $result = $pdo->exec($sql);

        require_once 'AllSubCategories.php';
        return;
    }catch (Exception $e){
        echo "<span style=\"font-family: 'Cabin', serif;transform: translate(-50%,-50%);position: absolute; top: 50%; left: 50%;;
            color:darkred; font-size:20px;\">
            You have to delete all items that belongs to this one!</span>";
        return;
    }
}

?>