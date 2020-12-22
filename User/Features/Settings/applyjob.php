<?php
require_once 'pdo.php';
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 0) {
    header("Location:../../../Home/HTML/index.html");
    return;
}

if (isset($_POST['education']) && isset($_POST['major']) && isset($_POST['language']) && isset($_POST['skills'])
    && isset($_POST['job_type']) && isset($_POST['position']) && isset($_POST['about'])) {

    $education = htmlentities($_POST['education']);
    $major = htmlentities($_POST['major']);
    $language = htmlentities($_POST['language']);
    $skills = htmlentities($_POST['skills']);
    $job_type = htmlentities($_POST['job_type']);
    $position = htmlentities($_POST['position']);
    $about = htmlentities(trim($_POST['about'], " "));
    $person_id = htmlentities($_SESSION['person_id']);

    if (strlen($education) < 1 || strlen($major) < 1 || strlen($language) < 1 || strlen($skills) < 1 || strlen($job_type) < 1 ||
        strlen($position) < 1 || strlen($about) < 1 || strlen($about > 1500)) {
        header('Location: applyjob.php');
        return;
    }

    // here i want to add the application to the forms table
    try {
        $sql = "insert into forms (education,major,skills,languages,job_type,position,about,person_id) values
    (:education,:major,:skills,:languages,:job_type,:position,:about,:person_id)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute(array(
            ":education" => $education,
            ":major" => $major,
            ":languages" => $language,
            ":skills" => $skills,
            ":job_type" => $job_type,
            ":position" => $position,
            ":about" => $about,
            ":person_id" => $person_id
        ));
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    $_SESSION['suc-msg'] = 'Your application is successfully sent!';
    header("Location: applyjob.php");
    return;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Welcome To The Club!</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <style>
        label {
            font-size: large;
        }

        .form-group {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .innerLabel {
            position: relative;
            top: 25%;

        }
    </style>

</head>
<body>



<div class="container">
    <form method="post" class="row">
        <div class="col-6 row">

            <?php
            if (isset($_SESSION['suc-msg'])) {
                echo "<span class='offset-md-3' style='color: green;font-size: large'>" . $_SESSION['suc-msg'] . "</span>";
                unset($_SESSION['suc-msg']);
            }
            ?>

            <div class="form-group col-12 align-items-center row" style="position: relative">
                <label class="col-3 innerLabel" for="education">Education:</label>
                <div class="row col-9">

                    <label class="col-12 " style="font-size: small">What is your highest education?
                        <span style="color: red; font-size: large">*</span>
                    </label>

                    <select class="custom-select col-12" name="education" required>
                        <option value="">education</option>
                        <?php
                        $arr = array("Primary school", "Highschool", "Vocational training", "Diploma",
                            "Baccalaureate", "Master");

                        for ($i = 0; $i < sizeof($arr); $i++)
                            echo "<option value='$i'>" . $arr[$i] . "</option>";
                        ?>

                    </select>
                </div>
            </div>

            <div class="form-group col-12 align-items-center row" style="position: relative">
                <label class="col-3 innerLabel" for="major">Major:</label>
                <div class="row col-9">
                    <label class="col-12 " style="font-size: small">What is your major?</label>
                    <input class="col-12 form-control" type="text" id="major" name="major" size="30">
                </div>
            </div>

            <div class="form-group col-12 align-items-center row" style="position: relative">
                <label class="col-3 innerLabel" for="language">Languages:</label>
                <div class="row col-9">
                    <label class="col-12 " style="font-size: small">Languages you speak?
                        <span style="color: red; font-size: large">*</span>
                    </label>
                    <input class="col-12 form-control" type="text" id="language" name="language" size="30" required>
                </div>
            </div>

            <div class="form-group col-12 align-items-center row" style="position: relative">
                <label class="col-3 innerLabel" for="skills">Skills:</label>
                <div class="row col-9">
                    <label class="col-12 " style="font-size: small">Write skills you earned
                        <span style="color: red; font-size: large">*</span>
                    </label>
                    <input class="col-12 form-control" type="text" id="skills" name="skills" size="30" required>
                </div>
            </div>

            <div class="form-group col-12 align-items-center row" style="position: relative">
                <label class="col-3 innerLabel" for="skills">Job Type:</label>

                <div class="row col-9">

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="job_type" value="0">Full Time
                        </label>
                    </div>
                    <div class="form-check-inline" style="margin-left: 40px">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="job_type" value="1">Part Time
                        </label>
                    </div>

                </div>
            </div>
        </div>
        <!--second part of the form-->

        <div class="col-6 row">
            <div class="form-group col-12 align-items-center row" style="position: relative">
                <label class="col-3 innerLabel" for="position">Position:</label>
                <div class="row col-9">
                    <label class="col-12 " style="font-size: small">You are applying to be a?
                        <span style="color: red; font-size: large">*</span>
                    </label>

                    <select class="custom-select col-12" name="position" required>
                        <option value="">position</option>
                        <?php
                        $arr = array("Security", "Chef", "Waiter");
                        for ($i = 0; $i < sizeof($arr); $i++)
                            echo "<option value='$i'>" . $arr[$i] . "</option>";
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group col-12 align-items-center row" style="position:relative;">
                <label class="col-3 innerLabel" for="about">About you:</label>
                <div class="row col-9">
                    <label class="col-12 " style="font-size: small">
                        Tell us about yourself, if you have a previous experience, training, and certificates
                        you earned.<span style="color: red; font-size: large">*</span>
                    </label>
                    <textarea class="col-12 form-control" type="text" id="about" name="about" rows="9" maxlength="1500"
                              required placeholder="type here"></textarea>
                </div>
            </div>

        </div>
        <div class="row" style="height: 50px">

        </div>

        <div class="row" style="width: 100%">
            <div style="margin-left: 66.5%" class="row col-12">
                <a class="btn btn-secondary mb-2" href="../../../Home/HTML/index.html"
                   style=" width: 100px">Cancel</a>
                <input type="submit" class="btn btn-primary mb-2" name="apply" value="Apply Now"
                       style=" width: 150px; margin-left: 10px">
            </div>
        </div>
    </form>
</div>

<script src="../../JavaScript/applyjob.js"></script>

</body>
</html>