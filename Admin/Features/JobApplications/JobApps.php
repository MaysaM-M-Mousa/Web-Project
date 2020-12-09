<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}

require_once 'pdo.php';

if(isset($_POST['form_id'],$_POST['deleteForm'])){
    $form_id = htmlentities($_POST['form_id']);
    $sql = 'delete from forms where form_id='.$form_id;
    $result = $pdo->exec($sql);
    return;
}

if (isset($_POST['sendReplyJobEmail'], $_POST['emailSender'], $_POST['form_id'])) {

    $statusOfEmail = 1;
    $sql = "update forms set status = $statusOfEmail where form_id=" . htmlentities($_POST['form_id']);
    $resultOfUpdating = $pdo->prepare($sql);
    $resultOfUpdating->execute();

    $to = htmlentities($_POST['emailSender']);
    $subject = 'La Terra Santa || Job Application MSG';
    $headers = 'From: 1.c.f.m.m.a.m@gmail.com';
    $email_msg = $_POST['email_message'];

    mail($to, $subject, $email_msg, $headers);
    echo '<span style="color: blue">Email was successfully sent!</span>';
    return;
}


$sql = 'select * from person,forms where person.person_id=forms.person_id ORDER BY forms.date_of_applying DESC limit 2';
$result = $pdo->query($sql);

?>


<div class="container">
    <!--    search bar-->
    <div class="row">
        <div class="form-floating mb-3 col-5">
            <input type="search" class="form-control" id="searchJobBar" placeholder="Search">
            <label for="searchJobBar">Search</label>
        </div>

        <div class="col-2">
            <button class="btn btn-primary" onclick="jobSearch()" style="width: 100%;height: 60px">Search</button>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchAppsFilter">
                    <option selected>Search Method</option>
                    <option value="email">Email</option>
                    <option value="name">Name</option>
                    <option value="languages">Languages</option>
                    <option value="position">Position</option>
                    <option value="education">Education</option>
                    <option value="major">Major</option>
                    <option value="skills">Skills</option>
                    <option value="mobile">Mobile</option>
                    <option value="city">City</option>
                </select>
                <label for="searchAppsFilter">Method Filter</label>
            </div>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchAppsOrdering">
                    <option selected>Order By</option>
                    <option value="date">Date</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                </select>
                <label for="searchAppsOrdering">Order By</label>
            </div>
        </div>

        <div class="form-check col-1">
            <input class="form-check-input" type="checkbox" value="" id="repliedAppCB">
            <label class="form-check-label" for="repliedCB">
                Replied
            </label>
        </div>

    </div>

    <div id="searchJobResult">


        <?php
        $counter = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $counter++;

            switch ($row['position']) {
                case 0 :
                    $position = 'Security';
                    break;
                case 1:
                    $position = 'Chef';
                    break;
                case 2:
                    $position = 'Waiter';
                    break;
                default:
                    $position = 'None';
                    break;
            }

            ?>

            <div class="row" id="cardJobDiv<?php echo $counter?>">
                <div class="card text-dark bg-info mb-3" style="width: 100%">
                    <div class="card-header">
                        <div style="display: inline-block" class="col-10">
                            <h3 style="display: inline-block">Position: <?php echo $position ?> </h3>
                            <h6 style="display: inline-block"><?php echo ($row['job_type'] == 0) ? 'Part Time' : 'Full Time' ?></h6>
                        </div>
                        <div style="display: inline-block" class="col-1">
                            <?php
                            if ($row['status'] == 1)
                                echo '<span id="status' . $counter . '" style="color: black"><i class="fa fa-check"></i> Replied</span>';
                            else
                                echo '<span id="status' . $counter . '" style="color: black"></span>';
                            ?>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h6 class="card-title col-10" id="emailSender<?php echo $counter ?>">Sender
                                Email: <?php echo $row['person_email'] ?></h6>
                            <h6 class="col-2"><?php echo $row['date_of_applying'] ?></h6>
                        </div>
                        <h6>From: <?php echo $row['first_name'] . ' ' . $row['last_name'] ?></h6>
                        <p class="card-text">About: <?php echo $row['about'] ?></p>


                        <div class="row">
                            <div class="col-2 offset-10">
                                <button class="btn btn-primary" data-toggle="collapse"
                                        data-target="#moreInfoDiv<?php echo $counter ?>">More Details
                                </button>
                            </div>
                        </div>

                        <div class="collapse" id="moreInfoDiv<?php echo $counter ?>">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">Gender:</label>
                                    <label class="form-label"><?php echo($row['gender'] == 'male' ? 'Male' : 'Female') ?></label>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Location:</label>
                                    <label class="form-label"><?php echo $row['country'] . ', ' . $row['city'] ?></label>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Mobile:</label>
                                    <label class="form-label"><?php echo $row['mobile'] ?></label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">BirthDate:</label>
                                    <label class="form-label"><?php echo $row['year_bd'] . '-' . $row['month_bd'] . '-' . $row['day_bd'] ?></label>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Education:</label>
                                    <label class="form-label"><?php echo $row['education'] ?></label>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Major:</label>
                                    <label class="form-label"><?php echo $row['major'] ?></label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">Skills:</label>
                                    <label class="form-label"><?php echo $row['skills'] ?></label>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Languages:</label>
                                    <label class="form-label"><?php echo $row['languages'] ?></label>
                                </div>
                            </div>


                        </div>


                        <div class="row">
                            <div class="col-1 offset-10">
                                <button class="btn btn-primary" data-toggle="collapse"
                                        data-target="#sendReplyEmail<?php echo $counter ?>">Reply
                                </button>
                            </div>

                            <div class="col-1">
                                <button class="btn btn-primary" <?php echo $counter ?> onclick="deleteJobCard(<?php echo $row['form_id']?>,<?php echo $counter?>)">Delete</button>
                            </div>
                        </div>


                        <!--                    start of collapsing div-->
                        <div class="collapse" id="sendReplyEmail<?php echo $counter ?>">

                            <div>
                            <textarea class="form-control" placeholder="Your Email"
                                      id="email_message<?php echo $counter ?>"
                                      rows="5">Hello <?php echo $row['first_name'] . ' ' . $row['last_name'] ?>, Thanks for Applying a job,
we received your application, and we are pleased to tell you that you are accepted to be interviewed to challenge on a "<?php echo $position ?>" position in La Terra Santa Hotel.
We are waiting for you tomorrow on 9:00 AM.
La Terra Santa.
Best of luck.</textarea>
                            </div>

                            <div class="row">
                                <div class="offset-10 col-2">
                                    <button onclick="sendEmailJobBTN(<?php echo $row['form_id'] ?>,<?php echo $counter ?>)"
                                            class="btn btn-primary">Send
                                    </button>
                                </div>
                            </div>


                        </div>
                        <!--                    end of collapsing div-->
                        <div id="MSG<?php echo $counter ?>"></div>

                    </div>
                </div>
            </div>

            <?php
        }
        ?>

    </div>

</div>


