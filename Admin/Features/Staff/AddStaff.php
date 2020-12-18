<?php
require_once 'pdo.php';

?>

<div class="row">


    <div class="form-group row">
        <label class="col-sm-2 control-label" for="fullName">Full Name:</label>
        <input type="text" class="col-8  form-control" id="fullName" >
    </div>


    <div class="form-group row">
        <label class="col-sm-2 control-label" for="Salary">Salary:</label>
        <input type="number" class="col-8  form-control" id="Salary" min="0">
    </div>

    <div class="form-group row">
        <label for="joiningDate" class="col-2 col-form-label">Joining Date:</label>
        <input class="form-control col-8" type="date" id="joiningDate">
    </div>

    <div class="form-group row">
        <label class="col-2" for="position">Position: </label>
        <select required name="position" id="position">
            <option value="position">Position</option>
            <?php
            $roomTypeArr = array('Manager', 'Chef', 'Cook', 'Dishwasher', 'Purchase Officer', 'Receptionist', 'Security', 'Waiter');
            for ($i = 0; $i < sizeof($roomTypeArr); $i++)
                echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
            ?>
        </select>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 control-label" for="image">Image:</label>
        <input type="text" class="col-8 form-control" id="image">
    </div>

</div>

</a>
<script>
    $("#fullName").autocomplete({
        serviceURL: "search.php"
        // ,
        // minLength: 2,
        // select: function (event, ui) {
        //     log(ui.item ? "Selected: " + ui.item.value + " aka " + ui.item.id : "Nothing selected, input was " + this.value);
        // }
    });
</script>