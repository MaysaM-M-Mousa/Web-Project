<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

if (isset($_POST['sub_cat_name'], $_POST['description'], $_POST['cat_id'])) {

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
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "testdatabase" AND TABLE_NAME = "sub_category"';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $uniqueID = $result['AUTO_INCREMENT'];

    $imageFullName = $_FILES['file']['name'];
    $imageArray = explode('.', $imageFullName);
    $imageExtension = $imageArray[1];
    $newName = 'subcategories' . $uniqueID;
    $imageFullName = $newName . '.' . $imageExtension;
    $newPath = "../../../../images/subcategories/" . $imageFullName;
    $databasePath = '/images/subcategories/' . $imageFullName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $newPath);
    //////////////////////////////////////////////////


    $sub_cat_name = htmlentities(trim($_POST['sub_cat_name']));
    $description = htmlentities(trim($_POST['description']));
    $cat_id = htmlentities(trim($_POST['cat_id']));
    $image = $databasePath;


    if (strlen($sub_cat_name) < 1 || strlen($description) < 1 || strlen($image) < 1 || strlen($cat_id) < 1) {
        echo '<span style="color: darkred">All Fields Are Required!</span>';
        return;
    }

    $sql = "select * from sub_category where sub_cat_name= '" . $sub_cat_name . "' and cat_id=" . $cat_id;
    $result = $pdo->query($sql);
    if ($result->rowCount() != 0) {
        echo '<span style="color: darkred">This Category Already Has The Same Name Of the Entered Sub-Category!</span>';
        return;
    }

    $sql = "insert into sub_category (sub_cat_name,description,image,cat_id) values (:sub_cat_name,:description,:image,:cat_id)";
    $stmt = $pdo->prepare($sql);
    $stmt = $stmt->execute(array(
        ':sub_cat_name' => $sub_cat_name,
        ':description' => $description,
        ':image' => $image,
        ':cat_id' => $cat_id
    ));

    echo '<span style="color: darkgreen">Successfully added!</span>';
    return;
}

?>
<div class="container forms">
    <div class="form-border-2  my-5">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Add A Sub Category</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the new service type you want
                    to offer your customers..</p>
            </section>

            <div class="row mx-3 mt-3">
                <label class="col-12 col-md-3" for="#subCategoryName">Sub-Category Name: </label>
                <input class="col-12 col-md-9 form-control" type="text" name="subCategoryName" id="subCategoryName"
                       placeholder="Sub-Category Name"
                       required>
            </div>
            <div class="row mx-3">
                <label class="col-12 col-md-3" for="#parentCategory">Parent Category: </label>
                <select class="custom-select col-12 col-md-9" required name="parentCategory" id="parentCategory">
                    <option value="">Parent Category:</option>
                    <?php
                    $mysql = 'select * from category';
                    $result = $pdo->query($mysql);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $row['cat_id'];
                        $cat_name = $row['category_name'];
                        echo "<option value='$cat_id'>$cat_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row mx-3">
                <label class="col-12 col-md-3" for="#subCategoryDescription">Description: </label>
                <textarea class="col-12 col-md-9" placeholder="Sub-Category Description" id="subCategoryDescription"
                          rows="5"
                          cols="20"></textarea>
            </div>
            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-3">Photo:</label>
                <div class="form-group files col-12 col-md-9">
                    <label>Upload Your File </label>
                    <input type="file" id="subCatImage" class="form-control" multiple="false">
                </div>
            </div>
            <div class="row mx-3 mb-2">
                <input class="btn btn-primary" id="addSubCategoryBTN" type="button" onclick="addSubCategoryBTN()"
                       value="Add Sub-Category">
                <div class="col-12" id="addSubCatResult"></div>
            </div>
        </div>
    </div>
</div>
<script src="Scripts/dropzone.min.js"></script>
</div>


