<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

$ds = DIRECTORY_SEPARATOR;  //1
$storeFolder = 'images/rooms';   //2

if (isset($_POST['category_name'], $_POST['description'], $_POST['image'])) {

//    if (isset($_FILES["file"])) {
//        $tempFile = $_FILES['file']['tmp_name'];          //3
//        $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;  //4
//        $targetFile = $targetPath . $_FILES['file']['name'];  //5
//        move_uploaded_file($tempFile, $targetFile); //6
//        echo 'fuck abed success';
//        return;
//
//    } else {
//        echo 'fuck abed';
//        return;
//    }
    echo $_POST['image'];
    return;
    $category_name = htmlentities($_POST['category_name']);
    $description = htmlentities($_POST['description']);
    $image = htmlentities($_POST['image']);

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
<div class="container forms">
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
                    <label>Upload Your File </label>
                    <input type="file" id="image" class="form-control" multiple="">
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


