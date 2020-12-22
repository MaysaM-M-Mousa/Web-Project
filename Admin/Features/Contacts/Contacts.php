<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['contact_id'], $_POST['deleteContact'])) {
    $contact_id = htmlentities($_POST['contact_id']);
    $sql = 'delete from contacts where contact_id=' . $contact_id;
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
    $headers .= "MIME-Version: 1.0" . "\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\n";

    $email_msg = $_POST['email_message'];

    mail($to, $subject, $email_msg, $headers);
    echo '<span style="color: darkgreen">Email was successfully sent!</span>';
    return;
}

if (isset($_POST['counter'])) {
    $sql = 'select * from contacts limit ' . htmlentities(trim($_POST['counter']));
} else {
    $sql = 'select * from contacts limit 3';
}


$result = $pdo->query($sql);
?>
<link rel="stylesheet" href="../Vendor/CSS/Loader.css">

<div class="container">
    <section>
        <h1 class="main-h1">Contacts And Reviews</h1>
        <hr class="line">
        <p class="main-content">Below are all the Reviews that our customers had submitted, make use of them to improve
            the service..</p>
    </section>
    <!--    search bar-->
    <div class="row searchbar forms">
        <div class="col-7">
            <input type="search" class="form-control" id="searchContactBar" placeholder="Search"></div>
        <div class="col-2">
            <button class="btn btn-primary" onclick="contactSearch()"><i class="far fa-search"></i> Search</button>
        </div>
        <div class="col-1">
            <button id="advanceBtn" class="btn"> Advance Search</button>
        </div>
    </div>

    <div id="advanced" class="row searchbar forms">
        <div class="col-3 offset-3">
            <label for="searchContactFilter">Method Filter</label>
            <select class="form-select" id="searchContactFilter">
                <option selected>Search Method</option>
                <option value="email">Email</option>
                <option value="name">Name</option>
                <option value="subject">Subject</option>
                <option value="message">Message</option>
            </select>
        </div>
        <div class="col-3">
            <label for="searchContactOrdering">Order By</label>
            <select class="form-select" id="searchContactOrdering">
                <option selected>Order By</option>
                <option value="date">Date</option>
                <option value="email">Email</option>
                <option value="name">Name</option>

            </select>
        </div>
        <div class="col-3">
            <label class="form-check-label" for="repliedContactCB">Replied</label>
            <input class="form-check-input" type="checkbox" value="" id="repliedContactCB">
        </div>
    </div>
    <!--  End of SearchBar-->

    <div id="searchContactResult">
        <div class="container forms">
            <?php
            $counter = 0;
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $counter++;
                ?>

                <div class="form-border-2 my-5" id="cardContactDiv<?php echo $counter ?>">
                    <div class="card-border-1">
                        <div class="delete"
                             onclick="deleteContactCard(<?php echo $row['contact_id'] ?>,<?php echo $counter ?>)">
                            <i class="far fa-trash-alt"></i>
                        </div>
                        <section class="header text-center">
                            <h2 class="card-h2"><?php echo $row['subject'] ?></h2>
                            <h5 class="email" id="emailSender<?php echo $counter ?>"><?php echo $row['email'] ?></h5>
                            <h6 class="col-12"><?php echo $row['date_of_receive'] ?></h6>
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
                                <div class="col-12">
                                    <p class="card-content"><span style="font-size: 25px">&#8220;</span>
                                        <?php echo $row['message'] ?>
                                        <span style="font-size: 25px">&#8221;</span> <span class="sender"
                                        ">-<?php echo $row['full_name'] ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <button class="reply-btn btn btn-primary"><i class="fas fa-envelope"
                                                                             style="font-size: 20px"></i> Reply
                                </button>
                            </div>
                            <div class="reply text-center">
                                <div id="reply<?php echo $counter ?>"></div>
                                <button onclick="sendEmailBTN(<?php echo $row['contact_id'] ?>,<?php echo $counter ?>)"
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
                <button id="loadMore" class="btn-primary btn load-btn" onclick="loadMoreCardsContacts()">Load More</button>
            </div>
        </div>
    </div>

</div>

<script>
    $(".details").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).prev().prev().prev().slideUp(300);
            $(this).children(":first").text("More Details");
            $(this).children(":last").removeClass("to-up");
            $(this).children(":last").removeClass("fa-angle-up");
            $(this).children(":last").addClass("fa-angle-down");

        } else {
            $(this).addClass("active");
            $(this).prev().prev().prev().slideDown(300);
            $(this).children(":first").text("Less Details");
            $(this).children(":last").removeClass("fa-angle-down");
            $(this).children(":last").addClass("fa-angle-up to-up");
        }
    });
    $(".reply-btn").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).parent().next().slideUp(300);

        } else {
            $(this).addClass("active");
            $(this).parent().next().slideDown(300);
        }
    });
    $("#advanceBtn").on("click", function () {
        if ($("#advanced").hasClass("active")) {
            $("#advanced").removeClass("active");
            $("#advanced").slideUp(300);

        } else {
            $("#advanced").addClass("active");
            $("#advanced").slideDown({
                start: function () {
                    $(this).css({
                        display: "flex"
                    })
                }
            });
        }
    })

    // configure Quill to use inline styles so the email's format properly
    var DirectionAttribute = Quill.import('attributors/attribute/direction');
    Quill.register(DirectionAttribute, true);

    var AlignClass = Quill.import('attributors/class/align');
    Quill.register(AlignClass, true);

    var BackgroundClass = Quill.import('attributors/class/background');
    Quill.register(BackgroundClass, true);

    var ColorClass = Quill.import('attributors/class/color');
    Quill.register(ColorClass, true);

    var DirectionClass = Quill.import('attributors/class/direction');
    Quill.register(DirectionClass, true);

    var FontClass = Quill.import('attributors/class/font');
    Quill.register(FontClass, true);

    var SizeClass = Quill.import('attributors/class/size');
    Quill.register(SizeClass, true);

    var AlignStyle = Quill.import('attributors/style/align');
    Quill.register(AlignStyle, true);

    var BackgroundStyle = Quill.import('attributors/style/background');
    Quill.register(BackgroundStyle, true);

    var ColorStyle = Quill.import('attributors/style/color');
    Quill.register(ColorStyle, true);

    var DirectionStyle = Quill.import('attributors/style/direction');
    Quill.register(DirectionStyle, true);

    var FontStyle = Quill.import('attributors/style/font');
    Quill.register(FontStyle, true);

    var SizeStyle = Quill.import('attributors/style/size');
    Quill.register(SizeStyle, true);
    let fonts = Quill.import("attributors/style/font");
    fonts.whitelist = ["initial", "sans-serif", "serif", "monospace", "cabin"];
    Quill.register(fonts, true);
    var toolbarOptions = [
        ['bold', 'italic', 'underline'],        // toggled buttons

        [{'header': 1}, {'header': 2}],               // custom button values
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
        [{'direction': 'rtl'}],                         // text direction

        [{'header': [1, 2, 3, 4, 5, 6, false]}],

        [{'color': []}, {'background': []}],          // dropdown with defaults from theme
        [{'font': []}],
        [{'align': []}],

        ['clean'], // remove formatting button

    ];
    var count = eval("<?php echo $counter; ?>");
    var editor = [];
    for (let i = 1; i <= count; i++) {
        let temp = '#reply' + i;
        editor[i] = new Quill(temp, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        editor[i].setContents([
            {
                insert: 'Hello,\n', attributes: {bold: true, align: "center", color: "#232530", header: "2"}
            },
            {
                insert: '\nThanks for Contacting Us,\n' +
                    '\n' +
                    'La Terra Santa.' +
                    '\n\n Best of luck.' + '  \n',
                attributes: {bold: true, align: "center", color: "#B79040", header: "3"}
            }
        ]);
    }


</script>




