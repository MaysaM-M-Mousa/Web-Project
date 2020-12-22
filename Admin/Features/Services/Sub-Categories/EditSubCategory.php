<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

if (isset($_POST['sub_cat_id_edit'], $_POST['sub_cat_name_edit'], $_POST['description_edit'], $_POST['cat_id_edit'])) {

    $cat_id_edit = htmlentities($_POST['cat_id_edit']);
    $sub_cat_name_edit = htmlentities($_POST['sub_cat_name_edit']);
    $sub_cat_id_edit = htmlentities($_POST['sub_cat_id_edit']);
    $description_edit = htmlentities($_POST['description_edit']);
    $image_edit = htmlentities($_POST['image_edit']);

    if (strlen($cat_id_edit) < 1 || strlen($sub_cat_name_edit) < 1 || strlen($sub_cat_id_edit) < 1 ||
        strlen($sub_cat_id_edit) < 1 || strlen($image_edit) < 1) {
        echo '<span style="color: darkred;font-family: Cabin, serif">All Fields Are Required!</span>';
        return;
    }

    $sql = "select * from sub_category where sub_cat_name='" . $sub_cat_name_edit . "' and cat_id=" . $cat_id_edit . ' and
            sub_cat_id !=' . $sub_cat_id_edit;
    $result = $pdo->query($sql);
    if ($result->rowCount() != 0) {
        echo '<span style="color: darkred;font-family: Cabin, serif">This Category Already Has The Same Name Of the Entered Sub-Category!</span>';
        return;
    }

    $sql = 'update sub_category set cat_id=:cat_id,sub_cat_name=:sub_cat_name,description=:description,image=:image where sub_cat_id=' . $sub_cat_id_edit;
    $result_Edit = $pdo->prepare($sql);
    try {
        $result_Edit->execute(array(
            ':sub_cat_name' => $sub_cat_name_edit,
            ':description' => $description_edit,
            ':image' => $image_edit,
            ':cat_id' => $cat_id_edit
        ));
    } catch (PDOException $e) {
        if ($e->errorInfo[0] == '23000' && $e->errorInfo[1] == '1062') {
            echo '<span style="color: darkred;font-family: Cabin, serif">This category name already exists!!</span>';
            return;
        }

    }
    echo '<span style="color: darkgreen;font-family: Cabin, serif">Successfully updated!</span>';
    return;
}

if (isset($_POST['editSubCategory'], $_POST['sub_cat_id'])) {

    $sub_cat_id = htmlentities($_POST['sub_cat_id']);

    $sql = 'select category.cat_id,sub_category.sub_cat_name,sub_category.sub_cat_id,sub_category.description from sub_category,category where sub_category.cat_id = category.cat_id and sub_cat_id=' . $sub_cat_id;
    $result = $pdo->query($sql);

    if ($result->rowCount() < 1)
        return;

    $row = $result->fetch(PDO::FETCH_ASSOC);
}

?>

<div class="container forms animate__animated animate__fadeIn">
    <div id="back-btn" class="back-btn">
        <i class="fal fa-arrow-left"></i>
    </div>
    <div class="form-border-2">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Edit <?php echo $row['sub_cat_name'] ?> Sub-Service</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the the service sub-Category you want to
                    edit..</p>
            </section>
            <div class="row mx-3">
                <label for="#subCategoryNameEdit" class="col-12 col-md-3">Service Name:</label>
                <input class="col-12 col-md-9 form-control" type="text" name="subCategoryNameEdit" id="subCategoryNameEdit"
                       placeholder="Sub-Category Name" value="<?php echo $row['sub_cat_name'] ?>"
                       required>
            </div>
            <div class="row mx-3">
                <label for="#subCategoryDescriptionEdit" class="col-12 col-md-3">Description:</label>
                <textarea class="col-12 col-md-9" placeholder="Sub-Category Description" id="subCategoryDescriptionEdit" rows="5"
                          cols="20"><?php echo $row['description'] ?></textarea>
            </div>
            <div class="row mx-3">
                <label for="#parentCategoryEdit" class="col-12 col-md-3">Parent Category:</label>
                <select class="custom-select col-12 col-md-9" required name="parentCategoryEdit" id="parentCategoryEdit">
                    <option value="">Parent Category</option>
                    <?php
                    $mysql = 'select * from category';
                    $resultCat = $pdo->query($mysql);
                    while ($rowCat = $resultCat->fetch(PDO::FETCH_ASSOC)) {
                        $cat_id = $rowCat['cat_id'];
                        $cat_name = $rowCat['category_name'];
                        if ($row['cat_id'] == $rowCat['cat_id'])
                            echo "<option value='$cat_id' selected>$cat_name</option>";
                        else
                            echo "<option value='$cat_id'>$cat_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-3">Photo:</label>
                <div class="form-group files col-12 col-md-9">
                    <input type="file" id="subCatImage" accept="image/x-png,image/gif,image/jpeg" class="form-control" multiple="false">
                </div>
            </div>
            <div class="row mx-3">
                <div class="col-12 offset-md-3 col-md-3">
                    <input class="btn btn-danger" id="deleteSubCategoryBTN" type="button"
                           onclick="deleteSubCategoryBTN(<?php echo $row['sub_cat_id'] ?>)"
                           value="Delete Sub-Category">
                </div>
                <div class="col-12 offset-md-1 col-md-4">
                    <input class="btn btn-primary" id="addSubCategoryBTN" type="button" style="width: 100%"
                           onclick="submitChangingSubCategory(<?php echo $row['sub_cat_id'] ?>)"
                           value="Update Sub-Category">

                </div>
                <div class="row" id="editSubCatResult">
                </div>
            </div>
        </div>
    </div>


