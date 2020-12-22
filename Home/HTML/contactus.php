<?php
require_once 'pdo.php';

if (isset($_POST['fullName'], $_POST['email'], $_POST['subject'], $_POST['message'])) {

    $fullName = htmlentities($_POST['fullName']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $message = htmlentities($_POST['message']);

    if (strlen($fullName) < 1 || strlen($email) < 1 || strlen($subject) < 1 || strlen($message) < 1) {
        echo '<span class="offset-md-1" style="color: darkred">All fields are required!.</span>';

        return;
    }

    try {
        $sql = "insert into contacts (full_name,email,subject,message,date_of_receive,status) values
            (:full_name,:email,:subject,:message,:date_of_receive,:status)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":full_name" => $fullName,
            ":email" => $email,
            ":subject" => $subject,
            ":message" => $message,
            ':date_of_receive' => date('Y-m-d'),
            ':status' => 0

        ));

        echo '<span class="offset-md-1" style="color: darkred">Your feedback is successfully sent!, Thanks for contacting us.</span>';
        return;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}

?>

<link rel="stylesheet" href="../../Admin/CSS/styles.css">


<div class="container forms">
    <div class="form-border-2  my-5">
        <div class="form-border-1">
            <!--            <form method="post" action="contactus.php" class="offset-1 col-10">-->

            <section>
                <h1 class="main-h1">How Can We Help?</h1>
                <hr class="line">
                <p class="main-content"> We’re here to help and answer any question you might have. We look forward
                    to hearing from you!</p>
            </section>
            <div class="row mx-3 mt-3">
                <label class="col-12 col-md-3">Full Name: </label>
                <input class="col-12 col-md-9 form-control" type="text" id="fullName" name="fullName"
                       placeholder="Full Name"
                       required>

            </div>
            <dix class="row mx-3">
                <label class="col-12 col-md-3">Email: </label>
                <input class="col-12 col-md-9 form-control" type="email" id="email" name="email" placeholder="Email"
                       required>
            </dix>
            <div class="row mx-3">
                <label class="col-12 col-md-3">Subject: </label>
                <input class="form-control col-12 col-md-9" type="text" id="subject" name="subject"
                       placeholder="Subject">

            </div>
            <div class="row mx-3">
                <label class="col-12 col-md-3">Massage: </label>
                <textarea class="col-12 col-md-9 form-control" type="text" id="message" name="message" rows="10"
                          maxlength="3000"
                          required placeholder="Your message"></textarea>
            </div>

            <div class="row pb-4">
                <input class="btn btn-primary mb-2" onclick="sendContact()" type="submit" id="sendContactBTN"
                       name="send" value="Send">
            </div>
            <div id="sendContactHomeResult" class="row">

            </div>
            <!--            </form>-->
        </div>
    </div>
</div>
<script>
    function sendContact() {
        $.post('contactus.php', {
            'fullName': document.getElementById('fullName').value,
            'email': document.getElementById('email').value,
            'subject': document.getElementById('subject').value,
            'message': document.getElementById('message').value
        }, function (data, status) {
            if (status === 'success') {
                document.getElementById('sendContactHomeResult').innerHTML = data;
            }
        })
    }

</script>

