<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

// to get the selection list of sub cats dynamically
if (isset($_POST['cat_id'], $_POST['findMainCategory'])) {
    $cat_id = $_POST['cat_id'];
    $sql = 'select * from category,sub_category where category.cat_id=sub_category.cat_id and category.cat_id=' . $cat_id;
    $result = $pdo->query($sql);
    echo '<option value="">Sub Category</option>';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $sub_cat_id = $row['sub_cat_id'];
        $sub_cat_name = $row['sub_cat_name'];
        echo "<option  value='$sub_cat_id'>$sub_cat_name</option>";
    }
    return;
}

if (isset($_POST['item_name'], $_POST['item_price'], $_POST['item_description'], $_POST['sub_cat_id'], $_POST['cat_id'])) {

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
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "testdatabase" AND TABLE_NAME = "item"';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $uniqueID = $result['AUTO_INCREMENT'];

    $imageFullName = $_FILES['file']['name'];
    $imageArray = explode('.', $imageFullName);
    $imageExtension = $imageArray[1];
    $newName = 'items' . $uniqueID;
    $imageFullName = $newName . '.' . $imageExtension;
    $newPath = "../../../../images/items/" . $imageFullName;
    $databasePath = '/images/items/' . $imageFullName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $newPath);
    //////////////////////////////////////////////////


    $item_name = htmlentities(trim($_POST['item_name']));
    $item_price = htmlentities(trim($_POST['item_price']));
    $item_description = htmlentities(trim($_POST['item_description']));
    $sub_cat_id = htmlentities(trim($_POST['sub_cat_id']));
    $cat_id = htmlentities(trim($_POST['cat_id']));
    $image = $databasePath;

    // check if the item exists in the same cat and sub-cat
    $sql = 'select * from item left join sub_category on item.sub_cat_id = sub_category.sub_cat_id
            where sub_category.sub_cat_id=:sub_cat_id and sub_category.cat_id=:cat_id and item_name=:item_name';

    $result = $pdo->prepare($sql);
    $result->execute(array(
        ':sub_cat_id' => $sub_cat_id,
        ':cat_id' => $cat_id,
        ':item_name' => $item_name
    ));

    if ($result->rowCount() != 0) {
        echo '<span style="color: red">This Item Already Exists in the same Category/Sub-Category!</span>';
        return;
    }
//TODO: add speacial case when parent cat is not spacified
    $sql = 'insert into item (item_name,item_description,item_price,image,sub_cat_id)
            values (:item_name,:item_description,:item_price,:image,:sub_cat_id)';

    $result = $pdo->prepare($sql);
    $result->execute(array(
        ':item_name' => $item_name,
        ':item_description' => $item_description,
        ':item_price' => $item_price,
        ':image' => $image,
        ':sub_cat_id' => $sub_cat_id
    ));
    echo '<span style="color: green">Successfully Added!</span>';
    return;


}

?>
<div class="container forms">
    <div class="form-border-2  my-5">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Add An Item</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the new Item..</p>
            </section>
            <div class="row mx-3 mt-3">
                <label class="col-12 col-md-2" for="#itemName">Item Name: </label>
                <input class="col-12 col-md-10 form-control" type="text" name="itemName" id="itemName"
                       placeholder="Item Name"
                       required>
            </div>

            <div class="row mx-3">
                <label class="col-12 col-md-2" for="#itemPrice">Price: </label>
                <input class="col-12 col-md-10 form-control" type="number" placeholder="Item Price" name="itemPrice" id="itemPrice">
            </div>

            <div class="row mx-3">
                <label class="col-12 col-md-2" for="#itemDescription">Description: </label>
                <textarea class="col-12 col-md-10" placeholder="Item Description" id="itemDescription" rows="5"></textarea>
            </div>
            <div class="row mx-3">
                <label class="col-12 col-md-2" for="#mainCategory">Type: </label>
                <select onchange="getSubCategories()" class="custom-select col-12 col-md-4" required name="mainCategory"
                        id="mainCategory">
                    <option value="">Parent Category</option>
                    <?php
                    $mysql = 'select * from category';
                    $resultCat = $pdo->query($mysql);
                    while ($rowCat = $resultCat->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $rowCat['cat_id'];
                        $cat_name = $rowCat['category_name'];
                        echo "<option  value='$cat_id'>$cat_name</option>";
                    }
                    ?>
                </select>
                <select class="custom-select col-12 col-md-5 offset-md-1" required name="subCategory" id="subCategory">
                    <option value="">Sub Category</option>
                </select>
            </div>
            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-2">Photo:</label>
                <div class="form-group files col-12 col-md-9">
                    <label>Upload Your File </label>
                    <input type="file" id="itemImage" class="form-control" multiple="false">
                </div>
            </div>
            <div class="row">
                <input class="btn btn-primary" id="addItemBTN" type="button" onclick="addItemBTN()"
                       value="Add Item">
                <div class="col-12" id="addItemResult">
                </div>
            </div>
        </div>
    </div>
    <script src="Scripts/dropzone.min.js"></script>
</div>



