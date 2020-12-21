<?php
require_once 'pdo.php';
session_start();

if (isset($_POST['empID'], $_POST['empSalary'], $_POST['empJoiningDate'], $_POST['empPosition'])) {

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
    $sql = 'SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "testdatabase" AND TABLE_NAME = "employee"';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $uniqueID = $result['AUTO_INCREMENT'];

    $imageFullName = $_FILES['file']['name'];
    $imageArray = explode('.', $imageFullName);
    $imageExtension = $imageArray[1];
    $newName = 'employees' . $uniqueID;
    $imageFullName = $newName . '.' . $imageExtension;
    $newPath = "../../../images/employees/" . $imageFullName;
    $databasePath = '/images/employees/' . $imageFullName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $newPath);
    //////////////////////////////////////////////////


    $empID = htmlentities(trim($_POST['empID']));
    $empSalaty = htmlentities(trim($_POST['empSalary']));
    $empJoiningDate = htmlentities(trim($_POST['empJoiningDate']));
    $empPositoin = htmlentities(trim($_POST['empPosition']));

    if (strlen($empID) < 1 || strlen($empSalaty) < 1 || strlen($empJoiningDate) < 1 || strlen($empPositoin) < 1) {
        echo '<span style="color: red">All Fields are required!</span>';
        return;
    }

    // check if ID exists in person table
    $sql = 'select * from person where person.person_id=:person_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $empID
    ));

    if ($stmt->rowCount() < 1) {
        echo '<span style="color: red">Make sure that the entered ID belongs to some client!</span>';
        return;
    }

    // check if the employee already exists
    $sql = 'select * from employee,person where person.person_id=employee.person_id and person.person_id=' . $empID;
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $empID
    ));

    if ($stmt->rowCount() > 0) {
        echo '<span style="color: red">This ID already belongs to an employee!</span>';
        return;
    }

    // check if the id belongs to an admin
    $sql = 'select * from person where person.person_role=1 and person.person_id=' . $empID;
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $empID
    ));

    if ($stmt->rowCount() > 0) {
        echo '<span style="color: red">Admin cannot be added as employee!</span>';
        return;
    }

    // add employee to the table
    $sql = 'insert into employee (person_id,start_date,position,salary,image) 
            values(:person_id,:start_date,:position,:salary,:image) ';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $empID,
        ':start_date' => $empJoiningDate,
        ':position' => $empPositoin,
        ':salary' => $empSalaty,
        ':image' => $databasePath
    ));

    echo '<span style="color: green">Successfully Added!</span>';
    return;

}
?>

<div class="container forms">
    <div class="form-border-2  my-5">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Add An Employee</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the Employee you want to
                    register..</p>
            </section>


            <div class="row mx-3 mt-3">
                <label class="col-12 col-md-2 control-label" for="fullNameAutoComplete">ID:</label>
                <input type="number" class="col-12 col-md-9  form-control" id="empID">
            </div>
            <dix class="row mx-3">
                <label class="col-12 col-md-2 control-label" for="Salary">Salary:</label>
                <input type="number" class="col-12 col-md-9  form-control" id="empSalary" min="0">
            </dix>

            <div class="row mx-3">
                <label for="joiningDate" class="col-12 col-md-2 col-form-label">Joining Date:</label>
                <input class="form-control col-12 col-md-9" type="date" id="empJoiningDate">
            </div>

            <div class="row mx-3">
                <label class="col-12 col-md-2" for="position">Position: </label>
                <select class="col-md-9 col-12" required name="position" id="empPosition">
                    <option value="">Position</option>
                    <?php
                    $roomTypeArr = array('Manager', 'Chef', 'Cook', 'Dishwasher', 'Purchase Officer', 'Receptionist', 'Security', 'Waiter');
                    for ($i = 0; $i < sizeof($roomTypeArr); $i++)
                        echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
                    ?>
                </select>
            </div>

            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-2">Photo:</label>
                <div class="form-group files col-12 col-md-9">
                    <label>Upload Your File</label>
                    <input type="file" id="empImage" class="form-control" multiple="false">
                </div>
            </div>
            <div class="row">
                <input id="addEmpBTN" type="button" onclick="addEmpBTN()" class="btn btn-primary" value="Add Employee">
                <div class="col-12" id="empMSG"></div>
            </div>
        </div>
    </div>
    <script src="Scripts/dropzone.min.js"></script>
    <script src="Scripts/Rooms.js"></script>
</div>
2


