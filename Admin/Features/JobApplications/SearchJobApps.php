<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';
sleep(1);

if (isset($_GET['searchBar'], $_GET['filter'], $_GET['order_by'], $_GET['replied'])) {

    $searchbar = htmlentities($_GET['searchBar']);
    $filter = htmlentities($_GET['filter']);
    $order_by = htmlentities($_GET['order_by']);
    $replied = htmlentities($_GET['replied']);

    switch ($filter) {
        case 'email':
            $colDBFilter = 'person_email';
            break;
        case 'name':
            $colDBFilter = 'first_name';
            break;
        case 'languages':
            $colDBFilter = 'languages';
            break;
        case 'position':
            $colDBFilter = 'position';
            break;
        case 'education':
            $colDBFilter = 'education';
            break;
        case 'major':
            $colDBFilter = 'major';
            break;
        case 'skills':
            $colDBFilter = 'skills';
            break;
        case 'mobile':
            $colDBFilter = 'mobile';
            break;
        case 'city':
            $colDBFilter = 'city';
            break;
        default :
            $colDBFilter = 'none';
            break;
    }

    switch ($order_by) {
        case 'date':
            $colDBOrderBY = 'date_of_applying';
            break;
        case 'email':
            $colDBOrderBY = 'person_email';
            break;
        case 'name':
            $colDBOrderBY = 'first_name';
            break;
        default :
            $colDBOrderBY = 'none';
            break;
    }

    if ($order_by === 'name' || $order_by === 'email')
        $typeOfOrdering = 'ASC';
    elseif ($order_by === 'date')
        $typeOfOrdering = 'DESC';

    if ($replied === 'false')
        $status = 0;
    elseif ($replied === 'true')
        $status = 1;


    // if search bar is empty
    if (empty($searchbar)) {
        if ($colDBOrderBY === 'none') {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status;
        } elseif ($colDBOrderBY !== 'none') {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' order by ' . $colDBOrderBY . " $typeOfOrdering";
        }
    } else {
        if ($colDBFilter === 'none' && $colDBOrderBY === 'none') {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' and position like "%' . $searchbar . '%"';
        } elseif ($colDBFilter !== 'none' && $colDBOrderBY === 'none') {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"';
        } elseif ($colDBFilter === 'none' && $colDBOrderBY !== 'none') {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' order by ' . $colDBOrderBY . " $typeOfOrdering";
        } else {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"' . 'order by ' . $colDBOrderBY . " $typeOfOrdering";
        }
    }

    $result = $pdo->query($sql);

    if ($result->rowCount() < 1) {
        echo '<h1 style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%)">No Results Found!</h1>';
        return;
    }

}

?>



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

    <div class="row">
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
                    <div class="col-2 offset-10">
                        <button class="btn btn-primary" data-toggle="collapse"
                                data-target="#sendReplyEmail<?php echo $counter ?>">Reply
                        </button>
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
