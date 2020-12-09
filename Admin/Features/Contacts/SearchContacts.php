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
            $colDBFilter = 'email';
            break;
        case 'name':
            $colDBFilter = 'full_name';
            break;
        case 'subject':
            $colDBFilter = 'subject';
            break;
        case 'message':
            $colDBFilter = 'message';
            break;
        default :
            $colDBFilter = 'none';
            break;
    }

    switch ($order_by) {
        case 'date':
            $colDBOrderBY = 'date_of_receive';
            break;
        case 'email':
            $colDBOrderBY = 'email';
            break;
        case 'name':
            $colDBOrderBY = 'full_name';
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
            $sql = 'select * from contacts where status=' . $status;
        } elseif ($colDBOrderBY !== 'none') {
            $sql = 'select * from contacts where status=' . $status . ' order by ' . $colDBOrderBY . " $typeOfOrdering";
        }
    } else {
        if ($colDBFilter === 'none' && $colDBOrderBY === 'none') {
            $sql = 'select * from contacts where status=' . $status . ' and subject like "%' . $searchbar . '%"';
        } elseif ($colDBFilter !== 'none' && $colDBOrderBY === 'none') {
            $sql = 'select * from contacts where status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"';
        } elseif ($colDBFilter === 'none' && $colDBOrderBY !== 'none') {
            $sql = 'select * from contacts where status=' . $status . ' order by ' . $colDBOrderBY . " $typeOfOrdering";
        } else {
            $sql = 'select * from contacts where status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"' . 'order by ' . $colDBOrderBY . " $typeOfOrdering";
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
    ?>

    <div class="row">
        <div class="card text-dark bg-warning mb-3" style="width: 100%">
            <div class="card-header row">
                <div class="col-10" style="display: inline-block">
                    <h3 class="col-10" style="display: inline-block">
                        Subject: <?php echo $row['subject'] ?> </h3>
                </div>
                <div class="col-2" style="display: inline-block">
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
                        Email: <?php echo $row['email'] ?></h6>
                    <h6 class="col-2"><?php echo $row['date_of_receive'] ?></h6>
                </div>
                <h6>From: <?php echo $row['full_name'] ?></h6>
                <p class="card-text"><?php echo $row['message'] ?></p>

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
                                      rows="5">Hello <?php echo $row['full_name'] ?>, Thanks for contacting us,
we received your email and read it carefully, we will see in your order.
Hope you enjoyed our hotel.
La Terra Santa.
Best of luck.</textarea>
                    </div>

                    <div class="row">
                        <div class="offset-10 col-2">
                            <button onclick="sendEmailBTN(<?php echo $row['contact_id'] ?>,<?php echo $counter ?>)"
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
