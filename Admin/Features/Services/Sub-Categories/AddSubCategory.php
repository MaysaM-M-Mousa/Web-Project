<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

if (isset($_POST['sub_cat_name'], $_POST['description'], $_POST['image'], $_POST['cat_id'])) {

    $sub_cat_name = htmlentities(trim($_POST['sub_cat_name']));
    $description = htmlentities(trim($_POST['description']));
    $image = htmlentities(trim($_POST['image']));
    $cat_id = htmlentities(trim($_POST['cat_id']));

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
                <textarea class="col-12 col-md-9" placeholder="Sub-Category Description" id="subCategoryDescription" rows="5"
                          cols="20">
                </textarea>
            </div>
            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-3">Photo:</label>
                <div class="col-12 col-md-9 px-0 pb-4">
                    <!-- Uploader Dropzone -->
                    <form action="Features/Room/upload.php" id="zdrop" class="fileuploader text-center"
                          target="upload_target">
                        <div id="upload-label">
                            <i class="fad fa-cloud-upload material-icons"></i>
                            <span class="tittle d-none d-sm-block">Click the Button or Drop Files Here</span>
                        </div>
                    </form>
                    <iframe id="upload_target" name="upload_target" src="#"
                            style="width:0;height:0;border:0px solid #fff;"></iframe>

                    <div class="preview-container">
                        <div class="collection card" id="previews">
                            <div class="collection-item clearhack valign-wrapper item-template"
                                 id="zdrop-template">
                                <div class="left pv zdrop-info" data-dz-thumbnail>
                                    <div>
                                        <span data-dz-name></span> <span data-dz-size></span>
                                    </div>
                                    <div class="progress">
                                        <div class="determinate" style="width:0" data-dz-uploadprogress></div>
                                    </div>
                                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                </div>

                                <div class="secondary-content actions">
                                    <a href="#!" data-dz-remove
                                       class="btn-floating ph red white-text waves-effect waves-light"><i
                                                class="material-icons white-text">clear</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
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


