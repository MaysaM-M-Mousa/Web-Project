<?php
require_once 'pdo.php';
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

//$sql = 'select item.item_id,item.item_name,item.item_description,item.item_price,item.image,category.category_name
//        ,sub_category.sub_cat_name,category.cat_id,sub_category.sub_cat_id
//        from item left join sub_category on item.sub_cat_id=sub_category.sub_cat_id
//        left join category on sub_category.sub_cat_id = category.cat_id where category.cat_id is not null';

$sql = 'select item.item_id,item.item_name,item.item_description,item.item_price,item.image,category.category_name
        ,sub_category.sub_cat_name,category.cat_id,sub_category.sub_cat_id from item,sub_category,category where item.sub_cat_id=sub_category.sub_cat_id and sub_category.cat_id=category.cat_id';
$result = $pdo->query($sql);

?>


<div class="container animate__animated animate__fadeIn">
    <section>
        <h1 class="main-h1">All Items</h1>
        <hr class="line">
        <p class="main-content">Below are all the Items from all categories, use the search feature to filter by type.. </p>
    </section>

    <div class="row forms mt-5">
        <table id="itemsTable" class="table table-striped table-light " style="width:100%">
            <thead>
            <tr>
                <th>Image</th>
                <th>Item Name</th>
                <th>Parent Category</th>
                <th>Sub-Category</th>
                <th>Price</th>
                <th class="edit_r">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>

                    <td><img style="width: 50px;height: 50px" src="../<?php echo $row['image']?>"></td>
                    <td><?php echo $row['item_name'] ?></td>

                    <td><?php echo $row['category_name'] ?></td>
                    <td><?php echo $row['sub_cat_name'] ?></td>
                    <td><?php echo $row['item_price'] ?></td>
                    <td  class="edit_r">
                        <button onclick="EditItem(this.value)" value="<?php echo $row['item_id'] ?>" class="edit-table fas fa-edit">
                        </button>
                    </td>
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


