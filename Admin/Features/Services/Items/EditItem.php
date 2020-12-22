<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

if (isset($_POST['item_id'], $_POST['editItem'])) {

    $item_id = htmlentities(trim($_POST['item_id']));
    $sql = 'select item.item_id,item.item_name,item.item_description,item.item_price,item.image,category.category_name
        ,sub_category.sub_cat_name,category.cat_id,sub_category.sub_cat_id from item,sub_category,category 
        where item.sub_cat_id=sub_category.sub_cat_id and sub_category.cat_id=category.cat_id and item_id=' . $item_id;
    $result = $pdo->query($sql);

    if ($result->rowCount() < 1)
        return;

    $row = $result->fetch(PDO::FETCH_ASSOC);

}

if (isset($_POST['item_name_edit'], $_POST['item_price_edit'], $_POST['cat_id_edit'], $_POST['sub_cat_id_edit']
    , $_POST['item_description_edit'], $_POST['item_id_edit'], $_POST['image_edit'])) {

    $item_name_edit = htmlentities(trim($_POST['item_name_edit']));
    $item_price_edit = htmlentities(trim($_POST['item_price_edit']));
    $cat_id_edit = htmlentities(trim($_POST['cat_id_edit']));
    $sub_cat_id_edit = htmlentities(trim($_POST['sub_cat_id_edit']));
    $item_description_edit = htmlentities(trim($_POST['item_description_edit']));
    $item_id_edit = htmlentities(trim($_POST['item_id_edit']));
    $image_edit = htmlentities(trim($_POST['image_edit']));

    if (strlen($item_name_edit) < 1 || strlen($item_price_edit) < 1 || strlen($cat_id_edit) < 1 ||
        strlen($sub_cat_id_edit) < 1 || strlen($item_description_edit) < 1 || strlen($item_id_edit) < 1 ||
        strlen($image_edit) < 1) {
        echo '<span style="color: red">All Fields Are Required!</span>';
        return;
    }

    // check if the item exists in the same cat and sub-cat
    $sql = 'select * from item left join sub_category on item.sub_cat_id = sub_category.sub_cat_id
            where sub_category.sub_cat_id=:sub_cat_id and sub_category.cat_id=:cat_id and item_name=:item_name
            and item_id !=:item_id';

    $result = $pdo->prepare($sql);
    $result->execute(array(
        ':sub_cat_id' => $sub_cat_id_edit,
        ':cat_id' => $cat_id_edit,
        ':item_name' => $item_name_edit,
        ':item_id' => $item_id_edit
    ));

    if ($result->rowCount() != 0) {
        echo '<span style="color: red">This Item Already Exists in the same Category/Sub-Category!</span>';
        return;
    }

    // everything is ok, update
    $sql = 'update item set item_name=:item_name,item_description=:item_description,item_price=:item_price
            ,image=:image,sub_cat_id=:sub_cat_id where item_id=:item_id';

    $result = $pdo->prepare($sql);
    $result->execute(array(
        ':item_name' => $item_name_edit,
        ':item_description' => $item_description_edit,
        ':item_price' => $item_price_edit,
        ':image' => $image_edit,
        ':sub_cat_id' => $sub_cat_id_edit,
        ':item_id' => $item_id_edit
    ));
    echo '<span style="color: green">Successfully Updated!</span>';
    return;

}

?>

<div class="container forms animate__animated animate__fadeIn">
    <div id="back-btn" class="back-btn">
        <i class="fal fa-arrow-left"></i>
    </div>
    <div class="form-border-2">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Edit <?php echo $row['item_name'] ?> Service Item</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the the service category you want to
                    edit..</p>
            </section>
            <div class="row mx-3">
                <label for="#itemNameEdit" class="col-12 col-md-3">Item Name:</label>
                <input class="col-12 col-md-9 form-control" type="text" name="itemNameEdit" id="itemNameEdit"
                       placeholder="Item Name" value="<?php echo $row['item_name'] ?>"
                       required>
            </div>
            <div class="row mx-3">
                <label for="#itemPriceEdit" class="col-12 col-md-3">Price:</label>
                <input class="col-12 col-md-9 form-control" type="number" placeholder="Item Price" name="itemPriceEdit"
                       value="<?php echo $row['item_price'] ?>" id="itemPriceEdit">
            </div>
            <div class="row mx-3">
                <label for="#itemDescriptionEdit" class="col-12 col-md-3">Description:</label>
                <textarea class="col-12 col-md-9" placeholder="Item Description" id="itemDescriptionEdit" rows="5"
                         ><?php echo $row['item_description'] ?></textarea>
            </div>
            <div class="row mx-3">
                <label for="#mainCategory" class="col-12 col-md-3">Parent Category:</label>
                <select onchange="getSubCategories()" class="custom-select col-12 col-md-4" required name="mainCategory"
                        id="mainCategory">
                    <option value="">Parent Category</option>
                    <?php
                    $mysql = 'select * from category';
                    $resultCat = $pdo->query($mysql);
                    while ($rowCat = $resultCat->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $rowCat['cat_id'];
                        $cat_name = $rowCat['category_name'];
                        if ($row['cat_id'] == $rowCat['cat_id'])
                            echo "<option  value='$cat_id' selected>$cat_name</option>";
                        else
                            echo "<option  value='$cat_id'>$cat_name</option>";
                    }
                    ?>
                </select>
                <select class="custom-select col-12 offset-md-1 col-md-4" required name="subCategory" id="subCategory">
                    <option value="">Sub Category</option>
                    <?php
                    $mysql = 'select * from sub_category where cat_id=' . $row['cat_id'];
                    $resultSubCat = $pdo->query($mysql);
                    while ($rowSubCat = $resultSubCat->fetch(PDO::FETCH_ASSOC)) {
                        $sub_cat_id = $rowSubCat['sub_cat_id'];
                        $sub_cat_name = $rowSubCat['sub_cat_name'];
                        if ($row['sub_cat_id'] == $rowSubCat['sub_cat_id'])
                            echo "<option  value='$sub_cat_id' selected>$sub_cat_name</option>";
                        else
                            echo "<option  value='$sub_cat_id'>$sub_cat_name</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-3">Photo:</label>
                <div class="form-group files col-12 col-md-9">
                    <input type="file" id="itemImage" class="form-control" multiple="false">
                </div>
            </div>
            <div class="row mx-3">
                <div class="col-12 offset-md-3 col-md-3">
                    <input class="btn btn-danger" id="deleteSubCategoryBTN" type="button"
                           onclick="deleteItemBTN(<?php echo $row['item_id'] ?>)"
                           value="Delete Item">
                </div>
                <div class="col-12 offset-md-1 col-md-4">
                    <input class="btn btn-primary" id="editItemBTN" type="button" style="width: 100%"
                           onclick="submitChangingItem(<?php echo $row['item_id'] ?>)"
                           value="Update Item">

                </div>
                <div class="col-12" id="editItemResult">
                </div>
            </div>
        </div>
    </div>
</div>



