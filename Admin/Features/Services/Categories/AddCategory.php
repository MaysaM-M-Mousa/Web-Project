<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../../Home/HTML/index.php");
    return;
}


if (isset($_POST['category_name'], $_POST['description'])) {

    if (!empty($_FILES)) {
        if (0 < $_FILES['file']['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
        // move_uploaded_file($_FILES['file']['tmp_name'], '../../../images/categories/' . $_FILES['file']['name']);
        }
    } else {
        echo '<span style="color:red;">Please choose a picture!</span>';
        return;
    }

    //////////////////////////////////////////////////
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "testdatabase" AND TABLE_NAME = "category"';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $uniqueID = $result['AUTO_INCREMENT'];

    $imageFullName = $_FILES['file']['name'];
    $imageArray = explode('.', $imageFullName);
    $imageExtension = $imageArray[1];
    $newName = 'categories' . $uniqueID;
    $imageFullName = $newName . '.' . $imageExtension;
    $newPath = "../../../../images/categories/" . $imageFullName;
    $databasePath = '/images/categories/'.$imageFullName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $newPath);
    //////////////////////////////////////////////////

    $category_name = htmlentities($_POST['category_name']);
    $description = htmlentities($_POST['description']);
    $image = $databasePath;

    if (strlen($category_name) < 1 || strlen($description) < 1 || strlen($image) < 1) {
        echo '<span style="color: darkred">All Fields Are Required!</span>';
        return;
    }

    $sql = "select * from category where category_name= '" . $category_name . "'";
    $result = $pdo->query($sql);
    if ($result->rowCount() != 0) {
        echo '<span style="color: darkred">This Category Already Exists!</span>';
        return;
    }

    $sql = "insert into category (category_name,description,image) values (:category_name,:description,:image)";
    $stmt = $pdo->prepare($sql);
    $stmt = $stmt->execute(array(
        ':category_name' => $category_name,
        ':description' => $description,
        ':image' => $image
    ));

    echo '<span style="color: darkgreen">Successfully added!</span>';
    return;
}

?>
<div class="container forms animate__animated animate__fadeIn">
    <div class="form-border-2  my-5">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Add A Category</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the new service type you want
                    to offer your customers..</p>
            </section>
            <div class="row mx-3 mt-3">
                <label class="col-12 col-md-3" for="#categoryName">Category Name: </label>
                <input class="col-12 col-md-9 form-control" type="text" name="categoryName" id="categoryName"
                       placeholder="Category Name"
                       required>
            </div>

            <div class="row mx-3">
                <label class="col-12 col-md-3" for="#categoryDescription">Description: </label>
                <textarea class="col-12 col-md-9" placeholder="Category Description" id="categoryDescription" rows="5"
                          cols="20"></textarea>
            </div>


            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-3">Photo:</label>
                <div class="form-group files col-12 col-md-9">
                    <input type="file"accept="image/x-png,image/gif,image/jpeg" id="catImage" class="form-control" multiple="false">
                </div>
            </div>
            <div class="row">
                <input class="btn btn-primary" id="addCategoryBTN" type="button" onclick="addCategoryBTN()"
                       value="Add Category">
                <div class="col-12" id="addCatResult">
                </div>

            </div>
        </div>
    </div>
</div>


