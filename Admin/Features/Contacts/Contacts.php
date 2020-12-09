<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if(isset($_POST['contact_id'],$_POST['deleteContact'])){
    $contact_id = htmlentities($_POST['contact_id']);
    $sql = 'delete from contacts where contact_id='.$contact_id;
    $result = $pdo->exec($sql);
    return;
}

if (isset($_POST['sendReplyEmail'], $_POST['emailSender'], $_POST['contact_id'])) {

    $statusOfEmail = 1;
    $sql = "update contacts set status = $statusOfEmail where contact_id=" . htmlentities($_POST['contact_id']);
    $resultOfUpdating = $pdo->prepare($sql);
    $resultOfUpdating->execute();

    $to = htmlentities($_POST['emailSender']);
    $subject = 'La Terra Santa || Contact MSG';
    $headers = 'From: 1.c.f.m.m.a.m@gmail.com';
    $email_msg = $_POST['email_message'];

    mail($to, $subject, $email_msg, $headers);
    echo '<span style="color: blue">Email was successfully sent!</span>';
    return;
}


$sql = 'select * from contacts';
$result = $pdo->query($sql);
?>

<div class="container">

    <div class="row">
        <h1 style="width: 100%; text-align: center">Contacts</h1>
    </div>
    <div class="row">

        <div class="form-floating mb-3 col-5">
            <input type="search" class="form-control" id="searchContactBar" placeholder="Search">
            <label for="searchContactBar">Search</label>
        </div>

        <div class="col-2">
            <button class="btn btn-primary" onclick="contactSearch()" style="width: 100%;height: 60px">Search</button>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchContactFilter">
                    <option selected>Search Method</option>
                    <option value="email">Email</option>
                    <option value="name">Name</option>
                    <option value="subject">Subject</option>
                    <option value="message">Message</option>
                </select>
                <label for="searchContactFilter">Method Filter</label>
            </div>
        </div>

        <div class="col-2">
            <div class="form-floating">
                <select class="form-select" id="searchContactOrdering">
                    <option selected>Order By</option>
                    <option value="date">Date</option>
                    <option value="email">Email</option>
                    <option value="name">Name</option>

                </select>
                <label for="searchContactOrdering">Order By</label>
            </div>
        </div>

        <div class="form-check col-1">
            <input class="form-check-input" type="checkbox" value="" id="repliedContactCB">
            <label class="form-check-label" for="repliedCB">
                Replied
            </label>
        </div>
    </div>
    <div id="searchContactResult" style="position:relative; min-height: 400px">
        <?php
        $counter = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $counter++;
            ?>

            <div class="row" id="cardContactDiv<?php echo $counter?>">
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
                            <div class="col-1 offset-10">
                                <button class="btn btn-primary" data-toggle="collapse"
                                        data-target="#sendReplyEmail<?php echo $counter ?>">Reply
                                </button>
                            </div>

                            <div class="col-1">
                                <button class="btn btn-primary" <?php echo $counter ?> onclick="deleteContactCard(<?php echo $row['contact_id']?>,<?php echo $counter?>)">Delete</button>
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
    </div>
</div>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.2/jquery.flexslider.js"></script>
<script src="../../Vendor/script/jquery.scrollUp.min.js"></script>
<script src="../../Vendor/script/jquery.slicknav.js"></script>
<script src="../../Vendor/script/popper.js"></script>
<script src="../../Vendor/script/bootstrap.min.js"></script>

<script>

</script>


