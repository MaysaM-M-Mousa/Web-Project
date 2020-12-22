<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['cat_id'], $_POST['deleteCategory'],$_POST['image'])) {

    try{
        $cat_id = htmlentities($_POST['cat_id']);
        $image = htmlentities(trim($_POST['image']));

        $path = "../../../.." . $image;
        unlink($path);

        $sql = 'delete from category where cat_id=' . $cat_id;
        $result = $pdo->exec($sql);

        require_once 'AllCategories.php';
        return;
    }catch (Exception $e){
        echo "<span style=\"font-family: 'Cabin', serif;transform: translate(-50%,-50%);position: absolute; top: 50%; left: 50%;;
            color:darkred; font-size:20px;\">
            You have to delete all sub-categories that belongs to this one!</span>";
        return;
    }
}

?>
