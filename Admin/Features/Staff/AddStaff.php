<?php
require_once 'pdo.php';

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
                <label class="col-12 col-md-2 control-label" for="fullNameAutoComplete">Full Name:</label>
                <input type="text" class="col-12 col-md-9  form-control" id="fullNameAutoComplete">
            </div>
            <dix class="row mx-3">
                <label class="col-12 col-md-2 control-label" for="Salary">Salary:</label>
                <input type="number" class="col-12 col-md-9  form-control" id="Salary" min="0">
            </dix>

            <div class="row mx-3">
                <label for="joiningDate" class="col-12 col-md-2 col-form-label">Joining Date:</label>
                <input class="form-control col-12 col-md-9" type="date" id="joiningDate">
            </div>

            <div class="row mx-3">
                <label class="col-12 col-md-2" for="position">Position: </label>
                <select class="col-md-9 col-12" required name="position" id="position">
                    <option value="position">Position</option>
                    <?php
                    $roomTypeArr = array('Manager', 'Chef', 'Cook', 'Dishwasher', 'Purchase Officer', 'Receptionist', 'Security', 'Waiter');
                    for ($i = 0; $i < sizeof($roomTypeArr); $i++)
                        echo "<option value='$roomTypeArr[$i]'>$roomTypeArr[$i]</option>";
                    ?>
                </select>
            </div>

            <div class="row mx-3 mb-2">
                <label for="zdrop" class="col-12 col-md-2">Photo:</label>
                <div class="col-12 col-md-9 px-0 pb-4">
                    <!-- Uploader Dropzone -->
                    <form action="Features/Room/upload.php" id="zdrop" class="fileuploader text-center" target="upload_target">
                        <div id="upload-label">
                            <i class="fad fa-cloud-upload material-icons"></i>
                            <span class="tittle d-none d-sm-block">Click the Button or Drop Files Here</span>
                        </div>
                    </form>
                    <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>

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
            <div class="row">
                <input id="addRoomBtn" type="button" class="btn btn-primary" value="Add Employee">
                <div class="col-12" id="MSG"></div>
            </div>
        </div>
    </div>
    <script src="Scripts/dropzone.min.js"></script>
    <script src="Scripts/Rooms.js"></script>
</div>
2


