<?php
//session_start();
//if (!isset($_SESSION['person_id']) || !isset($_SESSION['person_role']) || $_SESSION['person_role'] != 2
//    || !isset($_SESSION['activated']) || $_SESSION['activated'] != 1) {
//    header("Location: ../../Home/HTML/index.php");
//    return;
//}
require_once 'pdo.php';

if (isset($_POST['searchBar'], $_POST['filter'], $_POST['order_by'], $_POST['replied'])) {

    $searchbar = htmlentities($_POST['searchBar']);
    $filter = htmlentities($_POST['filter']);
    $order_by = htmlentities($_POST['order_by']);
    $replied = htmlentities($_POST['replied']);

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
            $sql = 'select * from person,forms where person.person_id=forms.person_id and (position like "%' . $searchbar . '%"' . ' or person_email like "%' . $searchbar . '%"' . ' or first_name like "%' . $searchbar . '%"' . ' or person_email like "%' . $searchbar . '%")';
        } elseif ($colDBFilter !== 'none' && $colDBOrderBY === 'none') {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"';
        } elseif ($colDBFilter === 'none' && $colDBOrderBY !== 'none') {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' order by ' . $colDBOrderBY . " $typeOfOrdering";
        } else {
            $sql = 'select * from person,forms where person.person_id=forms.person_id and status=' . $status . ' and ' . $colDBFilter . ' like ' . '"%' . $searchbar . '%"' . 'order by ' . $colDBOrderBY . " $typeOfOrdering";
        }
    }


    if (isset($_POST['counter'])) {
        $sql = $sql . ' limit ' . htmlentities(trim($_POST['counter']));
    } else {
        $sql = $sql . ' limit 3';
    }



    $result = $pdo->query($sql);

    if ($result->rowCount() < 1) {
        echo '<h1 style="position: absolute;top: 55%;left: 50%;transform: translate(-50%,-50%)">No Results Found!</h1>';
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

    <div class="container forms">
        <div style="animation-delay:<?php echo  0.1*$counter?>s; "class="form-border-2  my-5 animate__animated animate__zoomIn" id="cardJobDiv<?php echo $counter ?>">

            <div class="card-border-1">
                <div class="delete" onclick="deleteJobCard(<?php echo $row['form_id'] ?>,<?php echo $counter ?>)">
                    <i class="far fa-trash-alt"></i>
                </div>
                <section class="header text-center">
                    <h2 class="card-h2"><?php echo $position ?></h2>
                    <h5><?php echo ($row['job_type'] == 0) ? 'Part Time' : 'Full Time' ?></h5>
                    <h4><?php echo $row['first_name'] . ' ' . $row['last_name'] ?></h4>
                    <h5 id="emailSender<?php echo $counter ?>"><?php echo $row['person_email'] ?></h5>
                    <h6 class="col-2"><?php echo $row['date_of_applying'] ?></h6>
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

    </div>
    <?php
}
?>

<div id="load-wrapper">
    <button id="loadMore" class="btn-primary btn load-btn" onclick="loadMoreCardsSMJA()">Load More</button>
</div>
<div id="counter" class="<?php echo $counter ?>"></div>
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
                insert: '\nThanks for Applying for a job,\n' +
                    'we received your application, and we are pleased to tell you that you are accepted to be interviewed in La Terra Santa Hotel.\n' +
                    'We are waiting for you tomorrow on 9:00 AM.\n' +
                    'La Terra Santa.' +
                    '\n\n Best of luck.' + '  \n',
                attributes: {bold: true, align: "center", color: "#B79040", header: "3"}
            }
        ]);
    }


</script>

