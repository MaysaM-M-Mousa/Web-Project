<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

if (isset($_POST['editCategory'], $_POST['cat_id'])) {

    $cat_id = htmlentities($_POST['cat_id']);

    $sql = 'select * from category where cat_id=' . $cat_id;
    $result = $pdo->query($sql);

    if ($result->rowCount() < 1)
        return;

    $row = $result->fetch(PDO::FETCH_ASSOC);
}

if (isset($_POST['cat_id_Edit'], $_POST['category_name_Edit'], $_POST['description_Edit'], $_POST['image_Edit'])) {

    $cat_id_Edit = htmlentities($_POST['cat_id_Edit']);
    $category_name_Edit = htmlentities($_POST['category_name_Edit']);
    $description_Edit = htmlentities($_POST['description_Edit']);
    $image_Edit = htmlentities($_POST['image_Edit']);


    $sql = 'update category set category_name=:category_name,description=:description,image=:image where cat_id=' . $cat_id_Edit;
    $result_Edit = $pdo->prepare($sql);
    try {
        $result_Edit->execute(array(
            ':category_name' => $category_name_Edit,
            ':description' => $description_Edit,
            ':image' => $image_Edit,
        ));
    } catch (PDOException $e) {
        if ($e->errorInfo[0] == '23000' && $e->errorInfo[1] == '1062') {
            echo '<span style="color: red">This category name already exists!!</span>';
            return;
        }

    }

    echo '<span style="color: green">Successfully updated!</span>';
    return;
}

?>

<div class="container forms">
    <div id="back-btn" class="back-btn">
        <i class="fal fa-arrow-left"></i>
    </div>
    <div class="form-border-2">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Edit <?php echo $row['category_name'] ?> Service</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the the service category you want to
                    edit..</p>
            </section>
            <div class="row mx-3">
                <label for="#categoryNameEdit" class="col-12 col-md-3">Service Name:</label>
                <input class="col-12 col-md-9 form-control" type="text" name="categoryName" id="categoryNameEdit"
                       placeholder="Category Name"
                       value="<?php echo $row['category_name'] ?>" required>
            </div>
            <div class="row mx-3">
                <label for="#categoryDescriptionEdit" class="col-12 col-md-3">Category Description:</label>
                <textarea class="col-12 col-md-9" placeholder="Room Description" id="categoryDescriptionEdit" rows="5"
                          cols="20"><?php echo $row['description'] ?>
                </textarea>
            </div>
            <div class="row mx-3">
                <div class="col-12 offset-md-3 col-md-3">
                    <input class="btn btn-danger" id="deleteCategoryBTN" type="button"
                           onclick="deleteCategoryBTN(<?php echo $row['cat_id'] ?>)"
                           value="Delete Category">
                </div>
                <div class="col-12 offset-md-1 col-md-4">
                    <input class="btn btn-primary" style="width: 100%" id="editCategoryBTN" type="button"
                           onclick="submitChangingCategory(<?php echo $row['cat_id'] ?>)"
                           value="Update Category">

                </div>
                <div class="col-12" id="editCatResult">
            </div>
        </div>
    </div>
</div>


