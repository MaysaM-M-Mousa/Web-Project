<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}

if (isset($_POST['empIDEdit'], $_POST['personIDEdit'], $_POST['empSalaryEdit'], $_POST['empJoiningDateEdit'], $_POST['empPositionEdit'])) {


    $empIDEdit = htmlentities(trim($_POST['empIDEdit']));
    $empSalatyEdit = htmlentities(trim($_POST['empSalaryEdit']));
    $empJoiningDateEdit = htmlentities(trim($_POST['empJoiningDateEdit']));
    $empPositoinEdit = htmlentities(trim($_POST['empPositionEdit']));
    $personIDEdit = htmlentities(trim($_POST['personIDEdit']));

    if (strlen($empIDEdit) < 1 || strlen($empSalatyEdit) < 1 || strlen($empJoiningDateEdit)
        < 1 || strlen($empPositoinEdit) < 1) {
        echo '<span style="color: darkred">All Fields are required!</span>';
        return;
    }


    // check if the id belongs to an admin
    $sql = 'select * from person where person.person_role=1 and person.person_id=:person_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $personIDEdit
    ));

    if ($stmt->rowCount() > 0) {
        echo '<span style="color: darkred">Admin cannot be treated as an employee!</span>';
        return;
    }

    // check if the employee already exists
    $sql = 'select * from employee,person where person.person_id=employee.person_id and person.person_id=:person_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':person_id' => $personIDEdit
    ));

    if ($stmt->rowCount() < 1) {
        echo '<span style="color: darkred">Make sure this employee exists!</span>';
        return;
    }
    $rowCE = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($_FILES)) {

        /////////////////////////////////////////////
        $path = "../../.." . $rowCE['image'];
        unlink($path);

        $uniqueID = $empIDEdit;

        $imageFullName = $_FILES['file']['name'];
        $imageArray = explode('.', $imageFullName);
        $imageExtension = $imageArray[1];
        $newName = 'employees' . $uniqueID;
        $imageFullName = $newName . '.' . $imageExtension;
        $newPath = "../../../images/employees/" . $imageFullName;
        $databasePath = '/images/employees/' . $imageFullName;
        move_uploaded_file($_FILES["file"]["tmp_name"], $newPath);
        //////////////////////////////////////////////////

        $sql = 'update employee set start_date=:start_date,position=:position,salary=:salary,image=:image where employee_id=:employee_id';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':start_date' => $empJoiningDateEdit,
            ':position' => $empPositoinEdit,
            ':salary' => $empSalatyEdit,
            ':employee_id' => $empIDEdit,
            ':image' => $databasePath
        ));
    } else {

        $sql = 'update employee set start_date=:start_date,position=:position,salary=:salary where employee_id=:employee_id';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':start_date' => $empJoiningDateEdit,
            ':position' => $empPositoinEdit,
            ':salary' => $empSalatyEdit,
            ':employee_id' => $empIDEdit
        ));
    }


    echo '<span style="color: green">Successfully Updated!</span>';
    return;

}

if (isset($_POST['empID'])) {
    $sql = 'select * from employee where employee_id=' . htmlentities(trim($_POST['empID']));
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() < 1)
        return;

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<div class="container forms animate__animated animate__fadeIn">
    <div class="form-border-2  my-5">
        <div class="form-border-1">
            <section>
                <h1 class="main-h1">Edit An Employee</h1>
                <hr class="line">
                <p class="main-content">Please fill the form below with information about the employee you want to
                    edit..</p>
            </section>


            <div class="row mx-3">
                <label class="col-12 col-md-2 control-label" for="empSalaryEdit">Salary:</label>
                <input type="number" value="<?php echo $row['salary'] ?>" class="col-12 col-md-9  form-control"
                       id="empSalaryEdit" min="0">
            </div>

            <div class="row mx-3">
                <label for="empJoiningDateEdit" class="col-12 col-md-2 col-form-label">Joining Date:</label>
                <input class="form-control col-12 col-md-9" value="<?php echo $row['start_date'] ?>" type="date"
                       id="empJoiningDateEdit">
            </div>

            <div class="row mx-3">
                <label class="col-12 col-md-2" for="empPositionEdit">Position: </label>
                <select class="col-md-9 col-12" required name="position" id="empPositionEdit">
                    <option value="">Position</option>
                    <?php
                    $positionType = array('Manager', 'Chef', 'Cook', 'Dishwasher', 'Purchase Officer', 'Receptionist', 'Security', 'Waiter');
                    for ($i = 0; $i < sizeof($positionType); $i++)
                        if ($positionType[$i] == $row['position'])
                            echo "<option selected value='$positionType[$i]'>$positionType[$i]</option>";
                        else
                            echo "<option value='$positionType[$i]'>$positionType[$i]</option>";
                    ?>
                </select>
            </div>

            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-2">Photo:</label>
                <div class="form-group files col-12 col-md-9">

                    <input type="file" id="empImageEdit" class="form-control" multiple="false">
                </div>
            </div>
            <div class="row mx-3">
                <div class="col-12 offset-md-3 col-md-3">
                    <input class="btn btn-danger" id="deleteEmpBTN" type="button"
                           onclick="deleteEmployee(<?php echo $row['employee_id'] ?>,<?php echo "'" . $row['image'] . "'" ?>)"
                           value="Delete Employee">

                </div>
                <div class="col-12 offset-md-1 col-md-3">
                    <input id="editEmpBTN" type="button"
                           onclick="submitSaveEmpChangesBTN(<?php echo $row['employee_id'] ?>,
                           <?php echo $row['person_id'] ?>)"
                           class="btn btn-primary" value="Save Changes">
                </div>
            </div>
            <div id="editStaffResult"></div>

        </div>
        <script src="Scripts/dropzone.min.js"></script>
        <script src="Scripts/Rooms.js"></script>
    </div>



