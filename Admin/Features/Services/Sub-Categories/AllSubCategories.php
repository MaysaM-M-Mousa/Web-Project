<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../../Home/HTML/index.php");
    return;
}

$sql = 'select sub_category.image,sub_category.description,sub_category.sub_cat_id,sub_category.sub_cat_name,category.category_name from sub_category,category where sub_category.cat_id = category.cat_id';
$result = $pdo->query($sql);


?>


<div class="container animate__animated animate__fadeIn">
    <section>
        <h1 class="main-h1">Services Sub Categories</h1>
        <hr class="line">
        <p class="main-content">
            Below are all the Sub Categories Services for the hotel offers currently, you can offer new type
            of Sub Services By simply adding one and specifying its parent category..
        </p>
    </section>
    <div class="row forms mt-5">
        <table id="subcategoriesTable" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
                <th>Image</th>
                <th>Parent Category</th>
                <th>Name</th>
                <th>Description</th>
                <th class="edit_r">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><img style="width: 50px;height: 50px" src="../<?php echo $row['image']?>"></td>
                    <td><?php echo $row['category_name'] ?></td>
                    <td><?php echo $row['sub_cat_name'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td class="edit_r"><button onclick="EditSubCategory(this.value)" class="edit-table fas fa-edit" value="<?php echo $row['sub_cat_id'] ?>"></button></td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../Vendor/script/bootstrap.min.js"></script>
<script src="Scripts/jquery.dataTables.min.js"></script>
<script src="Scripts/dataTables.bootstrap4.min.js"></script>
