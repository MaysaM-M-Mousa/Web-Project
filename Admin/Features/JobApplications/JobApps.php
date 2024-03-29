<?php
session_start();
if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 1
    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
    header("Location: ../../../Home/HTML/index.php");
    return;
}

require_once 'pdo.php';

if (isset($_POST['form_id'], $_POST['deleteForm'])) {
    $form_id = htmlentities($_POST['form_id']);
    $sql = 'delete from forms where form_id=' . $form_id;
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
    $headers .= "MIME-Version: 1.0" . "\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\n";

    $email_msg = $_POST['email_message'];

    mail($to, $subject, $email_msg, $headers);
    echo '<span style="color: darkgreen;font-family: \'Cabin\', serif;margin-top: 10px">Email was successfully sent!</span>';
    return;
}

if (isset($_POST['counter'])) {
    $sql = 'select * from person,forms where person.person_id=forms.person_id ORDER BY forms.date_of_applying limit ' . htmlentities(trim($_POST['counter']));

} else {
    $sql = 'select * from person,forms where person.person_id=forms.person_id ORDER BY forms.date_of_applying limit 3';

}


$result = $pdo->query($sql);

?>


<link rel="stylesheet" href="../Vendor/CSS/Loader.css">

<div class="container">
    <section class="animate__animated animate__fadeIn">
        <h1 class="main-h1">Job Applications</h1>
        <hr class="line">
        <p class="main-content">Below are all the job request that has been sent to us you can reed thier information
            and reply to them directly..</p>
    </section>
    <!--    search bar-->
    <div class="row searchbar forms animate__animated animate__fadeIn">
        <div class="col-7">
            <input type="search" class="form-control" id="searchJobBar" placeholder="Search"></div>
        <div class="col-2">
            <button class="btn btn-primary" onclick="jobSearch()"><i class="far fa-search"></i> Search</button>
        </div>
        <div class="col-1">
            <button id="advanceBtn" class="btn"> Advance Search</button>
        </div>
    </div>

    <div id="advanced" class="row searchbar forms">
        <div class="col-3 offset-3">
            <label for="searchAppsFilter">Method Filter</label>
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
        </div>
        <div class="col-3">
            <label for="searchAppsOrdering">Order By</label>
            <select class="form-select" id="searchAppsOrdering">
                <option selected>Order By</option>
                <option value="date">Date</option>
                <option value="name">Name</option>
                <option value="email">Email</option>
            </select>
        </div>
        <div class="col-3">
            <label class="form-check-label" for="repliedAppCB">Replied</label>
            <input class="form-check-input" type="checkbox" value="" id="repliedAppCB">
        </div>
    </div>

    <!--  End of SearchBar-->
    <div id="searchJobResult">
        <div class="container forms">
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
                <div style="animation-delay:<?php echo  0.1*$counter?>s;" class="form-border-2  my-5 animate__animated animate__zoomIn" id="cardJobDiv<?php echo $counter ?>">
                    <div class="card-border-1">
                        <div class="delete"
                             onclick="deleteJobCard(<?php echo $row['form_id'] ?>,<?php echo $counter ?>)">
                            <i class="far fa-trash-alt"></i>
                        </div>
                        <section class="header text-center">
                            <h2 class="card-h2"><?php echo $position ?></h2>
                            <h5><?php echo ($row['job_type'] == 0) ? 'Part Time' : 'Full Time' ?></h5>
                            <h4><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></h4>
                            <h5 id="emailSender<?php echo $counter ?>"><?php echo $row['person_email'] ?></h5>
                            <h6 class="col-12"><?php echo $row['date_of_applying'] ?></h6>
                            <div>
                                <?php
                                if ($row['status'] == 1)
                                    echo '<span id="status' . $counter . '" style="color: black; font-family: \'Cabin\', serif;"><i class="fa fa-check"></i> Replied</span>';
                                else
                                    echo '<span id="status' . $counter . '" style="color: black; font-family: \'Cabin\', serif;"></span>';
                                ?>
                            </div>
                        </section>
                        <div class="more-details">
                            <div class="row text-center">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="row ">
                                        <h6 class="col-12">Gender</h6>
                                        <label class="col-12 form-label"><?php echo($row['gender'] == 'male' ? 'Male' : 'Female') ?></label>
                                    </div>
                                    <div class="row">
                                        <h6 class="col-12">Location</h6>
                                        <label class="col-12 form-label"><?php echo $row['country'] . ', ' . $row['city'] ?></label>
                                    </div>
                                    <div class="row">
                                        <h6 class="col-12">Mobile</h6>
                                        <label class="col-12 form-label"><?php echo $row['mobile'] ?></label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="row">
                                        <h6 class="col-12">BirthDate</h6>
                                        <label class="col-12 form-label"><?php echo $row['year_bd'] . '-' . $row['month_bd'] . '-' . $row['day_bd'] ?></label>
                                    </div>
                                    <div class="row">
                                        <h6 class="col-12">Education</h6>
                                        <label class="col-12 form-label"><?php echo $row['education'] ?></label>
                                    </div>
                                    <div class="row">
                                        <h6 class="col-12">Major</h6>
                                        <label class="col-12 form-label"><?php echo $row['major'] ?></label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="row">
                                        <h6 class="col-12">Skills</h6>
                                        <label class="col-12 form-label"><?php echo $row['skills'] ?></label>
                                    </div>
                                    <div class="row">
                                        <h6 class="col-12">Languages</h6>
                                        <label class="col-12 form-label"><?php echo $row['languages'] ?></label>
                                    </div>
                                    <div class="row">
                                        <h6 class="col-12">About</h6>
                                        <p class="col-12 form-label"> <?php echo $row['about'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button class="reply-btn btn btn-primary"><i class="fas fa-envelope"
                                                                             style="font-size: 20px"></i> Reply
                                </button>
                            </div>
                            <div class="reply text-center">
                                <div id="reply<?php echo $counter ?>"></div>
                                <button onclick="sendEmailJobBTN(<?php echo $row['form_id'] ?>,<?php echo $counter ?>)"
                                        class="btn btn-primary mt-4">Send
                                </button>
                                <div id="MSG<?php echo $counter ?>" style="font-family: 'Cabin', serif;"></div>

                            </div>

                        </div>
                        <div class="sepr"></div>
                        <div class="sepl"></div>
                        <div class="details">
                            <h5>More Details</h5>
                            <hr class="sub-line">
                            <i class="fal fa-angle-down"></i>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div id="load-wrapper">
                <button id="loadMore" class="btn-primary btn load-btn" onclick="loadMoreCardsJA()">Load More</button>
            </div>

        </div>
    </div>


</div>
<?php
$sql = 'select * from person,forms where person.person_id=forms.person_id ORDER BY forms.date_of_applying';
$result = $pdo->query($sql);
?>
<script>

    var count = eval("<?php echo $counter; ?>");
    var temp=eval("<?php  echo $result->rowCount(); ?>");

    if(count==temp){
        $('#loadMore').addClass("animate__animated animate__fadeOut");
    }

</script>
<script src="Scripts/JA.js"></script>


